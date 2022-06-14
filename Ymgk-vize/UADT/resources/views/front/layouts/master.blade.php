<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Uluslar Arası Dış Ticaret</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('front/Arsha')}}/assets/img/favicon.png" rel="icon">
    <link href="{{asset('front/Arsha')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('front/Arsha')}}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{asset('front/Arsha')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('front/Arsha')}}/assets/css/style.css" rel="stylesheet">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>    <title>İş Adımları</title>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <script src="https://kit.fontawesome.com/51a5bd4cc4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('front/css/job.css')}}">
    <!-- =======================================================
    * Template Name: Arsha - v4.7.1
    * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    @yield('css')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- ======= Header ======= -->
<header id="header"  class="fixed-top ">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <nav id="navbar" class="navbar">
            @if(\Illuminate\Support\Facades\Auth::check())
            <ul>
                <li><a class="nav-link scrollto @if(Request::segment(1)=="") active @endif" href="{{route('front.homePage')}}">Anasayfa</a></li>
                <li><a class="nav-link scrollto @if(Request::segment(2)=="#haberler")active @endif" href="@if(Request::segment(1)=="")#haberler @else{{route('front.homePage')}}#haberler @endif">Haberler</a></li>
                <li><a class="nav-link scrollto @if(Request::segment(2)=="#duyurular")active @endif" href="@if(Request::segment(1)=="")#duyurular @else{{route('front.homePage')}}#duyurular @endif">Duyurular</a></li>
                <li><a class="nav-link scrollto @if(Request::segment(1)=="ihracatFirsatlar") active @endif" href="{{route('front.ihracatFirsatlari')}}">İhracat Fırsatları</a></li>
                <li><a class="nav-link scrollto @if(Request::segment(1)=="akilliArama") active @endif" href="{{route('front.akilliArama')}}">Akıllı Arama</a></li>
                <li><a class="nav-link scrollto @if(Request::segment(1)=="hesabim")active @endif" href="{{ route('front.account.index') }}">Hesabınız</a></li>
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->role!=='user')
                            <li><a class="nav-link scrollto" href="{{ route('back.dashboard') }}">Yönetim Paneli</a></li>
                        @endif
                    @else
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Giriş Yap</a></li>
                        @if (Route::has('register'))
                            <li><a class="" href="{{ route('register') }}">Kayıt Ol</a></li>
                        @endif
                    @endauth
                @endif
                @if(\Illuminate\Support\Facades\Auth::check())
                    <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <li><a href="{{ route('logout') }}" class="nav-link scrollto"
                               onclick="event.preventDefault(); this.closest('form').submit();"> Çıkış Yap</a>
                        </li>
                    </form>
                @endif
            </ul>
            @else
                <ul>
                    <li><a class="nav-link scrollto @if(Request::segment(1)=="") active @endif" href="{{route('front.homePage')}}">Anasayfa</a></li>
                    <li><a class="nav-link scrollto @if(Request::segment(2)=="#haberler")active @endif" href="@if(Request::segment(1)=="")#haberler @else{{route('front.homePage')}}#haberler @endif">Haberler</a></li>
                    <li><a class="nav-link scrollto @if(Request::segment(2)=="#faaliyetlerimiz")active @endif" href="@if(Request::segment(1)=="")#faaliyetlerimiz @else{{route('front.homePage')}}#faaliyetlerimiz @endif">Faaliyetlerimiz</a></li>
                    <li><a class="nav-link scrollto" href="{{route('front.about')}}">Hakkımızda</a></li>
                     <li><a class="nav-link scrollto @if(Request::segment(2)=="#iletisim")active @endif" href="@if(Request::segment(1)=="")#iletisim @else{{route('front.homePage')}}#iletisim @endif">İletişim</a></li>
                    </li>
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">Giriş Yap</a></li>
                    @if (Route::has('register'))
                        <li><a class="" href="{{ route('register') }}">Kayıt Ol</a></li>
                    @endif
                </ul>
            @endif
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
@yield('content')

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Uluslar Arası Dış Ticaret</h3>
                    <p>
                        Cumhuriyet Mah. Korgeneral <br>
                        Korgeneral Hulusi Sayın Cad.<br>
                        No:117 /Elazığ <br><br>
                        <strong>Telefon:</strong>
                        444 35 94 - 0 (424) 218 35 00<br>
                        <strong>Email:</strong> UADT@gmail.com<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links footer-two">
                    <h4> Hakkımızda</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('front.homePage')}}">Anasayfa</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('front.ihracatFirsatlari')}}">İhracat Fırsatları</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('front.akilliArama')}}">Akıllı Arama</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('front.about')}}">Hakkımızda</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('front.homePage')}}#iletisim">İletişim</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Bizi Takip Edin</h4>
                    <div class="social-links mt-3">
                        <a href="" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            Tüm haklar gizli ve saklıdır.
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="{{asset('front/Arsha')}}/assets/vendor/aos/aos.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="{{asset('front/Arsha')}}/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{asset('front/Arsha')}}/assets/js/main.js"></script>

@yield('js')
@yield('css')
</body>

</html>

