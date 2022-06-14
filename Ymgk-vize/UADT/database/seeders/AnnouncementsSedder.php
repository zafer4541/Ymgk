<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementsSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();

        DB::table('announcements')->insert([
            'title'=>'Uluslar Arası Dış Ticaret EĞİTİMLERİ BAŞLADI',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/1.jpeg',
            'description'=>'Uluslar Arası Dış Ticaret, TradeValley ve Harput Ajans İşbirliğinde Uluslar Arası Dış Ticaret 2021 Yılı Eğitim Takvimi kapsamında 01 Nisan 2021 tarihinde saat: 15.00-16.00 arasında “DÜNYA İŞİNİZE AÇIK” başlığı ile Dış Ticaret Bilgilendirme organizasyonu gerçekleştirilecektir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);

        DB::table('announcements')->insert([
            'title'=>'5174 Sayılı Kanun Gereği Yapılacak Askı İşlemleri Hakkında',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/2.png',
            'description'=>'5174 sayılı Kanunun 10. maddesi gereğince iki yıldır aidat ödemeyen ve/veya adresleri tespit edilemeyen üyelerin aidat tahakkukları durdurularak, bu üyeler meslek grupları ve seçmen listelerinden silinecektir.

                            Meslek grubu ve seçmen listelerinden silinen üyelerin adres ve durumları hakkında Odamıza bilgi verildiği ve/veya geçmiş dönem aidat borçları ödendiği takdirde tekrar aidat tahakkukları başlatılarak, meslek grubu ve seçmen listelerine yeniden kaydedilecektir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'Dış Ticarette Uzmanlaşma Eğitimleri ve Danışmanlık Programı…',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/3.jpeg',
            'description'=>'Fırat Kalkınma Ajansı destekleriyle, Türk Patent Enstitüsü işbirliğinde gerçekleştirilecek olan Program ile hiç ihracat yapmamış firmalarımızın dış ticaret süreçlerine adaptasyonu sağlanacak ve hâlihazırda ihracat yapan firmalarımızın ise bu konudaki yetenekleri geliştirilecektir. Belirlenecek 18 firmanın mevcut durum ve ihtiyaç analizi çalışmaları, ihracata uygun ürün(ler) ve ihracat stratejilerinin belirlenmesi, hedef pazarların tespiti ve pazar analizi, görünürlük ve tanıtım faaliyetleri, hedef pazarlardaki potansiyel müşterilerle irtibatın kurulması ve potansiyel alıcılarla yürütülecek süreçlerde mentorluk, uzman danışmanlarca sağlanacaktır. Bu kapsamda Elazığ tanıtım programı 29-30 Eylül 2021 Saat: 09:00 - 17:00 saatlerinde Elazığ TSO Konferans Salonunda gerçekleştirilecektir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'Kosova-Banka İzlenimi Veren Şirketler',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/Tsologo.jpg',
            'description'=>'Türkiye Odalar ve Borsalar Birliğinden alınan yazıda, Ticaret Bakanlığına Priştine Büyükelçiliği Ticaret Müşavirliğinden iletilen yazıya atfen, çeşitli kuruluşların Kosovada banka unvanı ile şirket açtıkları, ülkemizde bu şirketlerin şubeleri gibi hareket ederek piyasaya çek, teminat mektubu vb. evrak sundukları belirtilmektedir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'Uluslararası Havacılık ve Savunma Fuarı',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/Tsologo.jpg',
            'description'=>"Türkiye Odalar ve Borsalar Birliği'nden alınan yazıda, Tunus Büyükelçiliği'nin yazısına atfen, 11-15 Mayıs 2022 tarihleri arasında Tunus'ta 2. Uluslararası Havacılık ve Savunma Fuarı'nın (IADE 2022) gerçekleştirileceği bildirilmektedir.
                            Söz konusu Fuar kapsamında, havacılık, uzay ve savunma sektörlerinde faaliyet gösteren firmalara yönelik olarak B2B, workshop ve forumlar düzenlenecek olup ayrıntılı bilgiye https://www.iadetunisia.com/ adresinden ulaşılabileceği hususunu bilgilerinize sunarız.",
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'23. Mostar Uluslararası Ekonomi Fuarı',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/Tsologo.jpg',
            'description'=>'Sayın Üyemiz,
                            Türkiye Odalar ve Borsalar Birliği’nden Odamıza gelen yazıda,
                            Dışişleri Bakanlığı’nın 22.12.2021 tarih ve 33680026 sayılı ilgi yazıda, Macaristan’ın paydaş ülke olarak katılımıyla, 5-9 Nisan 2022 tarihlerinde düzenlenecek 23. Mostar Uluslararası Ekonomi Fuarı ile ilgili bilgi verilmekte olup, söz konusu Fuarın katılım formu ekte iletilmektedir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'CONNECTİNG EUROPEAN CHAMBERS DAVET YAZISI HK.',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/7.jpeg',
            'description'=>'Sayın Üyemiz,
                            Birliğimiz üyesi olduğu ve Birliğimiz Başkanı M. Rifat Hisarcıklıoğlu’nun Başkan Yardımcılığını yürüttüğü Avrupa Ticaret ve Sanayi Odaları Birliği (EUROCHAMBERS) tarafından 29 Haziran – 1 Temmuz 2021 tarihleri arasında Avrupa’daki bütün yerel/bölgesel odaların davetli olduğu “Connecting European Chambers” adlı etkinlik düzenlenecektir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'TOBB Nefes Kredisi nde Ciro Kaybı Kriteri Kaldırıldı',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/8.jpeg',
            'description'=>'Küçük ve Orta Ölçekli İşletmelerin (KOBİ) finansman sorunlarının giderilmesine katkı sağlamak üzere  hayata geçen Nefes Kredisinde, Oda/Borsa ve Üyelerimizin talebiyle  Protokol imzalanan bankalar KGF ye ödenecek %0,03 (onbinde üç) kefalet başvuru bedeli ve komisyonu ile %1 banka komisyonu dışında üyelerden herhangi bir masraf ve komisyon talep etmeyecektir. Kriteri Kaldırıldı. ',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'Mesleki Eğitim Merkezi Programına İlk Kayıt Tarihinin Uzatılması',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/Tsologo.jpg',
            'description'=>'Mesleki eğitim merkezi programına öğrenci kayıt, nakil ve geçişleri hakkındaki ilgi (b) yazımız ile ilgi (a) Yönetmelik hükümleri çerçevesinde mesleki eğitim merkezi programına ilk kayıt ile nakil ve geçiş tarihleri açıklanmıştır.
                            İlgi (b) yazımızda özetle: İlgi (a) Yönetmeliğin "Kayıt İşlemleri" başlıklı 22 nci maddesinin dokuzuncu fıkrası kapsamında, mesleki eğitim merkezi programına ilk defa kayıt olacakların aralık ayının son iş gününe kadar kayıt yaptırmaları halinde eğitimlerine mevcut sınıflarında dönem kaybetmeden devam edecekleri belirtilmiştir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);
        DB::table('announcements')->insert([
            'title'=>'Washington, Londra ve Lefkoşa Ticaret Müşavirlikleri İhracatı Geliştirme Toplantısı',
            'isPublished'=>rand(0,1),
            'image'=>'/uploads/duyurular/10.jpeg',
            'description'=>'nayi ve Teknoloji Bakanlığı ile Ticaret Bakanlığı işbirliğinde Kalkınma Ajansları ve Ticaret Müşavirliklerini bir araya getirecek çevrimiçi toplantılar serisi düzenlenecektir. Bu kapsamda TRB1 Bölgemizden firmaların katılımlarına açık olarak düzenlenecek ve firmalarımızı ilgili ülkenin Ticaret Müşavirleriyle bir araya getirecek ilk toplantı 22 Haziran 2021 Salı günü saat 17:00’da Washington Ticaret Müşavirliği ile gerçekleştirilecektir. 24 Haziran 2021 Perşembe günü saat 14:00’da ise Londra ve Lefkoşa Ticaret Müşavirlikleriyle toplantılar gerçekleştirilecektir.',
            'created_at'=>$faker->date('Y-m-d H:i:s')
        ]);


    }

}
