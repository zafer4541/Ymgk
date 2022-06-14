<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Imports\DataImport;
use App\Models\City;
use App\Models\Country;
use App\Models\Folder;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $userInformations = User::all();
        return view('back.page.users.users', compact('users', 'userInformations'));
    }

    public function create()
    {
        $country = Country::all();
        $city = City::all();
        $password = Str::random();
        return view('back.page.users.userCreate', compact('password', 'country', 'city'));
    }

    function getCity(Request $request)
    {
        $cities = State::where('country_id', $request->country)->get();
        return response()->json($cities);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'min:8|required|max:255',
            'email' => 'required|email|unique:users,email,NULL,deleted_at|max:255',
            'country' => 'required',
            'company_name'=>'required|max:255',
            'company_address'=>'required|max:255',
            'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'company_type' => 'required',
            'company_foundation_year' => 'required|digits:4|Integer|min:1000|max:'.(date('Y')+1),
            'company_capital' => 'required|Integer',
            'company_number_employees' => 'required|Integer',
            'role' => 'required',
        ]);
        $attribute=[
            'name'=>'İsim',
            'password'=>'Şifre',
            'country'=>'Ülke',
            'company_description'=>'Firma Açıklaması',
            'company_name'=>'Firma ismi',
            'company_address'=>'Firma adresi',
            'company_mail'=>'Firma maili',
            'company_phone'=>'Firma telefonu',
            'company_type'=>'Firma türü',
            'email'=>'E-mail',
            'company_capital'=>'Firmanın Sermayesi',
            'company_foundation_year'=>'Kuruluş Yılı',
            'company_number_employees'=>'Çalışan kişi sayısı',
            'role'=>'Kullanıcı Yetkisi',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (User::where("email", "=", $request->email)->count() == 0) {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->password = Hash::make($request->password);
            $newUser->company_name = $request->company_name;
            $newUser->company_phone = $request->company_phone;
            $newUser->email = $request->email;
            $newUser->country = $request->country;
            $newUser->city = $request->city;
            $newUser->company_address = $request->company_address;
            $newUser->company_description = $request->company_description;
            $newUser->company_fax = $request->company_fax;
            $newUser->company_web = $request->company_web;
            $newUser->company_type = $request->company_type;
            $newUser->company_foundation_year = $request->company_foundation_year;
            $newUser->company_capital = $request->company_capital;
            $newUser->company_tax_administration = $request->company_tax_administration;
            $newUser->company_closed_area = $request->company_closed_area;
            $newUser->company_open_area = $request->company_open_area;
            $newUser->company_number_employees = $request->company_number_employees;
            $newUser->company_document = $request->company_document;
            $newUser->role = $request->role;

            if ($request->hasFile('image')) {
                $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('profile'), $imageName);
                $newUser->profile_photo_path = '/profile/' . $imageName;
            }
            $newUser->save();

            dispatch(new \App\Jobs\SendEmailJob("", $request->email, $request->password));
            return redirect()->route('back.users')->with('addUsersSuccess', 'Kullanıcı başarıyla eklendi');
        } else {
            return redirect()->route('back.users.create')->with('addUsersWarning', 'Aynı email adresi ile kayıtlı kullanıcı olduğundan kayıt işlemi yapılamadı!');
        }
    }
    public function edit($id)
    {
        $country = Country::all();
        $city = City::all();
        $users = Auth::user();
        $userInformation = User::findOrFail($id);
        return view('back.page.users.userUpdate', compact('users', 'userInformation', 'country', 'city'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'max:255',
            'email' => 'required|email|max:255',
            'city' => 'required',
            'country' => 'required',
            'company_name'=>'required|max:255',
            'company_address'=>'required|max:255',
            'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'company_type' => 'required',
            'company_foundation_year' => 'required|digits:4|Integer|min:1000|max:'.(date('Y')+1),
            'company_capital' => 'required|Integer',
            'company_number_employees' => 'required|Integer',
            'role' => 'required',
        ]);
        $attribute=[
            'name'=>'İsim',
            'password'=>'Şifre',
            'country'=>'Ülke',
            'city'=>'Şehir',
            'company_description'=>'Firma açıklaması',
            'company_name'=>'Firma ismi',
            'company_address'=>'Firma adresi',
            'company_mail'=>'Firma maili',
            'company_phone'=>'Firma telefonu',
            'company_type'=>'Firma türü',
            'email'=>'E-mail',
            'company_capital'=>'Firmanın sermayesi',
            'company_foundation_year'=>'Kuruluş yılı',
            'company_number_employees'=>'Çalışan kişi sayısı',
            'role'=>'Kullanıcı yetkisi',
            'company_open_area'=>'Açık alan',
            'company_closed_area'=>'Kapalı alan',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::findOrFail($id);
        $deletedUsers=User::onlyTrashed()->get();

        if (User::where('email','=',$request->email)->count() >0){
            if ($user->email!=$request->email)
                return redirect()->back()->withErrors("Değiştirmek istenilen e-mail önceden alınmış.");
        }

        //Eklenmek istenen kullanıcı maili silinmiş kullanıcılarda varmı diye kontrol ediyoruz
        foreach ($deletedUsers as $data){
            if ($request->email==$data->email){
                return redirect()->back()->withErrors("Bu e-mail alınamaz.");
            }
            else
                continue;
        }
        $user->name = $request->name;

        if ($request->password != null and $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->company_name = $request->company_name;
        $user->company_phone = $request->company_phone;
        $user->email = $request->email;
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

        $user->role = $request->role;
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile'), $imageName);
            $user->profile_photo_path = '/profile/' . $imageName;
        }
        $user->save();
        return redirect()->route('back.users')->with('addUsersSuccess', 'Kullanıcı başarıyla güncellendi');
    }

    public function destroy(Request $request)
    {
        if ($request->id == Auth::user()->id) {
            toastr()->error('Giriş yapan kullanıcı silinemez');
        } else {
            $user = User::find($request->id);
            $user->delete();
        }
    }

    public function fetchUsers()
    {
        $users = User::query()->where('deleted_at', null)->where('role', 'REGEXP', '[^adviser]');

        return DataTables::of($users)
            ->addColumn('type', function ($users) {
                $type = $users->role == 'employee' ? 'Personel' : ($users->role == 'adviser' ? 'Müşavir' : ($users->role == 'user' ? 'Kullanıcı' : 'Admin'));
                return '<td>' . $type . '</td>';
            })
            ->addColumn('crud', function ($users) {
                if (Auth::user()->role != 'employee') {
                    return '<td class="user-status">
                                 <a title="Sil"  id="delete" class="btn btn-sm btn-danger text-white"  onclick="delete_user(' . $users->id . ')">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a href="' . route('back.users.edit', $users->id) . '" title="Düzenle" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                            </td>';
                };
                return '<td> Yetki Yok </td> ';
            })
            ->rawColumns(['image', 'type', 'crud'])
            ->make(true);
    }

    public function adviserCreate()
    {
        $password = Str::random();
        $country = Country::all();
        $city = City::all();
        return view('back.page.users.adviser.adviserCreate', compact('password','city','country'));
    }

    public function adviserStore(Request $request)
    {

         $validator = Validator::make($request->all(), [
             'name' => 'required|max:255',
             'password' => 'min:8|required|max:255',
             'email' => 'required|email|unique:users,email,NULL,deleted_at|max:255',
             'company_address' => 'required|max:255',
             'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
             'country'=>'required',
             'city' => 'required',
            ]);
        $attribute=[
            'name'=>'İsim',
            'password'=>'Şifre',
            'email' => 'E-mail',
            'company_address' => 'Müşavir adresi',
            'company_phone' => 'Müşavir telefonu',
            'country'=>'Ülke',
            'city'=>'Şehir',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if (User::where("email", "=", $request->email)->count() == 0) {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->password = Hash::make($request->password);
            $newUser->company_phone = $request->company_phone;
            $newUser->email = $request->email;
            $newUser->country = $request->country;
            $newUser->city = $request->city;
            $newUser->company_address = $request->company_address;

            $newUser->company_fax = $request->company_fax;
            $newUser->role = 'adviser';
            if ($request->hasFile('image')) {
                $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('profile'), $imageName);
                $newUser->profile_photo_path = '/profile/' . $imageName;
            }
            $newUser->save();

            dispatch(new \App\Jobs\SendEmailJob("", $request->email, $request->password));
            return redirect()->route('back.users.adviser')->with('addUsersSuccess', 'Müşavir başarıyla eklendi');
        } else {
            return redirect()->route('back.users.adviserCreate')->with('addUsersWarning', 'Aynı email adresi ile kayıtlı kullanıcı olduğundan kayıt işlemi yapılamadı!');
        }
    }

    public function adviserEdit($id)
    {
        $country = Country::all();
        $city = City::all();
        $users = Auth::user();
        $userInformation = User::findOrFail($id);
        return view('back.page.users.adviser.adviserUpdate', compact('users','city','country', 'userInformation'));
    }

    public function adviserUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'max:255',
            'email' => 'required|email|max:255',
            'company_address' => 'required|max:255',
            'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'country' => 'required',
            'city' => 'required',
        ]);
        $attribute=[
            'name'=>'İsim',
            'password'=>'Şifre',
            'email' => 'E-mail',
            'company_address' => 'Müşavir adresi',
            'company_phone' => 'Müşavir telefonu',
            'country'=>'Ülke',
            'city'=>'Şehir',
        ];
        $validator->setAttributeNames($attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $user = User::findOrFail($id);
        $deletedUsers=User::onlyTrashed()->get();

        if (User::where('email','=',$request->email)->count() >0){
            if ($user->email!=$request->email)
                return redirect()->back()->withErrors("Değiştirmek istenilen e-mail önceden alınmış.");
        }

        //Eklenmek istenen kullanıcı maili silinmiş kullanıcılarda varmı diye kontrol ediyoruz
        foreach ($deletedUsers as $data){
            if ($request->email==$data->email){
                return redirect()->back()->withErrors("Bu e-mail alınamaz.");
            }
            else
                continue;
        }

        $user->name = $request->name;

        if ($request->password != null and $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->company_name = $request->company_name;
        $user->company_phone = $request->company_phone;
        $user->email = $request->email;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->company_address = $request->company_address;
        $user->company_description = $request->company_description;
        $user->role = $request->role;

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile'), $imageName);
            $user->profile_photo_path = '/profile/' . $imageName;
        }
        $user->save();
        return redirect()->route('back.users.adviser')->with('addUsersSuccess', 'Müşavir başarıyla güncellendi');
    }

    public function adviser()
    {
        $users = Auth::user();
        $userInformations = User::all();
        $usersAdviser = User::query()->where('role', 'adviser');

        return view('back.page.users.adviser.adviser', compact('users', 'userInformations', 'usersAdviser'));
    }

    public function adviserDestroy(Request $request)
    {
        if ($request->id == Auth::user()->id) {
            toastr()->error('Giriş yapan kullanıcı silinemez');
        } else {
            $user = User::find($request->id);
            $user->delete();
        }
    }

    public function adviserUpload()
    {
        return view('back.page.users.adviser.adviserUpload');
    }

    public function adviserUploadFile(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        if ($request->file->getClientOriginalExtension() == 'xlsx' || $request->file->getClientOriginalExtension() == 'xls') {
            try {
                $file = $request->file;
                $excel = Excel::toArray(new DataImport(), $file);
                foreach ($excel[0] as $item) {
                    if (!is_null($item[0])) {
                        if ($item[0] != "name") {
                            if ((isset($item[8]))){
                                return redirect()->back()->with('error', 'İçeriğiniz uygun formatta değildir');
                            }
                            $row = new User();
                            $row->name = $item[0];
                            $row->password = Hash::make($item[1]);
                            $row->company_phone = $item[2];
                            $row->country = $item[3];
                            $row->city = $item[4];
                            $row->company_address = $item[5];
                            $row->email = $item[6];
                            $row->company_fax = $item[7];
                            $row->role = 'adviser';
                            $row->save();
                        }
                    } else
                        break;
                }
                $success = 'Müşavirler başarıyla içeriye aktarıldı.';
                return redirect()->route('back.users.adviser')->with('addUsersSuccess', $success);

            } catch (\Exception $e) {
                $error = 'İçeriğiniz uygun formatta değildir';
                return redirect()->back()->with('error', $error);
            }
        }
    }

    public function fetchAdviser()
    {
        $users = User::query()->where('role', 'adviser');

        return DataTables::of($users)
            ->addColumn('country', function ($users) {
                return  is_numeric($users->country)?Country::where('id','=',$users->country)->first()->name:$users->country;
            })
            ->addColumn('crud', function ($users) {
                if (Auth::user()->role != 'employee') {
                    return '<td class="user-status">
                                 <a title="Sil"  id="delete" class="btn btn-sm btn-danger text-white"  onclick="delete_user(' . $users->id . ')">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a href="' . route('back.users.adviserEdit', $users->id) . '" title="Düzenle" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                            </td>';
                };
                return '<td> Yetki Yok </td> ';
            })
            ->rawColumns(['country','image','crud'])
            ->make(true);
    }
}
