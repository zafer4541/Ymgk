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
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{route('front.homePage')}}">Anasayfa</a></li>
                    <li>İhracat Fırsatları</li>
                </ol>
                <h2>Günlük Dış Ticaret Verileriniz</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>İhracat Fırsatlarınız</h2>
                    <p>Sizin için listelediğimiz dış ticaret verileri</p>
                </div>
                <div class="row">
                    @foreach($export as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->title}}</h5>
                                <p class="card-text">{!!substr($item->description,0,200).(strlen($item->description) > 200 ? '...':'')!!}</p>
                                <a href="{{route('front.ihracatDetay',$item->id)}}" style="" class="btn btn-primary">Deyatları Gör</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                <nav style="margin-top: 2rem;" aria-label="Page navigation example">
                    <ul class="pagination" >

                        {{$export->links()}}

                    </ul>
                </nav>
            </div>
        </section><!-- End Services Section -->

    </main><!-- End #main -->
@endsection
@section('js')
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
