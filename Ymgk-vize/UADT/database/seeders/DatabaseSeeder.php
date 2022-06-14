<?php

namespace Database\Seeders;

use App\Models\Export;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class  DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AboutSeeder::class);
        $this->call(AnnouncementsSedder::class);
        $this->call(CategorySeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(UserHeaderSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WebContactSeeder::class);

        //rol seeder

        \App\Models\User::factory(30)->create();
        \App\Models\Export::factory(30)->create();


    }
}
