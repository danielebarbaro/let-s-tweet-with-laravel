<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowUsersTest extends TestCase
{
    public function testUserCanFollow()
    {
        $user = factory(User::class)->create([]);
        $userToUnfollow = factory(User::class)->create(['username' => 'to-follow']);
        $user->follow($userToUnfollow);

        $this->assertTrue($user->follows($userToUnfollow));
    }
}
