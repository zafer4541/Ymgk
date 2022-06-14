<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UADT Giriş</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/app.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/auth.css')}}">
    <style>
        @media (max-width:1180px) {
            .auth-title{font-size:3vw;!important;}
            .auth-subtitle.mb-5{font-size:2vw;!important;}
        }
        @media (max-width:481px) {
            .log_button {
                 width:100%!important;
            }
            .form-group[class*=has-icon-] .form-control.form-control-xl {
                 width:100% !important;
            }
            .auth-subtitle.mb-5{
                font-size: 4vw!important;
            }
            #auth #auth-left .auth-title{font-size:8vw!important;}
            button.mt-5{font-size:3vw!important;margin-top:20px!important;}

        }
    </style>
</head>

<body>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="logo">
                    <img style="width: 25%;" src="{{asset('front/assets/img/logomavi.png')}}" alt="Logo">
                </div><br><br>
                <h1 class="auth-title">Şifremi Unuttum</h1>
                <p class="auth-subtitle mb-5 forgt-text">Dış Ticaret Hızlandırma Merkezi</p>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert-danger">
                            {{$error}}
                        </div>
                    @endforeach

                @endif
                <form  method="POST" action="{{ route('password.email') }}" >
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4" >
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus class="form-control form-control-xl block mt-1 w-full" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>




                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5 log_button">Eposta şifre sıfırlama bağlantısı</button>
                </form>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block">

            <div id="auth-right" >
                <img src="{{asset('front/assets/img/bdthm.png')}}" style="height: 100%!important;object-fit: contain!important;" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    </div>

</div>
</body>

</html>
