@extends('front.layouts.master')
@section('title')
@section('content')
    <div class="row bg-dark">
        <section class="ftco-section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section text-white">İletişim</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="wrapper">
                            <div class="row no-gutters">
                                <div class="col-md-6 d-flex align-items-stretch">
                                    {!! $webContact->map !!}
                                </div>
                                <div class="col-md-6 d-flex align-items-stretch mx-auto " >
                                    <div class="info-wrap w-100 p-md-5 p-4 py-5 img">
                                        <div class="dbox w-100 d-flex align-items-start ">
                                            <div class="icon d-flex align-items-center justify-content-center bg-white">
                                                <span class="fa fa-map-marker"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p class="text-white"><span>Adres:</span>  {{$webContact->address}}</p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center bg-white">
                                                <span class="fa fa-phone"></span>
                                            </div>
                                            <div class="text pl-3 text-white">
                                                <p><span>Phone:</span> {{$webContact->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center bg-white">
                                                <span class="fa fa-paper-plane"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Email:</span> <a href="mailto: {{$webContact->email}}"> {{$webContact->email}}</a></p>
                                            </div>
                                        </div>

                                        <div class="info-wrap-icon align-items-center">
                                            <div>
                                                <a class="btn btn-dark btn-social mx-2 bg-transparent text-white border-1 border-white" target="_blank" href="{{$webContact->twitter}}"><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-dark btn-social mx-2 bg-transparent text-white border-1 border-white" target="_blank"  href="{{$webContact->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-dark btn-social mx-2 bg-transparent text-white border-1 border-white" target="_blank"  href="{{$webContact->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                                                <a class="btn btn-dark btn-social mx-2 bg-transparent text-white border-1 border-white" target="_blank"  href="{{$webContact->instagram}}"><i class="fab fa-instagram"></i></a>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Bizimle İletişime Geçin</h2>
            <h3 class="section-subheading text-muted">Dış Ticaret Hızlandırma Merkezi</h3>
        </div>

        <form action="{{route('back.contact.store')}}" method="post" enctype="multipart/form-data" id="contactForm" >
            @method('POST')
            @csrf
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input maxlength="30" class="form-control" name="name" type="text" placeholder="Adınız Soyadınız *" />
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" name="email" type="email" placeholder="E-Posta Adresiniz *" />
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input maxlength="10" class="form-control" name="phone" type="tel" placeholder="Telefon Numaranız * (Örnek : 55XXXXXXXX)"  />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" name="description" placeholder="Mesajınız *" ></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-xl text-uppercase " id="submitButton" type="submit">Mesajını Gönder</button>
            </div>
        </form>
    </div>
</section>
    </div>
@endsection

