<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Export;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;

class DashboardController extends Controller
{
    public function index()
    {
        $lastUsers = User::orderBy('id', 'DESC')->take(5)->get();
        $userCount = User::all()->count();
        $allUsers = User::where('role','user')->get();
        $exportCount = Export::all()->count();
        $totalUser = 0;
        foreach ($allUsers as $allUser){
            $totalUser ++;
        }
        $users = Auth::user();

        return view('back.dashboard',compact('users','totalUser', 'lastUsers', 'userCount', 'exportCount'));
    }

    function getDashboardExportChart(){
        $year = request('year');

        $jan = Export::whereMonth('request_date' , 1)->whereYear('request_date' , $year)->count();
        $feb = Export::whereMonth('request_date' , 2)->whereYear('request_date' , $year)->count();
        $mar = Export::whereMonth('request_date' , 3)->whereYear('request_date' , $year)->count();
        $apr = Export::whereMonth('request_date' , 4)->whereYear('request_date' , $year)->count();
        $may = Export::whereMonth('request_date' , 5)->whereYear('request_date' , $year)->count();
        $june = Export::whereMonth('request_date' , 6)->whereYear('request_date' , $year)->count();
        $july = Export::whereMonth('request_date' , 7)->whereYear('request_date' , $year)->count();
        $aug = Export::whereMonth('request_date' , 8)->whereYear('request_date' , $year)->count();
        $spt = Export::whereMonth('request_date' , 9)->whereYear('request_date' , $year)->count();
        $oct = Export::whereMonth('request_date' , 10)->whereYear('request_date' , $year)->count();
        $nov = Export::whereMonth('request_date' , 11)->whereYear('request_date' , $year)->count();
        $dec = Export::whereMonth('request_date' , 12)->whereYear('request_date' , $year)->count();

        return response()->json([
            'ayear' => $year,
            'jan' => $jan ,
            'fab' => $feb ,
            'mar' => $mar ,
            'apr' => $apr ,
            'may' => $may ,
            'june' => $june ,
            'july' => $july ,
            'aug' => $aug ,
            'sept' => $spt,
            'oct' => $oct ,
            'nov' => $nov ,
            'dec' => $dec ,
        ]);
    }
}
