<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        $this->call([
            GameSeeder::class,
            TrickSeeder::class,
        ]);
    }
}
