<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1990-05-14',
            'about_me' => 'Software developer who loves clean code.',
        ]);

        User::factory()->create([
            'name' => 'Sarah Johnson',
            'username' => 'sarahj',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1988-11-02',
            'about_me' => 'Marketing specialist and content creator.',
        ]);

        User::factory()->create([
            'name' => 'Michael Brown',
            'username' => 'michaelb',
            'email' => 'michael@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1992-03-18',
            'about_me' => 'Entrepreneur and tech enthusiast.',
        ]);

        User::factory()->create([
            'name' => 'Emily Davis',
            'username' => 'emilyd',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1985-08-26',
            'about_me' => 'Photographer and travel enthusiast.',
        ]);

        User::factory()->create([
            'name' => 'William Wilson',
            'username' => 'williamw',
            'email' => 'william@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1995-01-12',
            'about_me' => 'Musician and fitness enthusiast.',
        ]);

        User::factory()->create([
            'name' => 'Olivia Taylor',
            'username' => 'olivia',
            'email' => 'olivia@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1998-06-24',
            'about_me' => 'Writer and animal lover.',
        ]);
    }
}