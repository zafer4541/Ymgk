<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Export;

class ExportDetailController extends Controller
{
    public function index($id){

        $exportDetail = Export::find($id);
        return view('front.page.exportDetail',compact('exportDetail'));
    }
}
