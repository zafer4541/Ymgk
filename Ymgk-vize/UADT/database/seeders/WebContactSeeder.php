<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('web_contacts')->insert([
            'address'=>'Cumhuriyet Mah., Korgeneral Hulusi Sayın Caddesi No:117, 23100 Merkez/Elâzığ Merkez/Elazığ',
            'email'=>'UADT@gmail.com',
            'phone'=>'4242183500',
            'lat'=>'38.673959',
            'lng'=>'39.167401',
            'twitter'=>'https://twitter.com/elazigtso',
            'facebook'=>'https://www.facebook.com/elztso/',
            'linkedin'=>'linkedinlink',
            'instagram'=>'https://www.instagram.com/elazigtso/',
        ]);
    }
}
