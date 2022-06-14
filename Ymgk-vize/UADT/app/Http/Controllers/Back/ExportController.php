<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Imports\DataImport;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Export;
use App\Models\Folder;
use App\Models\State;
use BaconQrCode\Common\EcBlock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use mysql_xdevapi\Exception;
use Smalot\PdfParser\Parser;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use function PHPUnit\Framework\isNull;

class ExportController extends Controller
{
    public function index() {
        $exports = Export::orderBy('created_at','desc')->get();
        //$item->where('categoruy_id'), Auth::user()->category_id;
       // $category = Category::get();
        return view('back.page.export.export',compact('exports'));
    }
    public function create() {

       $category = Category::get();
       $countries = Country::all();
        return view('back.page.export.exportCreate',compact('category', 'countries'));
    }

    function getCity(Request $request){
        $country = Country::where('name',$request->country)->first();
        $states = State::where('country_id',$country->id)->get();
        return response()->json($states);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|max:255',
            'country'=>'required',
            'city'=>'required',
            'description'=>'required',
            'company_name'=>'required|max:255',
            'company_address'=>'required|max:255',
            'company_mail'=>'required|max:255|email',
            'company_phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'total_quantity'=>'nullable|Integer',
            'request_date'=>'required',
            'deadline'=>'required',
            'category_id'=>'required'
        ]);
        $attribute=[
            'name'=>'İsim',
            'title'=>'Başlık',
            'country'=>'Ülke',
            'city'=>'Şehir',
            'description'=>'Açıklama',
            'company_name'=>'Firma ismi',
            'company_address'=>'Firma adresi',
            'company_mail'=>'Firma maili',
            'company_phone'=>'Firma telefonu',
            'total_quantity'=>'İhracat miktarı',
            'request_date'=>'İhracat başlangıç tarihi',
            'deadline'=>'İhracat son tarihi tarihi',
            'category_id'=>'Kategory',
            'email'=>'E-mail',
            'phone'=>'Telefon',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $export = new Export();
        $export->title = $request->title;
        $export->country = $request->country;
        $export->city = $request->city;
        $export->description = $request->description;
        $export->company_name = $request->company_name;
        $export->company_address = $request->company_address;
        $export->company_mail = $request->company_mail;
        $export->company_phone = $request->company_phone;
        $export->total_quantity = $request->total_quantity;
        $export->request_date = $request->request_date;
        $export->deadline = $request->deadline;
        $export -> type = 'manuel';
        $export -> managerId = Auth::user()->id;
        $export->category_id = $request->category_id;
        $export->save();

        return redirect()->route('back.export')->with('addExportSuccess','İhracat başarıyla eklendi');
    }

    public function edit($id)
    {
        $exports = Export::findOrFail($id);
        $category = Category::all();
        $countries = Country::all();
        return view('back.page.export.exportUpdate',compact('exports','category', 'countries'));
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'title'=>'required|max:255',
            'country'=>'required',
            'city'=>'required',
            'description'=>'required',
            'company_name'=>'required|max:255',
            'company_address'=>'required|max:255',
            'company_mail'=>'required|max:255',
            'company_phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'total_quantity'=>'nullable|Integer',
            'request_date'=>'required',
            'deadline'=>'required',
            'category_id'=>'required'
        ]);

        $attribute=[
            'name'=>'İsim',
            'title'=>'Başlık',
            'country'=>'Ülke',
            'city'=>'Şehir',
            'description'=>'Açıklama',
            'company_name'=>'Firma ismi',
            'company_address'=>'Firma adresi',
            'company_mail'=>'Firma maili',
            'company_phone'=>'Firma telefonu',
            'total_quantity'=>'İhracat miktarı',
            'request_date'=>'İhracat başlangıç tarihi',
            'deadline'=>'İhracat son tarihi tarihi',
            'category_id'=>'Kategory',
            'email'=>'E-mail',
            'phone'=>'Telefon',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $export = Export::findOrFail($request->id);
        $export->title = $request->title;
        $export->category_id =$request->category_id;
        $export->country = $request->country;
        $export->city = $request->city;
        $export->description = $request->description;
        $export->company_name = $request->company_name;
        $export->company_address = $request->company_address;
        $export->company_mail = $request->company_mail;
        $export->company_phone = $request->company_phone;
        $export->total_quantity = $request->total_quantity;
        $export->request_date = $request->request_date;
        $export->deadline = $request->deadline;
        $export -> type = 'manuel';
        $export -> managerId = Auth::user()->id;
        $export->save();
        return redirect()->route('back.export')->with('addExportSuccess','İhracat başarıyla güncellendi');
    }

    public function destroy(Request $request)
    {
        $exports = Export::findOrFail($request->id);
        $exports->delete();
    }

    public function upload(){
        return view('back.page.export.exportUpload');
    }

    public function uploadFile(Request $request){
        $validate = $request->validate([
            'file' => 'required|mimes:xls,xlsx,pdf',
        ]);
        if ($request->file->getClientOriginalExtension()=='xls' || $request->file->getClientOriginalExtension()=='xlsx') {
            try {
                $file = $request->file;
                $excel = Excel::toArray(new DataImport(), $file);

                if ($request->hasFile('file')) {
                    $fileName = Str::slug(str_replace($request->file->getClientOriginalExtension(), '', $request->file->getClientOriginalName())) . '.' . $request->file->getClientOriginalExtension();
                    $request->file->move(public_path('uploads'), $fileName);
                }
                foreach ($excel[0] as $item) {
                    if (is_null($item[0]) && is_null($item[1])){
                        break;
                    }
                    else{
                        if ($item[0]!="Export title"){
                            $row = new Export();
                            $row->title = $item[0];
                            $row->description = $item[1];
                            $row->total_quantity = $item[2];
                            $row->country = $item[3];
                            $row->city = $item[4];
                            $row->company_name = $item[5];
                            $row->company_address = $item[6];
                            $row->company_phone = $item[7];
                            $row->company_mail = $item[8];
                            $row->request_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$item[9]);
                            $row->deadline = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$item[10]);
                            $row->type = 'excel';
                            $row->managerId = Auth::user()->id;
                            $row->save();
                            $dosya_yolu = new Folder();
                            $dosya_yolu->url = '/uploads/' . $fileName;
                            $dosya_yolu->modulName = 'export';
                            $dosya_yolu->modulId = $row->id;
                            $dosya_yolu->save();
                        }else{
                            continue;
                        }
                    }
                }
                $success = 'İhracat başarıyla eklendi';
                return redirect()->route('back.export')->with('addExportSuccess',$success);
            }
            catch (\Exception $e)
            { $error=$e->getMessage();
                return redirect()->back()->with('error',$error);
            }

        }
        elseif ($request->file->getClientOriginalExtension()=='pdf') {
            try {
                $pdfParser = new Parser();
                $pdf = $pdfParser->parseFile($request->file('file'));
                $content = $pdf->getText();
                $textArr = explode("\t \t\n"  ,$content);
                if ($request->hasFile('file')) {
                    $fileName = Str::slug(str_replace($request->file->getClientOriginalExtension(), '', $request->file->getClientOriginalName())) . '.' . $request->file->getClientOriginalExtension();
                    $request->file->move(public_path('uploads'), $fileName);
                }
                $file = new Export();
                $file->title = $textArr[0];
                $file->description= $textArr[1];
                $file->country = $textArr[2];
                $file->city = $textArr[3];
                $file->company_name = $textArr[4];
                $file->company_address = $textArr[5];
                $file->company_phone = $textArr[6];
                $file->company_mail = $textArr[7];

                $category=Category::where('name','=',$textArr[8])->first();
                if (!is_null($category)){
                    $file->category_id = ($category->sub_id==0)?$category->id:$category->sub_id;
                }
                $file->total_quantity = $textArr[9];
                $file->deadline = Carbon::parse($textArr[10]);
                $file->request_date = Carbon::parse($textArr[11]);
                $file->type = 'pdf';
                $file->managerId = Auth::user()->id;
                $file->save();

                $dosya_yolu = new Folder();
                $dosya_yolu->url = '/uploads/' . $fileName;
                $dosya_yolu->modulName = 'export';
                $dosya_yolu->modulId = $file->id;
                $dosya_yolu->save();
                $success = 'İhracat başarıyla eklendi.';
                return redirect()->route('back.export')->with('addExportSuccess',$success);
            }
            catch (\Exception $e)
            { $error='İçeriğiniz uygun formatta değildir.';
                return redirect()->back()->with('error',$error);
            }
        }
    }
        public function getApi(){
        $response = Http::get('https://proendx.com/api/ihracat_test_verileri');
        $datas = json_decode($response->getBody());
            foreach ($datas as $data){
                $export = new Export();
                $export->title = $data->title;
                $export->description = $data->description;
                $export->country = $data->country;
                $export->city = $data->city;
                $export->phone = $data->phone;
                $export->mail = $data->mail;
                $export->address = $data->address;
                $export->isPublished = $data->isPublished;
                $export->deadline = $data->deadline;
                $export->type = $data->type;
                $export->managerId = $data->managerId;

                $export->save();
            }
            return redirect()->route('back.export')->with('addExportSuccess','Veriler Başarıyla Aktarıldı');
        }
    public function fetchInfo(){
        $id = request('id');
        $export = Export::select('title','description')->where('id','=',$id)->first();
        return response()->json($export);
    }

    public function fetchNews(){
            $export = Export::query()->where('deleted_at', null)->orderBy('id','desc');

            return DataTables::of($export)
                ->addColumn('switch',function ($export){
                    $check = ($export->isPublished==1) ? 'checked':'';
                    return  '<input class="switch" onchange="getToggleValue('.$export->id.' , this)" id="'.$export->id.'" data-on="Aktif" type="checkbox" '.$check.' data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"/>';

                })

                ->addColumn('category',function ($export){
                    $category = isset($export->category_id) ? Category::find($export->category_id)->name : 'seçilmedi' ;
                    return mb_substr($category,0,50,"utf-8").(strlen($category) > 50 ? '...':'');
                })
                ->addColumn('crud' , function($export){
                    return ' <td>
                                    <a  href="'.route('back.export.update',$export->id).'" class="btn  btn-warning"> Güncelle/Detay </a>
                                        <a  id="delete" class="btn  btn-danger text-white" onclick="delete_exports('.$export->id.')">
                                        <i class="bi bi-trash" ></i>
                                    </a>
                                </td>';
                })
                ->rawColumns(['id','switch','crud','category'])
                ->make(true);
        }

    public function changeStatus(Request $request){
        $news = Export::find($request->id);
        $news->isPublished = $request->isPublished ;
        $news->save();
    }
}
