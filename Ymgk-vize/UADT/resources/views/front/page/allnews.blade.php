@extends('front.layouts.master')
@section('content')

    @if(session('addContactSuccess'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '{{(session('addContactSuccess'))}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
{{--    <section id="anasayfa" class="d-flex align-items-center">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                @if(\Illuminate\Support\Facades\Auth::check())--}}
{{--                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">--}}
{{--                        <img src="{{$header->image}}" class="img-fluid animated" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">--}}
{{--                        <h1>{{Auth::user()->name}}</h1>--}}
{{--                        <h4>{{Date('d/m/Y')}}</h4>--}}
{{--                        <h2>{{$header->title }}</h2>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">--}}
{{--                        <h1>Elazığ Bölgesel Dış Ticaret Hızlandırma Merkezi</h1>--}}

{{--                        <h2>{{$header->title }}</h2>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">--}}
{{--                        <img src="{{$header->image}}" class="img-fluid animated" alt="">--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <main id="main">
        @if(\Illuminate\Support\Facades\Auth::check())
            <section id="haberler" class="portfolio">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Neler Oluyor</h2>
                        <p>Piyasada son durum ne? İlginizi çekebilecek tüm haberleri görün.</p>
                    </div>
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img">

                                    <img src="{{asset('uploads')}}/hurma4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-site">
                            <a href="#">
                                <div class="portfolio-img">
                                    <img src="{{asset('uploads')}}/nohut6.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru Dut İhracatından 5 Milyon Dolar Gelir Sağlandı.</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/findik4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/bugday4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/kuru_meyve.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img">

                                    <img src="{{asset('uploads')}}/hurma4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-site">
                            <a href="#">
                                <div class="portfolio-img">
                                    <img src="{{asset('uploads')}}/nohut6.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru Dut İhracatından 5 Milyon Dolar Gelir Sağlandı.</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/findik4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/bugday4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/kuru_meyve.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>


                    </div>

                </div>

            </section><!-- End Portfolio Section -->

            <!-- ======= Cta Section ======= -->

        @else
            <section id="haberler" class="portfolio">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>İLGİNİZİ ÇEKEBİLECEK HABERLER</h2>
                        <p>Piyasada son durum ne? İlginizi çekebilecek tüm haberleri görün.</p>
                    </div>

                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img">

                                    <img src="{{asset('uploads')}}/hurma4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-site">
                            <a href="#">
                                <div class="portfolio-img">
                                    <img src="{{asset('uploads')}}/nohut6.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru Dut İhracatından 5 Milyon Dolar Gelir Sağlandı.</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/findik4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/bugday4.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Türkiye, hurma İthalatı için 5 yılda 218,6 milyon dolar harcadı.</h4>
                                    {{--                        <p>App</p>--}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="#">
                                <div class="portfolio-img"><img src="{{asset('uploads')}}/kuru_meyve.jpg" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4 style="text-transform: capitalize;">Kuru meyve İhracatında hedef 685 milyon dolar. </h4>
                                </div>
                            </a>
                        </div>


                    </div>

                </div>
            </section><!-- End Portfolio Section -->

            <!-- ======= Why Us Section ======= -->

            <!-- ======= About Us Section ======= -->


    @endif



    </main>
@endsection
@section('js')

    <script type="text/javascript">
        $('#captcha').click(function () {
            $.ajax({
                type: 'GET',
                url: '{{route('back.contact.reloadCaptcha')}}',

                success: function (data){

                    $(".captcha span").html(data.captcha);

                }
            });
        });
    </script>
@endsection
