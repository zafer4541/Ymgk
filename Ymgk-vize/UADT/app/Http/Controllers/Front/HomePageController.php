<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Announcements;
use App\Models\News;
use App\Models\UserHeader;
use App\Models\WebContact;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = WebContact::first();
        $header = UserHeader::all()->first();
        $insideNews = News::where('type', 0)->where('isPublished', 1)->orderBy('id', 'DESC')->take(6)->get();
        $othersideNews = News::where('type', 1)->where('isPublished',1)->orderBy('id', 'DESC')->take(3)->get();
        $apiNews = News::where('type', 2)->where('isPublished', 1)->orderBy('id', 'DESC')->take(3)->get();
        $announcements = Announcements::where('isPublished', 1)->orderBy('id','DESC')->take(6)->get();

        return view('front.page.homePage', compact('header','contact', 'insideNews', 'othersideNews', 'apiNews', 'announcements'));
    }



    public function aboutShow(){
        $about = About::orderBy('id', 'DESC')->first();
        $contact = WebContact::all()->first();
        return view('front.page.about',compact('about','contact'));
    }


    function announcementDetail($id){
        $announcement = Announcements::find($id);
        return view('front.page.announcemetDetail',compact('announcement'));
    }
}
