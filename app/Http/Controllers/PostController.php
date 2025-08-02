<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $query = Post::latest();

        if ($user) {
            $ids = $user->following->pluck('id')->push($user->id);
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
        $data['slug'] = Str::slug($data['title']);

        Post::create($data);

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function category(string $categoryName)
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->firstOrFail();
        $user = Auth::user();

        $query = $category->posts()->latest();

        if ($user) {
            $ids = $user->following->pluck('id')->push($user->id);
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->paginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }
}
