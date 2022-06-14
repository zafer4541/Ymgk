<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserFormController extends Controller
{
 public function index(){


     $category = Category::get();
     $country = Country::all();
     $city = City::all();

     return view('front.page.userForms',compact('category','country','city'));
 }


 public function store(Request $request){
     $validator = Validator::make($request->all(), [

         'country' => 'required',
         'company_name'=>'required|max:255',
         'company_address'=>'required|max:255',
         'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'company_type' => 'required',
         'company_foundation_year' => 'required|digits:4|Integer|min:1000|max:'.(date('Y')+1),
         'company_capital' => 'required|Integer',
         'company_number_employees' => 'required|Integer',

     ]);
     $attribute=[

         'country'=>'Ülke',
         'company_description'=>'Firma açıklaması',
         'company_name'=>'Firma ismi',
         'company_address'=>'Firma adresi',
         'company_mail'=>'Firma maili',
         'company_phone'=>'Firma telefonu',
         'company_type'=>'Firma türü',
         'company_capital'=>'Firmanın sermayesi',
         'company_foundation_year'=>'Kuruluş yılı',
         'company_number_employees'=>'Çalışan kişi sayısı',

     ];
     $validator->setAttributeNames($attribute);
     if($validator->fails()) {
         return redirect()->back()->withErrors($validator);
     }
     $userForm = Auth::user();
     $userForm->company_name = $request->company_name;
     $userForm->company_phone = $request->company_phone;
     $userForm->country = $request->country;
     $userForm->city = $request->city;
     $userForm->company_address = $request->company_address;
     $userForm->company_fax = $request->company_fax;
     $userForm->company_type = $request->company_type;
     $userForm->company_foundation_year = $request->company_foundation_year;
     $userForm->company_capital = $request->company_capital;
     $userForm->company_tax_administration = $request->company_tax_administration;
     $userForm->company_closed_area = $request->company_closed_area;
     $userForm->company_open_area = $request->company_open_area;
     $userForm->company_number_employees = $request->company_number_employees;
     $userForm->company_document = $request->company_document;
     $userForm->company_description = $request->company_description;

     if($request->hasFile('profile_photo_path')){
         $imageName = Str::slug($request->company_name).'.'.$request->profile_photo_path->getClientOriginalExtension();
         $request->profile_photo_path->move(public_path('uploads/userProfilePhoto'),$imageName);
         $userForm->profile_photo_path = '/userProfilePhoto/'.$imageName;
     }
     if($request->has('is_published')){
         $userForm->is_published = $request->input('is_published');
     }else{
         $userForm->is_published = 0;
     }
     $userForm->save();
     foreach ($request->category as $data){
         $user_category=new UserCategory();
         $user_category->user_id=Auth::user()->id;
         $user_category->category_id=$data;
         $user_category->save();
     }
     return redirect()->route('front.documents');
 }

}
