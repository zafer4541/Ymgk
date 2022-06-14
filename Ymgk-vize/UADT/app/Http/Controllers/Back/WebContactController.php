<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\WebContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebContactController extends Controller
{

    public function index()
    {
        $webContact = WebContact::all()->first();
        return view('back.page.webContact.webContact')->with(['webContact'=>$webContact]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address'=>'required|max:255',
            'email'=>'required|email|unique:users,email,NULL,deleted_at|max:255',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
        $attribute=[
            'address'=>'Açık Adres',
            'email'=>'E-mail Adresi',
            'phone'=>'Telefon Numarası',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $contact = WebContact::all()->first();
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        if (isset($request->lat)) {
            $contact->lat = $request->get('lat');
        } else {
            $contact->lat = 38.673959;
        }

        if (isset($request->lng)) {
            $contact->lng = $request->get('lng');
        } else {
            $contact->lng = 39.167401;
        }
        $contact->twitter = $request->twitter;
        $contact->facebook = $request->facebook;
        $contact->linkedin = $request->linkedin;
        $contact->instagram = $request->instagram;
        $contact->save();
        return redirect()->route('back.web.contact')->with('addWebContactSuccess','İletişim Bilgileri Başarıyla Güncellendi');
    }

    public function updateMap()
    {
        return view('back.page.contact.mapUpdate');
    }
}
