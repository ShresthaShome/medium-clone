<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        $query = $user->posts()->latest()->withCount('claps');

        if (Auth::user()->id !== $user->id) {
            $query->where('published_at', '<=', now());
        }

        $posts = $query->paginate();

        return view('profile.show', ['user' => $user, 'posts' => $posts]);
    }
}
