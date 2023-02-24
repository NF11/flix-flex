<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Database\Seeders\AppSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shouldReturnAListOfContent()
    {
        $response = $this->actingAs(User::first())->get('/api/contents');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function shouldNotReturnAListOfContentForGuest()
    {
        $response = $this->json('get', '/api/contents');
        $response->assertStatus(401);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AppSeeder::class);
    }
}
