<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Travel', 'Food', 'Finance', 'Entertainment', 'Sports', 'Science', 'Politics', 'Environment', 'Art', 'Culture', 'Business', 'Gaming', 'Fashion', 'History', 'Music', 'Photography'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        Post::factory(100)->create();
    }
}
