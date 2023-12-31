<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Post;
use Faker\Factory as FakerFactory;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->truncate();

        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {

            $title = $faker->sentence;
            $content = $faker->paragraph;

            Post::create([
                'title' => $title,
                'content' => $content,
                'slug' => Str::slug($title, '-'),
            ]);
        }
    }
}
