@extends('back.layouts.master')
@section('title', 'Panel - İhracatlar - Olustur')
@section('headingTitle','İhracat Ekleme Yönetimi')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>İhracat Oluştur</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger" >
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form onsubmit="event.preventDefault();validateForm()" name="exportForm"  action="{{route('back.export.store')}}" data-flag="0" method="post" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="opacity-75" style="color:rgb(96, 112, 128)">İhracat Ekleme</h5>

                                        <div class="form-group">
                                                <div class="col-md-12 pl-4 pt-md-3">

                                                    <div class="form-group col-md-6 float-start">
                                                        <label>Firma Adı</label>
                                                        <input type="text" name="company_name" id="company_name" class="form-control" value=""><br>
                                                    </div>

                                                    <div class="form-group col-md-6 float-end">
                                                        <label>Firma adresi</label>
                                                        <input type="text" name="company_address" id="company_address" class="form-control" value=""><br>
                                                    </div>

                                                    <div class="form-group col-md-6 float-start">
                                                        <label>Firma Telefonu</label>
                                                        <input type="text" name="company_phone" id="company_phone" class="form-control" value=""><br>
                                                    </div>
                                                    <div class="form-group col-md-6 float-end">
                                                        <label>Firma Maili</label>
                                                        <input type="text" name="company_mail" id="company_mail" class="form-control" value=""><br>
                                                    </div>
                                                    <div class="form-group col-md-6 float-start">
                                                        <label>Firma Ülkesi</label>
                                                        <select onchange="getCity()" class="form-control" name="country" id="country">
                                                            <option value=""disabled>Ülke Seçin</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->name}}">{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
{{--                                                        <input type="text" name="country" id="country" class="form-control" value=""><br>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 float-end">
                                                        <label>Firma Şehri</label>
                                                        <select name="city" id="city" class="form-control">

                                                        </select>
                                                    </div>


                                                    <div class="form-group col-md-6 float-start">
                                                        <label>İhracat Başlığı</label>
                                                        <input type="text" name="title" class="form-control" value=""><br>
                                                    </div>

                                                    <div class="form-group col-md-6 float-end">
                                                        <label>İhracat miktarı</label>
                                                        <input type="text" name="total_quantity" class="form-control" value=""><br>
                                                    </div>
                                                    <div class="form-group col-md-12 float-start">
                                                        <label>İhracat Acıklaması</label>
                                                        <textarea id="summernote" name="description" class="form-control"></textarea>
                                                        <br>

                                                    </div>
                                                    <div class="form-group col-md-6 float-end">
                                                        <label> İhracat Son tarihi</label>
                                                        <input name="deadline" id="deadline" type="date" class="form-control"value=""> <br>
                                                    </div>
                                                    <div class="form-group col-md-6 float-end">
                                                        <label> İhracat Başlangıç tarihi</label>
                                                        <input name="request_date" id="request_date" type="date" class="form-control"value=""><br>
                                                    </div>


                                                    <div class="form-group col-md-12 float-start">
                                                        <select class="form-select" name="category_id" id="category_id" >
                                                            <optgroup label="Lütfen seçiniz">
                                                        @foreach($category as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                            </optgroup>
                                                        </select><br>
                                                            <small>İhracatın kategorisini seçiniz.</small>

                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">İhracat Oluştur</button>
                                        <a href="{{route('back.export')}}" type="reset"
                                           class="btn btn-light-secondary me-1 mb-1"> Geri Dön</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('back')}}/dist/assets/vendors/summernote/summernote-lite.min.css">
@endsection

@section('js')
    <script src="{{asset('back')}}/dist/assets/vendors/jquery/jquery.min.js"></script>
    <script src="{{asset('back')}}/dist/assets/vendors/summernote/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 220,
        })
    </script>
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
        function validateForm(){
            let firstDate = new Date(document.getElementById('request_date').value);
            let deadline = new Date(document.getElementById('deadline').value);
            if(deadline > firstDate){
                document.forms["exportForm"].submit()
                return true
            }
            else {
                Swal.fire({
                    position: 'top-enter',
                    icon: 'error',
                    title: '{{'Son Tarih İlk Tarihten Büyük veya aynı olamaz'}}',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false
            }


        }
        function getCity(){
            let country = document.getElementById('country').value;
            $.ajax({
                url:'{{route('back.export.getCity')}}',
                type:'GET',
                data:{
                    country:country
                },
                success:(response)=>{
                    document.getElementById('city').innerHTML = '';
                    for (let i = 0; i < response.length; i++){
                        document.getElementById('city').innerHTML += '<option value="'+response[i].name+'">'+response[i].name+'</option>'
                    }
                }
            })
        }
    </script>

@endsection
