<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\UserHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserHeaderController extends Controller
{
    public function index()
    {
        $header = UserHeader::all()->first();
        return view('back.page.userHeader.userHeader')->with(['header'=>$header]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|max:255',
            'image'=>'image|mimes:jpeg,png,jpg|max:10000'
        ]);
        $attribute=[
            'title'=>'Başlık',
            'image'=>'Resim'
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $header = UserHeader::all()->first();
        $header->title = $request->title;

        if($request->hasFile('image')){
            $oldImage = public_path().$header->image;

            //dosyanın olup olmadığının kontrolünü sağlayıp image var ise sil yeni geleni al

            if(file_exists($oldImage)){
                $oldImage = public_path().$header->image;
                unlink($oldImage);
            }
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $header->image = '/uploads/'.$imageName;
        }
        $header->save();
        $success = 'Header alanı başarıyla güncellendi';
        return redirect()->route('back.header.update')->with('addHeaderSuccess',$success);

    }
}
