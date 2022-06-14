<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Zaferin Firması ',
            'email'=>'Zaferin@gmail.com',
            'role'=>'admin',
            'city'=>'El Aziz',
            'country'=>'Turkiye',
            'email_verified_at' => now(),
            'created_at'=>now(),
            'password' => '$2y$10$YpbtLZtB8tXtAZGLYUUSrerSls8zrZBsPL4JuBQ1dRP/x6b7EOeV2', // 8pnHmTVJ};8+
            'remember_token' => Str::random(10),
        ]);
    }
}
