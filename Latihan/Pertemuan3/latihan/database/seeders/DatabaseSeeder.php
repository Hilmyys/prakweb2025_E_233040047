<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Model\Category;
use Illuminate\Model\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
      use WithoutModelEvents;

    public function run(): void
    {
        $users = User::factory(5)->create();

        $cat1 = Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        $cat2 = Category::create([
            'name' => 'Personal Design',
            'slug' => 'personal-design'
        ]);

        Post::factory(10)
            ->recycle($users)
            ->recycle([$cat1, $cat2]) 
            ->create();
    }
}
