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
    <!-- ======= Hero Section ======= -->
    <section id="anasayfa" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{isset($header) ? $header->image:''}}" class="img-fluid animated" alt="">
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1>{{Auth::user()->name}}</h1>
                        <h4>{{Date('d/m/Y')}}</h4>
                        <h2>{{isset($header) ? $header->title : '' }}</h2>
                    </div>
                @else
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1>Uluslar Arası Dış Ticaret Hızlandırma Merkezi</h1>

                        <h2>{{isset($header) ? $header->title : '' }}</h2>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{isset($header) ?$header->image : ''}}" class="img-fluid animated" alt="">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <main id="main">
            <section id="haberler" class="portfolio">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Neler Oluyor</h2>
                        <p>Piyasada son durum ne? İlginizi çekebilecek tüm haberleri görün.</p>
                    </div>
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach($insideNews as $news)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-site">
                                <a href="{{route('front.page.newsDetail', $news->id)}}">
                                    <div class="portfolio-img">
                                        <img src="{{asset($news->image)}}" class="img-fluid" alt=""></div>
                                    <div class="portfolio-info">
                                        <h4 style="text-transform: capitalize;">{{$news->title}}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section><!-- End Portfolio Section -->
            <section id="duyurular" class="portfolio section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Duyurular</h2>
                    </div>
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach($announcements as $announcement)
                            <div style="position: relative" class="col-lg-4 col-md-6 portfolio-item filter-site">
                                <a href="{{route('front.announcementDetail', $announcement->id)}}">
                                    <div class="portfolio-img">
                                        <img src="{{asset($announcement->image)}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="portfolio-info">
                                        <h4 style="text-transform: capitalize;">{{$announcement->title}}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="faaliyetlerimiz" class="services">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>FAALİYETLERİMİZ</h2>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                <h4><a href="https://www.firatteknokent.com.tr/">Amerika Cesco şirketi ile ortak çalışma</a></h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-file"></i></div>
                                <h4><a href="http://www.firatteknokent.com/">Teknokent ile ortak çalışma</a></h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-tachometer"></i></div>
                                <h4><a href="https://www.firatteknokent.com.tr/">Türkish Exporter ile ortak çalışma</a></h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-layer"></i></div>
                                <h4><a href="">Ten Data ile ortak çalışma</a></h4></div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="why-us" class="why-us section-bg">
                <div class="container-fluid" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                            <div class="content">
                                <h3><strong>Merkezimiz ve ihracat ile ilgili sorulara cevap mı arıyorsunuz? </strong>Bize sorulan en yaygın soruları aşağıda bulabilirsiniz.</h3>
                                <p>
                                    Uluslar arası dış ticaret bilgileri dahilinde cevaplandırılmıştır.
                                </p>
                            </div>
                            <div class="accordion-list">
                                <ul>
                                    <li>
                                        <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>1</span> Mevzuat nedir? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                            <p>
                                                Mevzuat, yürürlükteki hukuk kurallarının bütünüdür. Türk mevzuat sistemi yukarıdan aşağıya doğru Anayasa, Kanun, Cumhurbaşkanlığı kararnamesi ve yönetmelikten oluşur. Bu dört norm Türk hukuk sisteminin normlar hiyerarşisi olup Türk mevzuat sistemi aynı zamanda yürütme organlarınca yayımlanarak yürürlüğe giren genel tebliğ, tebliğ, genelge, yönerge gibi adsız düzenleyici işlemlerden de oluşur.

                                                Genel bir kural olarak kanunlar Anayasa'ya, yönetmelikler de ilgili kanuna aykırı olamaz.

                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>2</span> Türkiye'deki mevzuat çeşitleri nelerdir? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                            <p>
                                                Türkiye mevzuatı, Türkiye'de yürürlükte olan yasa, cumhurbaşkanlığı kararnamesi, tüzük ve yönetmelik gibi hukuki düzenlemelerin hepsini ifade eder.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>3</span> Yönetmelikleri kim onaylar? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                        <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                            <p>
                                                Kanunla ilgili uygulanabilecek yöntemler hakkında bilgilendirme yapan yönetmelik; Cumhurbaşkanı, ilgili bakanlıklar, kamu tüzel kişileri ve bakanlar kurulu tarafından çıkarılabilir. Bakanlar kurulu tarafından çıkarılan yönetmeliklerde Cumhurbaşkanı'nın imzası istenir. çıkarabilirler.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{asset('front/Arsha')}}/assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                    </div>
                </div>
            </section>

        <section id="iletisim" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>İletişim</h2>
                </div>
                <div class="row">
                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Konum:</h4>
                                <p>{{isset($contact) ? $contact->address:''}}</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>{{isset($contact) ? $contact->email:''}}</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Telefon:</h4>
                                <p>{{isset($contact) ? $contact->phone: ''}}</p>
                            </div>
                            <div id="map" style="height: 300px; width: 100%"></div>
                            <script>
                                function initMap() {
                                    var myLatLng = {lat: 38.673959, lng: 39.167401};
                                    var latInput = document.getElementById("lat");
                                    var lngInput = document.getElementById("lng");
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 16,
                                        center: myLatLng
                                    });
                                    var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                        draggable: true
                                    });
                                    google.maps.event.addListener(marker, 'drag', function (event) {
                                        latInput.value = event.latLng.lat();
                                        lngInput.value = event.latLng.lng();
                                    });
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUjAm2tPoJgyjFKXd8Q0hkF2dgffg5tn4&callback=initMap"
                                    async defer></script>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form action="{{route('back.contact.store')}}" method="POST" role="form" enctype="multipart/form-data" class="php-email-form">
                            @csrf

                            <div class="form-group">
                                <label for="name">İsim</label>
                                <input type="text" name="name"  class="form-control" id="name" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">E-posta</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Telefon</label>
                                    <input type="text" class="form-control"  name="phone" id="phone" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Mesaj</label>
                                <textarea class="form-control" name="description" rows="10" required></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <img src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()" id="captchaCode" alt="" class="captcha ">
                                    <a rel="nofollow" href="javascript:" onclick="document.getElementById('captchaCode').src='captcha/flat?'+Math.random()" class="refresh">
                                        <button type="button" class="btn  btn-primary"><i class="bi bi-arrow-counterclockwise"></i></button>
                                    </a>
                                </div>
                                <div class="form-group pr-2 col-md-8">
                                    <input id="captcha" type="text" class="form-control" placeholder="Kodu giriniz" name="captcha" required>
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="loading">Gönderiliyor</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Mesajınız bizlere başarıyla ulaştı.</div>
                            </div>
                            <div class="text-center"><button type="submit">Gönder</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script>
        $(window).load(function () {
            var phones = [{"mask": "(###) ###-##-##"}];
            $('#phone').inputmask({
                mask: phones,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
            });
        });
    </script>

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
