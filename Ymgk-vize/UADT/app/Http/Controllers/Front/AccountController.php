<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    public function index(){
        //$userData=User::find($id);
        $getCategories=UserCategory::where('user_id','=',Auth::user()->id)->get();
        $country=Country::where('id','=',\Illuminate\Support\Facades\Auth::user()->country)->first();
        $postCategories=[];
        foreach ($getCategories as $category){
            array_push($postCategories,Category::find($category->category_id));
        }

        return view('front.page.account',compact('postCategories','country'));
    }

    public function index2(){
        return view('front.page.documents');
    }

    function companyCardIndex(){
        $user = User::find(Auth::user()->id);
        return view('front.page.companyCard', compact('user'));
    }

}
