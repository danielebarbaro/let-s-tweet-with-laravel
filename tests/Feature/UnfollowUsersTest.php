<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnfollowUsersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->user = factory(User::class)->create();
    }

    public function testUserCanUnfollow()
    {
        $user_to_follow = factory(User::class)->create();
        $this->assertFalse($this->user->follows($user_to_follow));

        $this->user->follow($user_to_follow);
        $this->assertTrue($this->user->follows($user_to_follow));

        $response = $this->actingAs($this->user, 'web')->delete("/following/{$user_to_follow->username}");
        $response->assertRedirect(route('user-following.index', ['username' => $this->user]));
        $this->assertFalse($this->user->follows($user_to_follow));
    }
}
