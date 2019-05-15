<?php

namespace Tests\Feature;

use App;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PostNewTweetTest extends TestCase
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

    public function testPostNewTweet()
    {
        $this->actingAs($this->user, 'web')->post('/tweets', ['body' => 'Hello World!']);
        $this->assertAuthenticatedAs($this->user);
        $this->assertEquals('Hello World!', $this->user->tweets()->first()->body);
    }

    public function testPostNewTweetRequestNoBody()
    {
        $response = $this->actingAs($this->user, 'web')->post('/tweets', ['body' => '']);
        $response->assertSessionHasErrors([
            'body' => 'Please fill the textarea.'
        ]);
    }

    public function testPostNewTweetRequest165Body()
    {
        $response = $this->actingAs($this->user, 'web')
            ->post('/tweets', ['body' => str_repeat('Hello World! ', 20)]);
        $response->assertSessionHasErrors([
            'body' => 'Max value of tweet is 160.'
        ]);
    }
}
