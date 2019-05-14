<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\FollowingRequest;
use App\Models\User;

class FollowingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  FollowingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FollowingRequest $request)
    {
        try {
            $userToFollow = User::where('username', $request->validated())->firstOrFail();
            $this->me()->follow($userToFollow);
        } catch (\Exception $exception) {
            dd('Catch the Exception');
        }

        return redirect()->route('user-following.index', ['username' => $this->me()->username]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $username)
    {
        try {
            $this->me()->unfollow($username);
        } catch (\Exception $exception) {
            dd('Catch the Exception');
        }

        return redirect()->route('user-following.index', ['username' => $this->me()->username]);
    }
}
