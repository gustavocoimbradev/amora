<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Reminder;
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
        // User::factory(3)->create()->each(function($user){
        //     Reminder::factory(30)->create(['user_id' => $user->id]);
        // });

        $user = User::factory()->create(['email' => 'test@email.com']);
        Reminder::factory()->create(['user_id' => $user]);

    }
}
