<?php

namespace Database\Seeders;

use App\Enums\CategoryName;
use App\Models\Category;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create(
            [
                'name' => 'test_app',
                'password' => 'password'
            ]
        );
        Category::create(['name' => CategoryName::MOVIE]);
        Category::create(['name' => CategoryName::SERIES]);
        Content::factory(20)->create();
        $contents_id = Content::inRandomOrder()->limit(6)->pluck('id')->toArray();
        $user->favoriteContents()->attach($contents_id);

    }
}
