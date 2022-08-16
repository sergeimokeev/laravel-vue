<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)
            ->has(Post::factory()->count(3))
            ->afterCreating(function ($user) {
                $user->id == 1 ? $user->roles()->attach(User::ADMIN_ROLE_ID) : false;
                $user->roles()->attach(User::AUTHOR_ROLE_ID);
            })
            ->create();
    }
}
