<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can follow another user
     *
     * @return void
     */
    public function testUserCanFollow()
    {
        $user = factory(User::class)->create([]);
        $user_to_follow = factory(User::class)->create(['username' => 'to-follow']);
        $user->follow($user_to_follow);

        $this->assertTrue($user->follows($user_to_follow));
    }
}
