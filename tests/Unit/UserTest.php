<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeFound()
    {
        $user = factory(User::class)->create(['username' => 'daniele']);

        $user_to_found = User::findByUsername('daniele');

        $this->assertEquals($user->id, $user_to_found->id);
        $this->assertEquals('daniele', $user_to_found->username);
    }

    public function testUserCanFollowUser()
    {
        $john_doe = factory(User::class)->create(['username' => 'john']);
        $marti = factory(User::class)->create(['username' => 'marti']);

        $this->assertFalse($john_doe->follows($marti));

        $john_doe->follow($marti);
        $this->assertTrue($john_doe->follows($marti));
    }

    public function testDuplicateUserFollow()
    {
        $john_doe = factory(User::class)->create(['username' => 'john']);
        $marti = factory(User::class)->create(['username' => 'marti']);
        $this->assertFalse($john_doe->follows($marti));

        $john_doe->follow($marti);
        $john_doe->follow($marti);
        $this->assertTrue($john_doe->follows($marti));
        $this->assertEquals(1, $john_doe->following()->count());
    }

    public function testCanUnfollowUser()
    {
        $john_doe = factory(User::class)->create(['username' => 'john']);
        $marti = factory(User::class)->create(['username' => 'marti']);
        $this->assertFalse($john_doe->follows($marti));

        $john_doe->follow($marti);
        $this->assertTrue($john_doe->follows($marti));

        $john_doe->unfollow($marti);
        $this->assertFalse($john_doe->follows($marti));
    }

    public function testNewTweet()
    {
        $user = factory(User::class)->create();

        $user->tweet('Hello World!');

        $tweet = $user->tweets()->first();
        $this->assertNotNull($tweet);
        $this->assertEquals('Hello World!', $tweet->body);
    }
}
