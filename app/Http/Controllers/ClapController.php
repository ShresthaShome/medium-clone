<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ClapController extends Controller
{
    public function clapUnclap(Post $post)
    {
        if ($post->isClappedByUser(Auth::user())) {
            $post->claps()->where('user_id', Auth::id())->delete();
        } else {
            $post->claps()->create(['user_id' => Auth::id()]);
        };
        return response()->json([
            'message' => 'Clap/Unclap action successful',
            'count' => $post->claps()->count(),
        ]);
    }
}
