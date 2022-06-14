@extends('front.layouts.master')
@section('content')
    <style>
        header {
            background: #021130 !important;
        }
        .col-sm-9.text-secondary{
            display:flex;
            align-items: center
        }
     .right-category{
         min-height: auto!important;
         padding: 20px;
     }
        .col-sm-9.text-secondary{
            height: 100%;
        }
        .btn-primary {
            color: #fff;
            background-color: #021130 !important;
            border-color: #021130 !important;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #47b2e4 !important;
            border-color: #47b2e4 !important;
        }


        div h6 {
            color: #021130;
            vertical-align: middle;
        }

        .card {
            border-radius: 5px;
        }
        .toggle-off.btn {
            padding-top: 6px;
            padding-left: 14px!important;
        }
        .toggle-on.btn{
            padding-top: 18px;
            padding-left: 4px!important;
            padding-right: 0px!important;
        }
        .btn-primary{
            font-size:0.9vw!important;
        }
        @media(max-width: 765px){
            .btn-primary {
                font-size: 15px!important;
            }
            .main-body .cent .left .icon span {
                 font-size: 5vw;
             }
            .deneme{
                display: inline;
                flex-direction: column;
                position: absolute;
                left: auto;
                top: unset;
                bottom: 10%;
            }
            }
        }

    </style>
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </div>
                @endif
                <div class="container">
                    <div class="main-body">
                        <div class="cent">
                            <div class="left">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('front.homePage')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('front.account.index')}}">Hesabınız</a></li>
                                </ol>
                                <div class="logo">
                                    <img src="{{asset('front/img/hesap_logo.png')}}" alt="">
                                    <div class="deneme">
                                    <span class="name" style="text-transform: capitalize;">{{\Illuminate\Support\Facades\Auth::user()->company_name}}</span>
                                    <span class="job-info" style="text-transform: capitalize;">@if(isset($country)){{\Illuminate\Support\Facades\Auth::user()->city}}/{{$country->name}}@else{{\Illuminate\Support\Facades\Auth::user()->city}}@endif</span>
                                    </div>

                                </div>
                                <div class="icon">
                                    <a class="btn btn-primary col-10"  style="margin: auto" href="{{route('front.profile',\Illuminate\Support\Facades\Auth::user()->id)}}">Profili Düzenle</a>

                                </div>
                                <div class="icon">
                                    <a class="btn btn-primary col-10"  style="margin: auto" href="{{route('front.account.companyCardIndex')}}">Firma bilgilerini pdf olarak gör.</a>

                                </div>

                            </div>

                            <div class="right">
                                <h5 class="d-flex align-items-center mb-3 " style=" color: #021130">Firma Bilgileri</h5>
                                <div class="right_ifo">
                                    <h6 class="mb-0 d-table-cell">Kullanıcı İsmi</h6>
                                    <div class="col-sm-9 text-secondary">
                                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                                    </div>
                                </div>
                                <div class="right_ifo">
                                    <h6 class="mb-0 d-table-cell">Email</h6>
                                    <div class="col-sm-9 text-secondary">
                                        {{\Illuminate\Support\Facades\Auth::user()->email}}
                                    </div>
                                </div>
                                <div class="right_ifo right-category">
                                    <h6 class="mb-0 d-table-cell">Kategoriler</h6>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($postCategories))
                                            @foreach($postCategories as $data)
                                                {{$data->name}},
                                            @endforeach
                                        @else
                                            Herhangi bir kategori girilmemiş.
                                        @endif

                                    </div>
                                </div>
                                <div class="right_ifo">
                                    <h6 class="mb-0 d-table-cell">Telefon</h6>
                                    <div class="col-sm-9 text-secondary">
                                        {{\Illuminate\Support\Facades\Auth::user()->company_phone}}
                                    </div>
                                </div>
                                <div class="right_ifo">
                                    <h6 class="mb-0 d-table-cell">Adres</h6>
                                    <div class="col-sm-9 text-secondary">
                                        {{\Illuminate\Support\Facades\Auth::user()->company_address}}
                                    </div>
                                </div>

                                <h5 class="d-flex align-items-center mb-3" style=" color: #021130">Firma Açıklaması</h5>
                                <div class="frma_info">
                                    <p>
                                        {{\Illuminate\Support\Facades\Auth::user()->company_description}}

                                    </p>

                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mevzuatlar</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="yajraTable" class="table table-borderless display table-responsive-lg table-responsive-md table-responsive-sm" width="100%" >
                                <thead>
                                <tr>
                                    <th class="text-center whitespace-no-wrap">Mevzuat Başlığı</th>
                                    <th class="text-center whitespace-no-wrap">İçerik</th>
                                    <th class="text-center whitespace-no-wrap">Durum</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
@section('js')

    <!--
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

        function getToggleValue(id,user_id){
            toggle= document.getElementById(id);
            $.ajax({
                type: "POST",
                url: '{!!route('userRegulation.toggle.post')!!}',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "user_id": user_id,
                    "checked": toggle.checked
                },
                success:
                    function () {console.log('başarılı');}
            });
        }
    </script>
-->
@endsection








