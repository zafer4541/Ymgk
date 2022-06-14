<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Export;
use Carbon\Carbon;

class SmartSearchController extends Controller
{
    public function index(){
        $today = Carbon::now()->format('Y-m-d h:i:s');
        $countries = Export::select('country')->groupBy('country')->get();
        $categories = Category::all();
        $exports = Export::where('request_date', '<=', $today)->where('deadline', '>=', $today)->where('isPublished', '1')->get();

        return view('front.page.smartSearch', compact('countries', 'categories', 'exports'));
    }
}
