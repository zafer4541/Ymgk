<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Export;
use App\Models\UserCategory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCategoryIdControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userCategory=UserCategory::where('user_id','=',Auth::user()->id)->get();
        $exportCategory=Export::where('id','=',$request->id)->first();
        foreach ($userCategory as $data)
        {
            if ($exportCategory->category_id==$data->category_id){
                return $next($request);
            }
        }
        $error = 'Seçtiğiniz ihracat ilgi alanınızda olan kategorilerin içerisinde yer almamaktadır!';
        return redirect()->back()->withErrors($error);
    }
}
