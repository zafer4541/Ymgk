<?php

use App\Http\Controllers\Back\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\Front\WebContactController as FrontWebContactController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Back\AboutController;
use App\Http\Controllers\Back\AnnouncementsController;
use App\Http\Controllers\Back\ContactController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ExportController;
use App\Http\Controllers\Back\NewsController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\Back\WebContactController;
use App\Http\Controllers\Front\LoginHomePageController;
use App\Http\Controllers\Front\UserFormController;
use App\Http\Controllers\Front\SmartSearchController;
use App\Http\Controllers\Front\ExportDetailController;
use App\Http\Controllers\Front\ExportOpportunitiesController;
use App\Http\Controllers\Back\UserHeaderController;
use App\Http\Controllers\Front\ProfileCardController;

Route::middleware(['auth'])->group(function () {

    Route::get('/ihracatFirsatlar',[ExportOpportunitiesController::class,'index'])->name('front.ihracatFirsatlari');

    Route::get('/akilliArama',[SmartSearchController::class,'index'])->name('front.akilliArama');

    Route::get('/hesabim',[AccountController::class,'index'])->name('front.account.index');
    Route::get('/companyCardIndex',[AccountController::class,'companyCardIndex'])->name('front.account.companyCardIndex');

    Route::get('/Profile/account',[ProfileCardController::class,'profileAccount'])->name('front.profileAccount');

    Route::get('/ihracat-detay/{id}',[ExportDetailController::class,'index'])->name('front.smartsearch.ihracatDetay');
    Route::middleware(['userCategoryIdControl'])->group(function (){

        Route::get('/ihracatDetay/{id}',[ExportDetailController::class,'index'])->name('front.ihracatDetay');

    });

    Route::middleware(['userIdControl'])->group(function () {
        Route::get('/profile/{id}', [ProfileCardController::class, 'index'])->name('front.profile');
        Route::post('/profile/update/{id}', [ProfileCardController::class, 'update'])->name('front.profile.update');
    });
});
Route::get('/',[HomePageController::class,'index'])->name('front.homePage');
Route::get('/hakkimizda',[HomePageController::class,'aboutShow'])->name('front.about');
Route::get('/contact',[FrontWebContactController::class,'index'])->name('front.contact');
Route::post('/contactPost',[ContactController::class,'store'])->name('back.contact.store');
Route::get('/contactPost',[ContactController::class,'store'])->name('back.contact.store');
Route::get('/userForm',[UserFormController::class,'index'])->name('front.page.userForms');
Route::post('/userForm',[UserFormController::class,'store'])->name('front.page.userForms');
Route::get('/haber/{id}', [NewsController::class, 'show'])->name('front.page.newsDetail');
Route::get('duyuru/{id}', [HomePageController::class, 'announcementDetail'])->name('front.announcementDetail');
Route::get('/kullanicilar/City',[UsersController::class ,'getCity'])->name('back.getCity');

