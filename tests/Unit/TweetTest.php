<?php

namespace Tests\Unit;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function testTweetHasUser()
    {
        $user = factory(User::class)->create();
        $tweet = factory(Tweet::class)->create([
            'user_id' => $user
        ]);
        $this->assertEquals($user->username, $tweet->user->username);
    }
}
