@extends('back.layouts.master')
@section('title', 'Bize Ulaşın Güncelleme Paneli')
@section('headingTitle','Bize Ulaşın Güncelleme Paneli')
@section('content')
    @if(session('addWebContactSuccess'))
        <script>
            Swal.fire({
                position: 'top-enter',
                icon: 'success',
                title: '{{(session('addWebContactSuccess'))}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <style>
        #map-canvas{
            width: 350px;
            height: 250px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm6W2eLH449DgLTpoKGFsKO_gK20zcUUo&libraries=place" type="text/javascript"></script>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if($errors->count()>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        <li>{{$err}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                                <div class="container px-5 my-5">
                                    <form id="contactForm" action="{{route("back.web.contact.update")}}" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="address" name="address" type="text" placeholder="Adres" style="height: 4rem;" value="{{$webContact->address}}"  data-sb-validations="required"></input>
                                            <label for="adres">Açık Adres</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Adres" value="{{$webContact->email}}" data-sb-validations="required,email" />
                                            <label for="emailAdres">E-Mail Adresi</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="phone" name="phone" type="tel"  value="{{$webContact->phone}}" placeholder="Telefon" data-sb-validations="required" />
                                            <label for="telefon">Telefon Numarası</label>
                                        </div>
                                        <span class="">Sosyal Medya Hesaplarının Linkleri</span>
                                        <div class="row">
                                            <div class="new-chat-window" style="padding-left: 0px!important; padding-right:1.2rem!important;">
                                                <i class="fa fa-search"><i class="bi bi-twitter"></i></i>
                                                <input type="text" name="twitter" class="new-chat-window-input pl-5" value="{{$webContact->twitter}}" placeholder="Twitter" />
                                            </div>
                                            <div class="new-chat-window" style="padding-left: 0px!important; padding-right:1.2rem!important;">
                                                <i class="fa fa-search"><i class="bi bi-facebook"></i></i>
                                                <input type="text" name="facebook" class="new-chat-window-input pl-5" value="{{$webContact->facebook}}" placeholder="Facebook" />
                                            </div>
                                            <div class="new-chat-window" style="padding-left: 0px!important; padding-right:1.2rem!important;">
                                                <i class="fa fa-search"><i class="bi bi-linkedin"></i></i>
                                                <input type="text" name="linkedin" class="new-chat-window-input pl-5" value="{{$webContact->linkedin}}" placeholder="Linkedin" />
                                            </div>
                                            <div class="new-chat-window" style="padding-left: 0px!important; padding-right:1.2rem!important;">
                                                <i class="fa fa-search"><i class="bi bi-instagram"></i></i>
                                                <input type="text" name="instagram" class="new-chat-window-input pl-5" value="{{$webContact->instagram}}" placeholder="instagram" />
                                            </div>
                                        </div>
                                        <label for="exampleInputEmail1">Harita</label>
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
                                        <br>

                                        <div class="form-group row">
                                            <div class="offset-12 col-12">
                                                 <button class="btn btn-primary float-end" id="submitButton" type="submit">Bilgileri Güncelle</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
@endsection