Route::prefix('panel')->middleware(['auth','isAdmin'])->group(function (){
    //Dashboard
    Route::get('/',[DashboardController::class ,'index'])->name('back.dashboard');
    Route::get('/getDashboardExportChart',[DashboardController::class ,'getDashboardExportChart'])->name('back.getDashboardExportChart');

    //users
    Route::get('/kullanicilar',[UsersController::class ,'index'])->name('back.users');
    Route::get('/kullanicilar/ekle',[UsersController::class ,'create'])->name('back.users.create');
    Route::post('/kullanicilar/ekle',[UsersController::class ,'store'])->name('back.users.store');
    Route::post('/kullanicilar/sil',[UsersController::class ,'destroy'])->name('back.users.delete');
    Route::get('/kullanicilar/guncelle/{id}',[UsersController::class ,'edit'])->name('back.users.edit');
    Route::put('/kullanicilar/guncelle/{id}',[UsersController::class ,'update'])->name('back.users.update');
    Route::get('/kullanicilar/guncelle/{id}',[UsersController::class ,'edit'])->name('back.users.edit');
    Route::put('/kullanicilar/guncelle/{id}',[UsersController::class ,'update'])->name('back.users.update');
    Route::get('/kullanicilar/fetchUsers',[UsersController::class ,'fetchUsers'])->name('back.fetchUsers');

    //Contact
    Route::get('/iletisim',[ContactController::class ,'index'])->name('back.contact');
    Route::post('/iletisim/sil',[ContactController::class ,'destroy'])->name('back.contact.delete');
    Route::get('/iletisim/fetch',[ContactController::class,'fetchContact'])->name('back.contact.fetch');
    Route::get('/iletisim/captcha', [ContactController::class, 'reloadCaptcha'])->name('back.contact.reloadCaptcha');

    //About
    Route::get('/hakkinda',[AboutController::class ,'index'])->name('back.web.about');
    Route::put('/hakkinda',[AboutController::class ,'update'])->name('back.web.about.update');

    //News
    Route::group(['prefix'=>'haberler'],function (){
        Route::get('/',[NewsController::class ,'index'])->name('back.news');
        Route::post('/sil',[NewsController::class ,'destroy'])->name('back.news.delete');
        Route::get('/olustur',[NewsController::class ,'create'])->name('back.news.create');
        Route::post('/olustur/kaydet',[NewsController::class ,'store'])->name('back.news.store');
        Route::get('/duzenle/{id}',[NewsController::class ,'edit'])->name('back.news.edit');
        Route::put('/duzenle/{id}',[NewsController::class ,'update'])->name('back.news.update');

        Route::get('/fetchInfo' , [NewsController::class , 'fetchInfo'])->name('back.news.fetchInfo');
        Route::get('/fetchNews',[NewsController::class,'FetchNews'])->name('back.news.fetchNews');
        Route::post('/changeStatus',[NewsController::class,'changeStatus'])->name('back.news.changeStatus');
    });


    //Announcements
    Route::group(['prefix'=>'duyurular'],function (){
        Route::get('/',[AnnouncementsController::class ,'index'])->name('back.announcements');
        Route::post('/sil',[AnnouncementsController::class ,'destroy'])->name('back.announcements.delete');
        Route::get('/olustur',[AnnouncementsController::class ,'create'])->name('back.announcements.create');
        Route::post('/olustur/store',[AnnouncementsController::class ,'store'])->name('back.announcements.store');
        Route::get('/duzenle/{id}',[AnnouncementsController::class ,'edit'])->name('back.announcements.edit');
        Route::get('/switch',[AnnouncementsController::class ,'switch'])->name('back.announcements.switch');
        Route::put('/duzenle/{id}',[AnnouncementsController::class ,'update'])->name('back.announcements.update');

        Route::get('/fetchInfo' , [AnnouncementsController::class , 'fetchInfo'])->name('back.announcements.fetchInfo');
        Route::get('/FetchAnnouncements',[AnnouncementsController::class,'FetchAnnouncements'])->name('back.announcements.FetchAnnouncements');
        Route::post('/changeStatus',[AnnouncementsController::class,'changeStatus'])->name('back.announcements.changeStatus');
    });


    //contact
    Route::get('/web/iletisim',[WebContactController::class ,'index'])->name('back.web.contact');
    Route::put('/web/iletisim/guncelle',[WebContactController::class ,'update'])->name('back.web.contact.update');

    //regulation
Route::group(['prefix'=>'Header'],function(){
    Route::get('/güncelleme',[UserHeaderController::class,'index'])->name('back.header.update');
    Route::put('/güncelleme',[UserHeaderController::class ,'update'])->name('back.web.header.update');

});
    //İhracat Fırsatları
    Route::group(['prefix'=>'ihracatlar'],function (){
        Route::get('/',[ExportController::class ,'index'])->name('back.export');
        Route::get('/fetchInfo' , [ExportController::class , 'fetchInfo'])->name('back.export.fetchInfo');
        Route::get('/fetch',[ExportController::class ,'fetchNews'])->name('back.export.fetchNews');
        Route::post('/mevzuatlar/sil',[ExportController::class ,'destroy'])->name('back.export.delete');
        Route::get('/olustur',[ExportController::class ,'create'])->name('back.export.create');
        Route::get('/getExportCity',[ExportController::class ,'getCity'])->name('back.export.getCity');
        Route::post('/olustur/kaydet',[ExportController::class ,'store'])->name('back.export.store');
        Route::get('/duzenle/{id}',[ExportController::class ,'edit'])->name('back.export.edit');
        Route::get('/switch',[ExportController::class ,'changeStatus'])->name('back.export.switch');
        Route::post('/switch',[ExportController::class ,'changeStatus'])->name('back.export.switch');
        Route::post('/duzenle/{id}',[ExportController::class ,'update'])->name('back.export.update');
        Route::get('/dosya-yukleme',[ExportController::class ,'upload'])->name('back.export.upload');
        Route::post('/dosya-yukleme',[ExportController::class ,'uploadFile'])->name('back.export.uploadFile');
        Route::get('/api_istek',[ExportController::class ,'getApi'])->name('back.export.getapi');
     });


});
