@extends('back.layouts.master')
@section('title', 'Panel - İhracatlar - Güncelle')
@section('headingTitle','İhracat Güncelleme Yönetimi')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>İhracat Güncelle</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger" >
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                                <form action="{{route('back.export.update',$exports->id)}}" method="POST" enctype="multipart/form-data" >
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="opacity-75" style="color:rgb(96, 112, 128)">İhracat Ekleme</h5>

                                        <div class="form-group">
                                            <div class="col-md-12 pl-4 pt-md-3">

                                                <div class="form-group col-md-6 float-start">
                                                    <label>Firma Adı</label>
                                                    <input type="text" name="company_name" class="form-control" value="{{$exports->company_name}}"><br>
                                                </div>

                                                <div class="form-group col-md-6 float-end">
                                                    <label>Firma adresi</label>
                                                    <input type="text" name="company_address" class="form-control" value="{{$exports->company_address}}"><br>
                                                </div>

                                                <div class="form-group col-md-6 float-start">
                                                    <label>Firma Telefonu</label>
                                                    <input type="text" name="company_phone"  id="company_phone" placeholder="Telefon" class="form-control" value="{{$exports->company_phone}}"><br>
                                                </div>
                                                <div class="form-group col-md-6 float-end">
                                                    <label>Firma Maili</label>
                                                    <input type="text" name="company_mail" class="form-control" value="{{$exports->company_mail}}"><br>
                                                </div>
                                                <div class="form-group col-md-6 float-start">
                                                    <label>Firma Ülkesi</label>
                                                    <select onchange="getCity()" class="form-control" name="country" id="country">
                                                        <option value=""disabled>Ülke Seçin</option>
                                                        @foreach($countries as $country)
                                                            <option {{$exports->country == $country->name ? 'selected':''}} value="{{$country->name}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 float-end">
                                                    <label>Firma Şehri</label>
                                                    <select name="city" id="city" class="form-control">

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 float-start">
                                                    <label>İhracat Başlığı</label>
                                                    <input type="text" name="title" class="form-control" value="{{$exports->title}}"><br>
                                                </div>
                                                <div class="form-group col-md-6 float-end">
                                                    <label>İhracat miktarı</label>
                                                    <input type="text" name="total_quantity" class="form-control" value="{{$exports->total_quantity}}"><br>
                                                </div>

                                                <div class="form-group col-md-12 float-start">
                                                    <label>İhracat Acıklaması</label>
                                                    <textarea id="summernote" name="description" class="form-control">{!! $exports->description !!}</textarea>
                                                    <br>

                                                </div>
                                                <div class="form-group col-md-6 float-start">
                                                    <label> İhracat Başlangıç tarihi</label>
                                                    <input name="request_date" id="date2" type="date" class="form-control"
                                                           placeholder="{{$exports->request_date}}"  value=""><br>
                                                </div>
                                                <div class="form-group col-md-6 float-end">
                                                    <label> İhracat Son tarihi</label>
                                                    <input name="deadline" id="date" type="date" class="form-control"
                                                           placeholder="{{$exports->deadline}}"   value=""><br>
                                                </div>
                                                <div class="form-group col-md-12 float-end">
                                                    <select class="form-select" name="category_id" id="category_id" >
                                                        <optgroup label="Lütfen seçiniz">

                                                        @foreach($category as $item)
                                                            <option value="{{$item->id}}" {{($exports->category_id == $item->id) ? 'selected':''}}>{{$item->name}}</option>
                                                        @endforeach
                                                    </select><br>
                                                    </optgroup>
                                                    <small>İhracatın kategorisini seçiniz.</small>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">İhracat Güncelle</button>
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


        $( document ).ready(function() {
            getCity()
            Date.prototype.addDays = function(days) {
                var date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return date;
            }
            var date=new Date('{{$exports->deadline}}');
            var date2 =new Date('{{$exports->request_date}}');
            document.getElementById('date').valueAsDate=date.addDays(1);
            document.getElementById('date2').valueAsDate=date2.addDays(1);

        });
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
                        if (response[i].name === '{{$exports->city}}'){
                            document.getElementById('city').innerHTML += '<option selected value="'+response[i].name+'">'+response[i].name+'</option>'
                        }
                        else {
                            document.getElementById('city').innerHTML += '<option value="'+response[i].name+'">'+response[i].name+'</option>'
                        }

                    }
                }
            })
        }
    </script>
@endsection
