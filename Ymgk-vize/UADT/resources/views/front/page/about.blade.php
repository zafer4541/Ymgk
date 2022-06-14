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
    <div class="about-content-outer">
        <div class="about-content">
@if(isset($about))
                <div class="about-left">
                    <div class="about-text">
                        <div class="about-header">
                            <div class="czg"></div>
                            <span>{!!$about->title!!}</span>
                        </div>
                        <div class="cont">

                    <span>{!!$about->description!!}</div>
                    </div>

                </div>
            @else
            <div class="about-left">
                <div class="about-text">
                    <div class="about-header">
                        <div class="czg"></div>
                        <span>ODAMIZ HAKKINDA</span>
                    </div>
                    <div class="cont">

                    <span>Dünyada Ticaret ve Sanayi Odalarının ortaya çıkış XVl.yüzyılın sonralına rastlar. Ticaret Odası adını alan ilk kuruluş MarsilyaTicaret Odası olupkuruluş yılı 1600’dür. Kuzey Amerika’da ilk Ticaret Odası1768’de New York’ta kurulmuştur. Kanada’da ilk Ticaret Odası ise 1804 yılında Halifax’ta açılmıştır. Günümüzde batılı ülkelerin Ticaret ve Sanayi Odalarında müşterek olan husus, devlet otoritelerine ve işletmelere yönelik olan müşavirlik fonksiyonlarıdır.
Dünyadaki Ticaret ve Sanayi Odalarının bir ortak özelliği de milli, merkezi bir üst organizasyon içinde bir araya gelmeleridir. Ülkemizdeki örneği Türkiye Odalar ve Borsalar Birliği’dir.
Osmanlı toplumunda Oda fikri,
batılaşma hareketleri ile birlikte gündeme gelmiştir. Bir dizi reform ve yenilikler içeren 1856 tarihli Islahat Fermanı,tüccarların odalar kurarak örgütlenmeleri gereğini ortaya çıkarmıştır.Ferman gereği nizamnameler yayımlanıp Odalar kurulmaya başlanmıştır.</span>
                    </div>
                </div>
            </div>
@endif
            <div class="about-right">
                <div class="right-one">
                    <div class="right-footer">
                        <div class="icon icon-one">
                            <div class="img">
                                <a href="{{isset($contact) ? $contact->twitter: ''}}"  target="_blank"><img src="{{asset('front/img/twtr.png')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="icon icon-two">
                            <div class="img">
                                <a href="{{isset($contact) ? $contact->instagram: ''}}" target="_blank"><img src="{{asset('front/img/inst.png')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="icon icon-three">
                            <div class="img">
                                <a href="{{isset($contact) ? $contact->facebook: ''}}"  target="_blank"><img class="fc" src="{{asset('front/img/facebook.png')}}" alt=""></a>
                            </div>
                        </div>
                    </div></div>
                <div class="right-two">
                    <div class="img1">
                        <img src="{{asset('front/img/pana.png')}}" alt="">

                    </div>
                    <div class="img2">
                        <img src="{{asset('front/img/pana2.png')}}" alt="">

                    </div>
                </div>

            </div>


        </div>
        @if(isset($about))
        <div class="logo-dinamik">
            <div class="img-ct">
                <img src="{{asset($about->image)}}" alt="">
            </div>
        </div>
        @else
        <div class="logo-dinamik">
            <div class="img-ct">
               <img src="{{asset('front/img/hesap_logo.png')}}" alt="">
            </div>
        </div>
        @endif
    </div>
@endsection

