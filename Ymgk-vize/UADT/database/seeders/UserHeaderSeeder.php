<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('header')->insert([
            'title'=>'Sizi bekleyen birden çok ihracat fırsatı mevcut. İlginizi çekebilecek haberleri aşağıda listeledik. Üst barda bulunun menüleri kullanarak sistemi dilediğiniz gibi kullanın.',

            'image'=>'/uploads/sizi-bekleyen-birden-cok-ihracat-firsati-mevcut-ilginizi-cekebilecek-haberleri-asagida-listeledik-ust-barda-bulunun-menuleri-kullanarak-sistemi-dilediginiz-gibi-kullanin.png',

        ]);
    }
}
