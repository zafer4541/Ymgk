@extends('front.layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('Mazer/choices.min.css')}}"/>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/app.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/auth.css')}}">
    <style>
        header {
            background: #021130 !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #021130 !important;
            border-color: #021130 !important;
        }
        #header {
            height: 80px;
        }
        .align-items-center {
            height: 50px;
        }

        .navbar {
            height: auto !important;
            padding: 1.5rem;
        }
    </style>
    <main>
        <!-- ======= Contact Section ======= -->
        <section id="UserCard" class="contact">

            <div class="container" data-aos="fade-up">
                <br><br>
                <div class="section-title">
                    <br><br>
                    <h2>Firma Bilgileri Güncelleme</h2>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </div>
                @endif
                <div class="row">

                    <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form action="{{route('front.profile.update',\Illuminate\Support\Facades\Auth::user()->id)}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="form-group col-md-6 float-end" style="padding-right: 1.8em">
                                    <label>Adı-Soyadı</label>
                                    <input type="text" placeholder="Ad-Soyad" name="name" class="form-control"
                                           value="{{$userInformation->name}}" required>
                                </div>
                                <div class="form-group col-6 float-start"  >
                                    <label>Firmanın Adresi</label>
                                    <input type="text" name="company_address" placeholder="Firmanın Adresi"
                                           class="form-control" value="{{$userInformation->company_address}}" required>
                                </div>
                                <div class="form-group col-md-6 float-end" style="padding-right: 1.8em">
                                    <label>Firma İsmi</label>
                                    <input type="text" name="company_name" placeholder="Firmanın İsmi" class="form-control"
                                           value="{{$userInformation->company_name}}" required>
                                </div>
                                <div class="form-group col-6 float-end"  >
                                    <label>Firmanın Ülkesi</label>
                                    <select name="country" id="country" onchange="getCities(this)" class="form-select">
                                        <option value="country" selected>Ülke</option>
                                        @foreach($country as $ct)
                                            <option
                                                value="{{$ct->id}}" {{($userInformation->country==$ct->id)? 'selected':''}}>{{$ct->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label>Firmanın Şehri</label>
                                    <select name="city" id="city" class="form-select">
                                        <option value="{{$userInformation->city}}"
                                                selected>{{$userInformation->city}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label>Firmanın Telefonu</label>
                                    <input type="text" name="company_phone" placeholder="Firmanın Telefon"
                                           id="company_phone" class="form-control"
                                           value="{{$userInformation->company_phone}}" required>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label>Firmanın Faxı</label>
                                    <input type="text" name="company_fax" id="company_fax" placeholder="Firmanın Faxı"
                                           class="form-control" value="{{$userInformation->company_fax}}" >
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label for="company_type"> Firma Türü</label>
                                    <select name="company_type" class="form-select" id="company_type">
                                        <option value="Anonim" selected>Anonim Şirket</option>
                                        <option value="Limited">Limited Şirket</option>
                                        <option value="Kollektif">Kollektif Şirket</option>
                                        <option value="Komandit">Komandit Şirket</option>
                                        <option value="Kooperatif">Kooperatif Şirket</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label>Firmanın Kuruluş Yılı</label>
                                    <input type="text" id="foundation_year" name="company_foundation_year"
                                           placeholder="Firmanın Kuruluş Yılı" class="form-control" maxlength="4"
                                           value="{{$userInformation->company_foundation_year}}" required>
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label>Firmanın Sermayesi(TL)</label>
                                    <input type="number" name="company_capital" placeholder="Sermaye(TL)" class="form-control"
                                           value="{{$userInformation->company_capital}}" required>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label> Firmanın Vergi Dairesi Ve Numarası</label>
                                    <input type="text" name="company_tax_administration"
                                           placeholder="Vergi Dairesi Ve Numarası" class="form-control"
                                           value="{{$userInformation->company_tax_administration}}" required>
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label>Firmanın Sahip Olduğu Kapalı Alan(m²)</label>
                                    <input type="number" name="company_closed_area" placeholder="Kapalı Alan"
                                           class="form-control" value="{{$userInformation->company_closed_area}}" >
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label>Firmanın Sahip Olduğu Açık Alan(m²)</label>
                                    <input type="number" name="company_open_area" placeholder="Açık Alan"
                                           class="form-control" value="{{$userInformation->company_open_area}}">
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label> Firmada Çalışan Kişi Sayısı</label>
                                    <input type="number" name="company_number_employees" placeholder="Çalışan Kişi Sayısı"
                                           class="form-control" value="{{$userInformation->company_number_employees}}" required>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label> Firmanın Sahip Olduğu Kalite Belgeleri</label>
                                    <textarea type="text" name="company_document" rows="5" cols="60" class="form-control"
                                              value="" >{!!$userInformation->company_document!!}</textarea>
                                </div>
                                <div class="form-group col-6 float-end">
                                    <label> Firmanın Açıklaması</label>
                                    <textarea type="textarea" name="company_description" rows="5" cols="60"
                                              class="form-control"
                                              value="" >{!!$userInformation->company_description!!}</textarea>
                                </div>
                                <div class="form-group col-6 float-start" style="padding-right: 1.8em">
                                    <label for="basicInput"> Lütfen ilgilendiğiniz sektörleri seçiniz</label>
                                    <select id="myselect"   class="choices form-select multiple-remove" multiple="multiple"
                                            name="category[]">
                                        <optgroup label="Lütfen ilgilendiğiniz sektörleri seçiniz">
                                            @foreach($category as $data)
                                                <option @if(\App\Models\UserCategory::where('category_id', $data->id)->first() !=null && \App\Models\UserCategory::where('category_id', $data->id)->get()->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->count() > 0 ) selected @endif value="{{$data->id}}">{{$data->name}} </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-secondary" >Kaydet</button>
                                        <a href="{{route('profile.show')}}" type="reset" class="btn btn-light-secondary " style="color: rgb(96, 112, 128)"> Hesap Ayarları</a>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>

            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
@section('js')
    <script src="{{asset('Mazer/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('Mazer/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Include Choices JavaScript -->
    <script src="{{asset('Mazer/js/choices.min.js')}}"></script>
    <script src="{{asset('Mazer/js/form-element-select.js')}}"></script>

    <script src="{{asset('Mazer/js/mazer.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script>
        $(window).load(function () {
            var phones = [{"mask": "(###) ###-##-##"}];
            $('#company_phone').inputmask({
                mask: phones,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
            });
        });
    </script>
    <script>
        $(window).load(function () {
            var phones = [{"mask": "(###) ###-##-##"}];
            var number = [{"mask": "####"}];
            $('#company_fax').inputmask({
                mask: phones,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
            });
            $('#foundation_year').inputmask({
                mask: number,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
            });
        });
    </script>
    <script>
        function getCities(e) {
            let country = e.value
            $.ajax({
                url: '{{route('back.getCity')}}',
                type: 'GET',
                data: {
                    country: country,
                },
                success: (response) => {
                    let element = document.getElementById('city');
                    element.innerHTML = '';
                    if(response.length === 0){
                        element.removeAttribute('required')
                    }
                    else {
                        for (let i = 0; i < response.length; i++) {
                            element.innerHTML += '<option value="' + response[i].name + '">' + response[i].name + '</option>';
                        }
                    }
                }
            })


        }
    </script>
@endsection
