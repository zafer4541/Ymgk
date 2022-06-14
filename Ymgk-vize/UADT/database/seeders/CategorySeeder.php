<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $categoryArr = [
            [1,'Canlı Hayvanlar; Hayvansal Ürünler'],
            [2,'Bitkisel Ürünler'],
            [3,'Hayvansal, Bitkisel katı, Sıbı Yağlar, Bunların Parçaları;Hazır Yemeklik Katı Yağlar; Hayvansal veya Bitkisel Mumlar'],
            [4,'Gıda Sanayii Müstahzarları; Alkollü İçkiler ve Sirke; Tütün veya Tütün Yerine Geçen İşlenmiş Maddeler'],
            [5,'Mineral Maddeler'],
            [6,'Kimya Sanayii ve Buna Bağlı Sanayii Ürünleri'],
            [7,'Plastikler ve Mamulleri; Kauçuk ve Mamuller'],
            [8,'Ham Postlar, Deriler, Köseleler,Postlar Kürkler ve Bu Maddelerden Mamul Eşya; Saraciye Eşyası, Eyer, Koşum Takımları; Seyahat Eşyası, El Çantaları, Benzeri Mahfazalar; Hayvan Bağırsağından Mamul Eşya'],
            [9,'Ağaç, Ahşap Eşya; Odun Kömürü; Mantar, Mantardan Mamul Eşya; Sazdan veya Örülmeye Elverişli Diğer Maddelerden Mamuller; Sepetçi, Hasırcı Eşyası'],
            [10,'Odun,Diğer Lifli Selülozik Maddelerin Hamurları; Geri Kazanılmış Kağıt veya Karton; Kağıt, Karton ve Mamulleri'],
            [11 ,'Dokumaya Elverişli Maddeler ve Bunlardan Mamul Eşya'],
            [12,'Ayakkabılaar, Başlıklar, Şemsiyeler, Güneş Şemsiyeleri, Bastonlar, İskemle Bastonlar, Kemerler, Kırbaçlar ve Bunların Aksamı; Hazırlanmış Tüyler, Bunlardan Mamul Eşya; Yapma Çiçekler;İnsan Saçından Mamuller'],
            [13,'Taş, Alçı, Çimento, Amyant, Mika veya Benzeri Maddelerden Eşya; Seramik Mamuller; Cam ve Cam Eşya'],
            [14,'Tabii veya Kültür İncileri, Kiymetli veya Yarı Kıymetli Taşlar, Kıymetli Metaller, Kıymetli Metallerle Kaplama Metaller ve Bunlardan Mamul Eşya; Taklit Mücevherci Eşyası; Metal Paralar'],
            [15,'Adi Metaller ve Adi Metallerden Eşya'],
            [16,'Makinalar, Mekanik Cihazlar; Elektrik Malzemeleri; Bunların Aksam, Parçaları; Ses Kaydediciler, Kaydedilen Sesi Tekrar Vermeye Mahsus Cihazlar, Televizyon Görüntü, Ses Kaydedicileri, Kaydedilen Görüntü, Sesi Tekrar Vermeye Mahsus Cihazlar; Bunların Aksam, Parça Ve Teferruatı'],
            [17,'Nakil Vasıtaları'],
            [18,'Optik Alet-Cihazlar, Fotoğraf, Sinema, Ölçü, Kontrol, Ayar Alet-Cihazları, Tıbbi Veya Cerrahi Alet-Cihazlar; Saatçi Eşyası; Müzik Aletleri; Bunların Aksam, Parça-Aksesuarı'],
            [19,'Silahlar Ve Mühimmat; Bunların Aksam, Parça Ve Aksesuarı'],
            [20,'Muhtelif Mamul Eşya'],
            [21,'Sanat Eserleri, Koleksiyon Eşyası ve Antikalar'],

        ];

        for($i = 0 ; $i < count($categoryArr); $i++ ){
            Category::create([
                'id' => $categoryArr[$i][0],
                'name' => $categoryArr[$i][1],
            ]);
        }

    }
}
