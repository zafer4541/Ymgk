@extends('back.layouts.master')
@section('title','UADT Panel Yönetimi')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Toplam İhracat</h6>
                                    <h6 class="font-extrabold mb-0">{{$exportCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kullanıcı Sayısı</h6>
                                    <h6 class="font-extrabold mb-0">{{$userCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aylık İhracatlar</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-12 col-lg-3 float-end">
            <div class="card">
                <div class="card-header">
                    <h4>Etkileşimde Bulunan Kullanıcılar</h4>
                </div>
                    <div class="card-content pb-4">
                        @foreach($lastUsers as $user)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{asset('uploads/profile6.png')}}">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{$user->name}}</h5>
                                    <h6 class="text-muted mb-0">{{$user->city}}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('back/dist/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script>
        $(document).ready(()=>{
            let date = new Date();
            let year = date.getFullYear();
            $.ajax({
                url:'{{route('back.getDashboardExportChart')}}',
                type:'GET',
                data:{year:year},
                success:(r)=>{
                    var optionsProfileVisit = {
                        annotations: {
                            position: 'back'
                        },
                        dataLabels: {
                            enabled:false
                        },
                        chart: {
                            type: 'bar',
                            height: 300
                        },
                        fill: {
                            opacity:1
                        },
                        plotOptions: {
                        },
                        series: [{
                            name: 'sales',
                            data: [r.jan, r.fab, r.mar, r.apr, r.may, r.june, r.july, r.aug, r.sept, r.oct, r.nov, r.dec]
                        }],
                        colors: '#435ebe',
                        xaxis: {
                            categories: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"],
                        },
                    }
                    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
                    chartProfileVisit.render();
                }
            })
        })

    </script>
@endsection

