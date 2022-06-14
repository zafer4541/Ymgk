<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::all()->first();
        return view('back.page.about.about')->with(['about' => $about]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:10240'
        ]);
        if (About::orderBy('id', 'DESC')->first() !== null) {
            $about = About::all()->first();
            if ($request->hasFile('image')) {
                $oldImage = public_path() . $about->image;
                //dosyanın olup olmadığının kontrolünü sağlayıp image var ise sil yeni geleni al
                if (file_exists($oldImage)) {
                    $oldImage = public_path() . $about->image;
                    unlink($oldImage);
                }
            }
        }
        else {
            $about = new About();
        }

        $about->title = $request->title;
        $about->description = $request->description;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $about->image = '/uploads/' . $imageName;
        }
        $about->save();
        $success = 'Hakkımızda başarıyla güncellendi';
        return redirect()->route('back.web.about')->with('addAboutSuccess', $success);

    }
}
