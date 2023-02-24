<?php

namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canNotLoginWithWrongCredentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'name' => $user->name,
            'password' => 'wrong_password',
        ]);
        $response->assertStatus(422);
    }

    /** @test */
    public function canLoginWithCorrectCredentials()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'name' => $user->name,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token_type', 'access_token', 'expires_in']);
    }

    /** @test */
    public function canRegisterAUserWithValidDetails()
    {
        $response = $this->json('post', 'api/auth/register', $this->payload);
        $response->assertStatus(201);
        $this->assertEquals(1, User::count());
        $response->assertJsonStructure(['token_type', 'access_token', 'expires_in']);

    }

    /** @test */
    public function canNotRegisterAUserWithExistingUserName()
    {
        User::create($this->payload);
        $response = $this->json('post', 'api/auth/register', $this->payload);
        $response->assertStatus(422);
        $this->assertEquals(1, User::count());

    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'password' => 'password',
            'name' => 'test',
        ];
    }
}
