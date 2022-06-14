<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AnnouncementsController extends Controller
{

    public function index()
    {
        $announcements=Announcements::orderBy('created_at','desc')->get();
        return view('back.page.announcements.announcements',compact('announcements'));
    }

    public function create()
    {
        return view('back.page.announcements.announcementsCreate');
    }
    public function FetchAnnouncements(){
        $announcements = Announcements::query();

        return DataTables::of($announcements)
            ->addColumn('detail' , function ($announcements){
                return '<button class="btn btn-sm btn-outline-primary" onclick="showDetailMessage('.$announcements->id.')">Detayları göster</button>';
            })
            ->addColumn('delete',function ($announcements){
                return '<button id="button_message" onclick="deleteAnnouncements('.$announcements->id.')" class="btn btn-danger""><i class="bi bi-trash"></i></button>'.' '.'<a href="'.route('back.announcements.update',$announcements->id).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
            })
            ->addColumn('image',function ($announcements){
                return    ' <div class="d-flex justify-content-center">
                              <img src="'.$announcements->image.'" alt="..." class="bg-gray-200 h-16 w-16 object-cover" >
                            </div> ';
            })
            ->addColumn('toggle' , function($announcements){
                $check = ($announcements->isPublished==1) ? 'checked':'';
                return  '<input class="switch" onchange="getToggleValue('.$announcements->id.' , this)" id="'.$announcements->id.'" data-on="Aktif" type="checkbox" '.$check.' data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"/>';
            })


            ->rawColumns(['detail','description','image','delete','update','toggle'])
            ->make(true);
    }

    public function fetchInfo(){
        $id = request('id');
        $announcements = Announcements::find($id);
        return response()->json($announcements);
    }

    public function changeStatus(Request $request){
        $announcements = Announcements::find($request->id);
        $announcements->isPublished = $request->isPublished ;
        $announcements->save();

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|max:255',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:10000'
        ]);
        $attribute=[
            'title'=>'Başlık',
            'description'=>'Açıklama',
            'image'=>'Resim',

        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
            $request->validate([
                'title'=>'required|max:255',
                'description'=>'required',
                'image'=>'required|image|mimes:jpeg,png,jpg|max:10000'
            ]);
            $announcement = new Announcements();
            $announcement->title = $request->title;
            $announcement->description = $request->description;

            if($request->hasFile('image')){
                $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads'),$imageName);
                $announcement->image = '/uploads/'.$imageName;
            }

            $announcement->save();
            $success = 'Duyuru başarıyla eklendi';
            return redirect()->route('back.announcements')->with('addAnnouncementsSuccess',$success);

        }

    public function edit($id)
    {
        $announcements = Announcements::findOrFail($id);
        return view('back.page.announcements.announcementsUpdate',compact('announcements'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|max:255',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:10000'
        ]);
        $attribute=[
            'title'=>'Başlık',
            'description'=>'Açıklama',
            'image'=>'Resim',

        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
            'image'=>' image|mimes:jpeg,png,jpg|max:10000'
        ]);

        $announcements = Announcements::findOrFail($id);


        $announcements->title = $request->title;
        $announcements->description = $request->description;

        if($request->hasFile('image')){
            $oldImage = public_path().$announcements->image;

            //dosyanın olup olmadığının kontrolünü sağlayıp image var ise sil yeni geleni al

            if(file_exists($oldImage)){
                $oldImage = public_path().$announcements->image;

                unlink($oldImage);
            }
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $announcements->image = '/uploads/'.$imageName;
        }

        $announcements->save();

        $success = 'Duyuru başarıyla güncellendi';

        return redirect()->route('back.announcements')->with('addAnnouncementsSuccess',$success);
    }


    public function destroy(Request $request){
        $news = Announcements::findOrFail($request->id);
        $news->delete();

    }


}
