<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The registration form can be displayed.
     *
     * @return void
     */
    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * A valid user can be registered.
     *
     * @return void
     */
    public function testRegistersAValidUser()
    {
        $user = factory(User::class)->create(['username' => 'john-register']);

        $response = $this->post('register', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
    }

    /**
     * An invalid user is not registered.
     *
     * @return void
     */
    public function testDoesNotRegisterAnInvalidUser()
    {
        $user = factory(User::class)->create(['username' => 'john-register']);

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid'
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
