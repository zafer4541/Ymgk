<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Export;

class ExportOpportunitiesController extends Controller
{
    public function index(){
        $export = Export::where('isPublished',1)->orderBy('id', 'DESC')->Paginate(9);

        return view('front.page.exportOpportunities',compact('export'));
    }
}
