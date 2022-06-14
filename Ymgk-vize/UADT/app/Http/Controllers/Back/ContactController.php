<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('back.page.contact.contact', compact('contacts'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'captcha' => 'required|captcha',
        ]);
        $attribute=[
            'name'=>'İsim',
            'description'=>'Açıklama',
            'email'=>'E-mail',
            'phone'=>'Telefon',
        ];
        $validator->setAttributeNames($attribute);

        if($validator->fails()) {
            return $validator->errors()->first();
        }
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->description = $request->description;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return "OK";


    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }



    public function destroy(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->delete();
        toastr()->success('Mesaj Başarıyla Silindi');
    }


    public function fetchContact()
    {
        $contacts = Contact::query()->where('deleted_at',null);

        return DataTables::of($contacts)->addColumn('description', function ($contacts) {
            return '<td>
                      <button id="button_message'.$contacts->id.'"
                     class="btn btn-sm btn-outline-primary"
                      value="'.$contacts->description.'"
                       onclick="showDetailMessage('.$contacts->id.')">
                       <strong>Mesajı Gör</strong>
                        </button>
                   </td>';

        })->addColumn('delete',function ($contacts){
            return '<td class="items-center">
                        <a title="Sil" id="deleteee" class="btn btn-sm btn-danger text-white"
                         onclick="delete_description('.$contacts->id.')">
                          <i class="bi bi-trash-fill"></i></a></td>';

        })->RawColumns(['description','delete'])->make(true);
    }
}
