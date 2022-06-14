<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Elazığ Ticaret ve Sanayi Odası</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('Mazer/choices.min.css')}}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/app.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/auth.css')}}">


</head>

<body>
<div id="app">
    <div id="main" style="margin-left: 50px!important;">
        <div class="page-content">
            <section class="row">
                <div class="col-12">
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
                                    <form action="{{route('front.page.userForms')}}" method="POST"
                                          enctype="multipart/form-data" class="form-horizontal">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="m-auto" style="text-align: center!important;">Son bir adım kaldı!
                                                    <br>
                                                    Firma bilgilerini doldurduğunuzda artık hazırsınız!</h3>
                                                <div class="form-group">
                                                    <div class="row pt-5">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <img
                                                                    src="{{asset('uploads/profile6.png')}}"
                                                                    alt=""
                                                                    class="img-fluid img-profile img-circle img-responsive avatar-md rounded-circle"
                                                                    style="width:auto!important;">
                                                            </div>

                                                        </div>
                                                        <div class="float-right col-md-1 pr-1 pl-1"
                                                             style="border-right:1px solid black;opacity:0.2;width: auto!important;">
                                                        </div>
                                                        <div class="col-10 pl-4 pt-md-3">
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Logosunu Seçiniz</label>
                                                                <input id="image" name="image" type="file"
                                                                       class="form-control">
                                                                <br>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın İsmi</label>
                                                                <input type="text" name="company_name"
                                                                       placeholder="Firmanın İsmi" class="form-control"
                                                                       value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Adresi</label>
                                                                <input type="text" name="company_address"
                                                                       placeholder="Firmanın Adresi"
                                                                       class="form-control" value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın Ülkesi</label>
                                                                <select name="country" id="country"
                                                                        onchange="getCities(this)" class="form-select">
                                                                    <option value="country" selected>Ülke</option>
                                                                    @foreach($country as $ct)
                                                                        <option
                                                                            value="{{$ct->id}}">{{$ct->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Şehri</label>
                                                                <select name="city" id="city" class="form-select">
                                                                    <option value="" selected>Şehir</option>
                                                                </select>
                                                                <br>
                                                            </div>

                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın Telefonu</label>
                                                                <input type="text" name="company_phone"
                                                                       placeholder="Firmanın Telefon" id="company_phone"
                                                                       class="form-control" value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Faxı</label>
                                                                <input type="text" name="company_fax" id="company_fax"
                                                                       placeholder="Firmanın Faxı" class="form-control"
                                                                       value=""><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label for="company_type">Firma Türü</label>
                                                                <select name="company_type" class="form-select"
                                                                        id="company_type">
                                                                    <option value="Anonim" selected>Anonim Şirket
                                                                    </option>
                                                                    <option value="Limited">Limited Şirket</option>
                                                                    <option value="Kollektif">Kollektif Şirket</option>
                                                                    <option value="Komandit">Komandit Şirket</option>
                                                                    <option value="Kooperatif">Kooperatif Şirket
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <br>
                                                                <label>Firmanın Kuruluş Yılı</label>
                                                                <input type="text" id="foundation_year"
                                                                       name="company_foundation_year"
                                                                       placeholder="Firmanın Kuruluş Yılı"
                                                                       class="form-control" maxlength="4" value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Sermayesi(TL)</label>
                                                                <input type="number" name="company_capital"
                                                                       placeholder="Sermaye(TL)" class="form-control"
                                                                       value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın Vergi Dairesi Ve Numarası</label>
                                                                <input type="text" name="company_tax_administration"
                                                                       placeholder="Vergi Dairesi Ve Numarası"
                                                                       class="form-control" value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Sahip Olduğu Kapalı Alan(m²)</label>
                                                                <input type="number" name="company_closed_area"
                                                                       placeholder="Kapalı Alan" class="form-control"
                                                                       value=""><br>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın Sahip Olduğu Açık Alan(m²)</label>
                                                                <input type="number" name="company_open_area"
                                                                       placeholder="Açık Alan" class="form-control"
                                                                       value=""><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmada Çalışan Kişi Sayısı</label>
                                                                <input type="number" name="company_number_employees"
                                                                       placeholder="Çalışan Kişi Sayısı"
                                                                       class="form-control" value="" required><br>
                                                            </div>
                                                            <div class="form-group col-6 float-end">
                                                                <label>Firmanın Sahip Olduğu Kalite Belgeleri</label>
                                                                <textarea type="text" name="company_document" rows="5"
                                                                          cols="60" class="form-control"
                                                                          value=""></textarea><br>
                                                            </div>
                                                            <div class="form-group col-6 float-start">
                                                                <label>Firmanın Açıklaması</label>
                                                                <textarea type="textarea" name="company_description"
                                                                          rows="5" cols="60" class="form-control"
                                                                          value=""> </textarea><br>
                                                            </div>
                                                            <div class="form-group col-10 float-start">
                                                                <label for="basicInput">Lütfen ilgilendiğiniz sektörleri seçiniz</label>
                                                                <select id="myselect" class="choices form-select multiple-remove" multiple="multiple"  name="category[]">
                                                                    <optgroup label="Lütfen ilgilendiğiniz sektörleri seçiniz">
                                                                        @foreach($category as $data)
                                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-2 float-end">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary col-12" style="margin-top:0.8rem">Kaydet
                                                                </button>
                                                            </div>
                                                            <br>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</body>
<script src="{{asset('Mazer/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('Mazer/js/bootstrap.bundle.min.js')}}"></script>

<!-- Include Choices JavaScript -->
<script src="{{asset('Mazer/js/choices.min.js')}}"></script>
<script src="{{asset('Mazer/js/form-element-select.js')}}"></script>

<script src="{{asset('Mazer/js/mazer.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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
</html>
