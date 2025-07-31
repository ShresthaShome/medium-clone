<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function followUnfollow(User $user)
    {
        $user->followers()->toggle(Auth::user());
        return response()->json([
            'message' => 'Follow/Unfollow action successful',
            'count' => $user->followers()->count(),
        ]);
    }
}
