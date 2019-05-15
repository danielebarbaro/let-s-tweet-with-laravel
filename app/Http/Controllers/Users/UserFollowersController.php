<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserFollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  User  $user
     * @codeCoverageIgnore
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user-followers.index', [
            'user' => $user,
            'followers' => $user->followers,
        ]);
    }
}
