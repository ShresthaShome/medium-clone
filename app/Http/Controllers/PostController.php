<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $query = Post::where('published_at', '<=', now())
            ->with('user')
            ->withCount('claps')
            ->latest();

        if ($user) {
            $ids = $user->following
                ->pluck('id')
                ->push($user->id);
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->paginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create', [
            'categories' => Category::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];
        $data['image'] = $image->store('posts', 'public');

        $data['user_id'] = Auth::id();

        if (!$data['published_at'] || $data['published_at'] < now()) {
            $data['published_at'] = now();
        }

        Post::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('post.edit', [
            'post' => $post,
            'categories' => Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $data['image'];
            $data['image'] = $image->store('posts', 'public');
        } else {
            $data['image'] = $post->image;
        }

        $data['user_id'] = $post->user_id;

        if (!$data['published_at'] || $data['published_at'] < now()) {
            $data['published_at'] = Carbon::now()->setTimezone('Asia/Dhaka');
        }

        $post->update($data);

        return redirect()
            ->route('post.show', [
                'username' => $post->user->username,
                'post' => $post,
            ])
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return redirect()->route('dashboard')
            ->with('success', 'Post deleted successfully.');
    }

    public function category(string $categoryName)
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])
            ->firstOrFail();
        $user = Auth::user();

        $query = $category->posts()
            ->where('published_at', '<=', now())
            ->with('user')
            ->withCount('claps')
            ->latest();

        if ($user) {
            $ids = $user->following
                ->pluck('id')
                ->push($user->id);

            $query->whereIn('user_id', $ids);
        }

        $posts = $query->paginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }
}
