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

class ProfileCardController extends Controller
{
    public function index(){

        $id = Auth::user()->id;
        $users = Auth::user();
        $country = Country::all();
        $city = City::all();
        $password = Str::random();
        $category = Category::all();
        $userInformation = User::findOrFail($id);

        return view('front.page.userProfileEdit',compact('users',  'country', 'city','password','userInformation','category'));
    }

    function getCity(Request $request)
    {
        $cities = State::where('country_id', $request->country)->get();

        return response()->json($cities);
    }

    public function profileAccount(){
        return view('profile.profileUpdate');
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'city' => 'required',
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
            'name'=>'İsim',
            'country'=>'Ülke',
            'city'=>'Şehir',
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

        $user = User::findOrFail($id);

        $user->name = $request->name;

        if ($request->password != null and $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->company_name = $request->company_name;
        $user->company_phone = $request->company_phone;

        $user->country = $request->country;
        $user->city = $request->city;
        $user->company_address = $request->company_address;
        $user->company_description = $request->company_description;
        $user->company_fax = $request->company_fax;
        $user->company_web = $request->company_web;
        $user->company_type = $request->company_type;
        $user->company_foundation_year = $request->company_foundation_year;
        $user->company_capital = $request->company_capital;
        $user->company_tax_administration = $request->company_tax_administration;
        $user->company_closed_area = $request->company_closed_area;
        $user->company_open_area = $request->company_open_area;
        $user->company_number_employees = $request->company_number_employees;
        $user->company_document = $request->company_document;

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile'), $imageName);
            $user->profile_photo_path = '/profile/' . $imageName;
        }
        foreach ($request->category as $data){
            $user_category=new UserCategory();
            $user_category->user_id=Auth::user()->id;
            $user_category->category_id=$data;
            $user_category->save();
        }

        $user->save();
        return redirect()->route('front.account.index')->with('addUsersSuccess', 'Başarıyla güncellendi');
    }




}
