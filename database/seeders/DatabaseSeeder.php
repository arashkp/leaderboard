<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Forth',
            'age' => 30,
            'points' => 25,
            'address' => '2614 St George Street, Vancouver',
        ]);

        User::create([
            'name' => 'Noah',
            'age' => 25,
            'points' => 18,
            'address' => '4904 Robson St, Vancouver',
        ]);

        User::create([
            'name' => 'James',
            'age' => 35,
            'points' => 17,
            'address' => '42895 Nootka Street, Vancouver',
        ]);

        User::create([
            'name' => 'Olivia',
            'age' => 40,
            'points' => 5,
            'address' => '785 Hastings Street, Vancouver',
        ]);
    }
}
