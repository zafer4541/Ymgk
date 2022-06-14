<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use UxWeb\SweetAlert\SweetAlert;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    public function index()
    {      $news=News::orderBy('created_at','desc')->get();
        return view('back.page.news.news',compact('news'));
    }

    public function create()
    {
        return view('back.page.news.newsCreate');
    }

    public function FetchNews(){
        $news = News::query()->where('deleted_at', null);

        return DataTables::of($news)
            ->addColumn('detail' , function ($news){
                    return '<button class="btn btn-sm btn-outline-primary"  onclick="showDetailMessage('.$news->id.')">Detayları göster</button>';
            })
            ->addColumn('delete',function ($news){
                    return '<button id="button_message" onclick="deleteNews('.$news->id.')" class="btn btn-danger"><i class="bi bi-trash"></i></button>'.' '.'<a href="'.route('back.news.update',$news->id).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
            })
            ->addColumn('image',function ($news){

                return
                    '<div class="d-flex justify-content-center">
                         <img src="'.$news->image.'" alt="..." class="bg-gray-200 h-16 w-16  object-cover" >
                    </div>  ';
            })
            ->addColumn('toggle' , function($news){
                    $check = ($news->isPublished==1) ? 'checked':'';
                    return  '<input class="switch" onchange="getToggleValue('.$news->id.' , this)" id="'.$news->id.'" data-on="Aktif" type="checkbox" '.$check.' data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"/>';
            })
            ->rawColumns(['detail','description','image','delete','update','toggle'])
            ->make(true);
    }

    public function fetchInfo(){
        $id = request('id');
        $news = News::find($id);
        return response()->json($news);
    }

   public function changeStatus(Request $request){
       $news = News::find($request->id);
       $news->isPublished = $request->isPublished ;
       $news->save();
   }

    public function store(Request $request)
    {
        if ($request->newsType == '0'){
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'description'=>'required',
                'image'=>'required|image|mimes:jpeg,png,jpg|max:10000',
                'newsType' => 'required']);

        }
        else {
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'newsUrl'=>'required',
                'image'=>'required|image|mimes:jpeg,png,jpg|max:10000',
                'newsType' => 'required']);
        }

        $attribute=[
            'title'=>'Başlık',
            'description'=>'Açıklama',
            'image'=>'Resim',
            'newsType' => 'Haber Tipi',
            'newsUrl' => 'Haber Url',
        ];

        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $news->type = $request->newsType;
        if ($request->newsType == '1'){
            $news->url = $request->newsUrl;
        }
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $news->image = '/uploads/'.$imageName;
        }
        $news->save();
        $success = 'Haber başarıyla eklendi';
        return redirect()->route('back.news')->with('addNewsSuccess',$success);
    }

    public function show($id)
    {
        $news = News::find($id);

        return view('front.page.newsDetail', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('back.page.news.newsUpdate',compact('news'));
    }

    public function update(Request $request, $id)
    {
        if ($request->newsType == "0"){
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'description'=>'required',
                'image'=>'image|mimes:jpeg,png,jpg|max:10000',
                'newsType' => 'required']);
        }
        else {
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'description'=>'nullable',
                'newsUrl'=>'required',
                'image'=>'image|mimes:jpeg,png,jpg|max:10000',
                'newsType' => 'required']);
        }


        $attribute=[
            'title'=>'Başlık',
            'description'=>'Açıklama',
            'image'=>'Resim',
            'newsType' => 'Haber Tipi',
            'newsUrl' => 'Haber Url',
        ];

        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->type = $request->newsType;
        if ($request->newsType == '1'){
            $news->url = $request->newsUrl;
        }
        if($request->hasFile('image')){
            $oldImage = public_path().$news->image;
            //dosyanın olup olmadığının kontrolünü sağlayıp image var ise sil yeni geleni al

            if(file_exists($oldImage)){
                unlink($oldImage);
            }
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $news->image = '/uploads/'.$imageName;
        }
        $news->save();
        $success = 'Haber başarıyla güncellendi';
        return redirect()->route('back.news')->with('addNewsSuccess',$success);;
    }

    public function destroy(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->delete();

    }

    function fetchDailyNews(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.collectapi.com/news/getNews?country=tr&tag=economy",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "uft-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: apikey 71LE8Ps3ECNcPZIQCRqiiQ:2ooNJleDJyhMtZtW7IGvHK ",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }
        else {
            $daily = json_decode($response);
            foreach ($daily->result as $item) {
                $news = new News();
                $news->type = 2;
                $news->url = $item->url;
                $news->image = $item->image;
                $news->title = $item->name;
                $news->save();
            }

        }
    }



}
