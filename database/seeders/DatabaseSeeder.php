<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\News;
use App\Models\Product;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();
        News::factory()->count(5)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'role' => 'admin',
            'birth_date' => '0-00-00',
        ]);
        Product::truncate();
        Product::factory()->count(8)->create();
        Category::factory()->count(5)->create()->each(function ($category) {
            Faq::factory()->count(3)->create([
                'category_id' => $category->id
            ]);
        });

        News::all()->each(function ($news) {
            Comment::factory()->count(3)->create([
                'news_id' => $news->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
