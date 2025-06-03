<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $this->withoutMiddleware();

        $this->post('/login', [
                'email' => $this->user->email,
                'password' => 'password',
            ]);

        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)->post('/logout');

        $this->assertGuest();
    }

    public function test_users_not_authenticated_dont_access_to_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }


    public function test_authenticated_api_call_can_fetch_breweries() : void
    {
        // Call API endpoint with the Bearer token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->createToken('TestToken')->plainTextToken,
        ])->getJson('/api/get-breweries');

        $response->assertStatus(200);
    }

    public function test_api_call_with_wrong_token_cannot_fetch_breweries() : void
    {
        // Generate token for authentication
        $this->user->createToken('TestToken')->plainTextToken;

        // Call API endpoint with wrong the Bearer token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer wrong-token',
        ])->getJson('/api/get-breweries');

        $response->assertStatus(401);
    }

    public function test_unauthenticated_api_call_can_fetch_breweries() : void
    {
        // Call API endpoint without the Bearer token
        $response = $this->getJson('/api/get-breweries');

        $response->assertStatus(401);
    }

}
