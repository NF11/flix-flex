<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Database\Seeders\AppSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoritesControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     */
    public function shouldReturnAListOfFavoritesContent()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/api/me/favorites');
        $response->assertStatus(200);
        $response->assertJsonCount($user->favoriteContents()->count(), 'data');
    }

    /**
     * @test
     */
    public function shouldAttachToFavorite()
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/api/contents/7/favorites');
        $response->assertStatus(200);
        $this->assertEquals(7, $user->favoriteContents->count());
        $this->assertTrue($user->isContentInFavorites(7));
    }

    /**
     * @test
     */
    public function shouldDetachToFavorite()
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/api/contents/1/favorites');
        $response->assertStatus(200);
        $this->assertFalse($user->isContentInFavorites(1));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AppSeeder::class);
    }
}
