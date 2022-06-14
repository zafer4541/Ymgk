@extends('back.layouts.master')
@section('title', 'Kullanıcı Güncelleme Sayfası')
@section('headingTitle','Kullanıcı Güncelleme Sayfası')
@section('css')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{route('back.users.update',$userInformation->id)}}" method="post"
                                  enctype="multipart/form-data" class="form-horizontal">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="opacity-75" style="color:rgb(96, 112, 128)">Kullanıcı Güncelleme Paneli</h5>
                                        <div class="form-group">
                                            <div class="row pt-5">
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <img
                                                            src="@if(isset($userInformation->profile_photo_path)){{asset($userInformation->profile_photo_path)}}@else{{asset('uploads/profile6.png')}}@endif>"
                                                            alt=""
                                                            class="img-fluid img-profile img-circle img-responsive avatar-md rounded-circle"
                                                            style="width:auto!important;">
                                                    </div>

                                                </div>
                                                <div class="float-right col-md-1 pr-1 pl-1" style="border-right:1px solid black;opacity:0.2;width: auto!important;">
                                                </div>
                                                <div class="col-10 pl-4 pt-md-3">
                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmanın Logosunu Seçiniz</label>
                                                        <input id="image" name="image" type="file" class="form-control">
                                                        <br>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Yetkili Adı-Soyadı</label>
                                                        <input type="text" placeholder="Ad-Soyad" name="name" class="form-control" value="{{$userInformation->name}}">
                                                        <br>
                                                    </div>

                                                    <div class="form-group col-6 float-start">
                                                        <label>E-mail Adresi</label>
                                                        <input type="email" placeholder="E-mail" name="email" class="form-control" value="{{$userInformation->email}}">
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Şifre</label>
                                                        <input type="password" name="password" class="form-control" value=""><br>
                                                    </div>

                                                    <div class="form-group col-6 float-start">
                                                        <br>
                                                        <label>Firmanın İsmi</label>
                                                        <input type="text" name="company_name" placeholder="Firmanın İsmi" class="form-control" value="{{$userInformation->company_name}}"><br>
                                                    </div>

                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Adresi</label>
                                                        <input type="text" name="company_address" placeholder="Firmanın Adresi" class="form-control" value="{{$userInformation->company_address}}"><br>
                                                    </div>

                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmanın Ülkesi</label>
                                                        <select name="country" id="country" onchange="getCities(this)" class="form-select">
                                                            <option  value="country" selected>Ülke</option>
                                                            @foreach($country as $ct)
                                                                <option value="{{$ct->id}}" {{($userInformation->country==$ct->id)? 'selected':''}}>{{$ct->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Şehri</label>
                                                        <select name="city" id="city"  class="form-select">
                                                            <option value="{{$userInformation->city}}" selected>{{$userInformation->city}}</option>
                                                        </select>
                                                        <br>
                                                    </div>

                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmanın Telefonu</label>
                                                        <input type="text" name="company_phone" placeholder="Firmanın Telefon" id="company_phone" class="form-control" value="{{$userInformation->company_phone}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Faxı</label>
                                                        <input type="text" name="company_fax" id="company_fax" placeholder="Firmanın Faxı" class="form-control" value="{{$userInformation->company_fax}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <label for="company_type">Firma Türü</label>
                                                        <select name="company_type" class="form-select" id="company_type">
                                                            <option value="Anonim" selected>Anonim Şirket</option>
                                                            <option value="Limited">Limited Şirket</option>
                                                            <option value="Kollektif">Kollektif Şirket</option>
                                                            <option value="Komandit">Komandit Şirket</option>
                                                            <option value="Kooperatif">Kooperatif Şirket</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Kuruluş Yılı</label>
                                                        <input type="text" id="foundation_year" name="company_foundation_year" placeholder="Firmanın Kuruluş Yılı" class="form-control" maxlength="4" value="{{$userInformation->company_foundation_year}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <br>
                                                        <label>Firmanın Sermayesi(TL)</label>
                                                        <input type="number" name="company_capital" placeholder="Sermaye(TL)"  class="form-control" value="{{$userInformation->company_capital}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Vergi Dairesi Ve Numarası</label>
                                                        <input type="text" name="company_tax_administration" placeholder="Vergi Dairesi Ve Numarası" class="form-control" value="{{$userInformation->company_tax_administration}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmanın Sahip Olduğu Kapalı Alan(m²)</label>
                                                        <input type="number" name="company_closed_area" placeholder="Kapalı Alan" class="form-control" value="{{$userInformation->company_closed_area}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <label>Firmanın Sahip Olduğu Açık Alan(m²)</label>
                                                        <input type="number" name="company_open_area" placeholder="Açık Alan" class="form-control" value="{{$userInformation->company_open_area}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmada Çalışan Kişi Sayısı</label>
                                                        <input type="number" name="company_number_employees" placeholder="Çalışan Kişi Sayısı" class="form-control" value="{{$userInformation->company_number_employees}}"><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <label for="roles">Kullanıcı Yetkisi</label>
                                                        <select name="role" class="form-select" id="roles">
                                                            <option  value="user" @if($userInformation->role=='user')selected @endif>Kullanıcı</option>
                                                            <option value="employee" @if($userInformation->role=='employee')selected @endif>Personel</option>
                                                            <option value="admin" @if($userInformation->role=='admin')selected @endif>Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6 float-end">
                                                        <br>
                                                        <label>Firmanın Sahip Olduğu Kalite Belgeleri</label>
                                                        <textarea type="text" name="company_document" rows = "5" cols = "60"  class="form-control" value="">{!!$userInformation->company_document!!}</textarea><br>
                                                    </div>
                                                    <div class="form-group col-6 float-start">
                                                        <label>Firmanın Açıklaması</label>
                                                        <textarea type="textarea" name="company_description" rows = "5" cols = "60" class="form-control" value="">{!!$userInformation->company_description!!}</textarea><br>
                                                    </div>   <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Kaydet</button>
                                        <a href="{{route('back.users')}}" type="reset"
                                           class="btn btn-light-secondary me-1 mb-1" style="color: rgb(96, 112, 128)"> Geri Dön</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script>
        $(window).load(function()
        {
            var phones = [{ "mask": "(###) ###-##-##"}];
            $('#company_phone').inputmask({
                mask: phones,
                greedy: false,
                definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
        });
    </script>
    <script>
        $(window).load(function()
        {
            var phones = [{ "mask": "(###) ###-##-##"}];
            var number = [{ "mask": "####"}];
            $('#company_fax').inputmask({
                mask: phones,
                greedy: false,
                definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
            $('#foundation_year').inputmask({
                mask: number,
                greedy: false,
                definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
        });
    </script>
    <script>
        function getCities(e){
            let country = e.value
            $.ajax({
                url:'{{route('back.getCity')}}',
                type:'GET',
                data : {
                    country: country,
                },
                success:(response)=>{
                    let element = document.getElementById('city');
                    element.innerHTML = '';
                    for(let i = 0 ; i < response.length ; i++){
                        element.innerHTML += '<option value="'+response[i].name+'">'+response[i].name+'</option>';
                    }
                }
            })


        }
    </script>
@endsection
