<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert([
            'title'=>'ODAMIZ HAKKINDA',
            'image'=>'/uploads/hakkimizda/hakkimizdalogo.jpg',
            'description'=>'Dünyada Ticaretin ortaya çıkış XVl.yüzyılın sonralına rastlar. Ticaret Odası adını alan ilk kuruluş Marsilya Ticaret Odası olup, kuruluş yılı 1600’dür. Kuzey Amerika’da ilk Ticaret Odası 1768’de New York’ta kurulmuştur.  Kanada’da ilk Ticaret Odası ise 1804 yılında Halifax’ta açılmıştır.

Günümüzde batılı ülkelerin Ticaret ve Sanayi Odalarında müşterek olan husus, devlet otoritelerine ve işletmelere yönelik olan müşavirlik fonksiyonlarıdır.

Dünyadaki Ticaret ve Sanayi Odalarının bir ortak özelliği de milli, merkezi bir üst organizasyon içinde bir araya gelmeleridir. Ülkemizdeki örneği Türkiye Odalar ve Borsalar Birliği’dir.

Osmanlı toplumunda Oda fikri, batılaşma hareketleri ile birlikte gündeme gelmiştir. Bir dizi reform ve yenilikler içeren 1856 tarihli Islahat Fermanı, tüccarların odalar kurarak örgütlenmeleri gereğini ortaya çıkarmıştır. Ferman gereği nizamnameler yayımlanıp Odalar kurulmaya başlanmıştır.']);
    }
}
