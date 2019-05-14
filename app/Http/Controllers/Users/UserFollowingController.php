<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user-following.index', [
            'user' => $user,
            'following' => $user->following,
        ]);
    }
}
