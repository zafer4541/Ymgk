@extends('front.layouts.master')
@section('content')
<style>
    header{
        background: #021130 !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #021130 !important;
        border-color: #021130 !important;
    }
</style>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{route('front.ihracatFirsatlari')}}">İhracat Fırsatları</a></li>
                <li>İhracat fırsatının detayı</li>
            </ol>
            <h2>{{$exportDetail->title}}</h2>
        </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">

                @csrf
                <div class="col-lg-4 export-detail">
                    <div class="portfolio-info">
                        <h3></h3>
                        <ul>
                            <li><strong>Ülke </strong>:  {{$exportDetail->country}}</li>
                            <li><strong>Şehir </strong>:  {{$exportDetail->city}}</li>
                            <li><strong>Talep Eden Kişi/Kurum/Kuruluş</strong>:  {{$exportDetail->company_name}} </li>
                            <li><strong>Telefonu </strong>:  {{$exportDetail->company_phone}} </li>
                            <li><strong>Mail Adresi </strong>:  {{$exportDetail->company_mail}} </li>
                            <li><strong>Adresi</strong>:{{$exportDetail->company_address}}</li>
                            <li><strong>Talep Tarihi</strong>:{{ Carbon\Carbon::parse($exportDetail->request_date)->format('d-m-Y') }}</li>
                            <li><strong>Son Geçerlilik Tarihi Tarihi</strong>:{{ Carbon\Carbon::parse($exportDetail->deadline)->format('d-m-Y') }}</li>
                            <li><strong>Ürün Miktarı </strong>: {{$exportDetail->total_quantity}}</li>
                        </ul>
                        <div class="button-detail"><button type="button" class="btn btn-primary detail-about popat_ac">Talebin Açıklaması</button></div>
                    </div>
                    <div class="mesaj" >

                        <div class="messaging" id="mesagging">
                            <div class="not_ekle detail-width" style="border-radius: 6px">

                                <div class="headind_srch">
                                        <h3 id="yorum_kapat">x</h3>
                                </div>
                                <div class="portfolio-description">
                                    <h2>Talebin açıklaması:</h2>
                                    <p>
                                        {!!$exportDetail->description!!}
                              </p>
                                </div>


                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
@endsection
@section('js')
    <script src="{{asset('front/')}}/js/details.js"></script>

    @if($errors->any())
        <script>
            console.log('{{$errors->first()}}')
            showErrorMessage('{{$errors->first()}}')
            function showErrorMessage(message){
                Swal.fire({
                    icon:'warning',
                    title:'Hata',
                    text:message
                })
            }
        </script>
    @endif

@endsection
