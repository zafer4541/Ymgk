<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UADT'ye Kayıt Ol</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/app.css')}}">
    <link rel="stylesheet" href="{{asset('Mazer/auth.css')}}">
    <link rel="stylesheet" href="{{(asset('front/css/job.css'))}}">
    <style>
        @media (max-width:450px) {
            form{
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 100% !important;
            }
            .form-group{

            }
            .form-group input , .btn-lg{
                width: 100% !important;

            }
            ::placeholder{
                font-size:5vw!important;
            }
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
                <h1 class="
                uth-title">Kayıt Ol</h1>
                <p class="auth-subtitle mb-5">İhracatlara ulaşmaya cok yakınsınız!</p>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                    <br>
                @endif
                <form  action="{{route('register')}}"  method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text"  name="name"  class="form-control form-control-xl" placeholder="Kullanıcı Adı">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4" >
                        <input type="text"  id="email"   name="email"  class="form-control form-control-xl" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>



                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"  id="password" name="password" class="form-control form-control-xl" placeholder="Şifre">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>


                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"  id="password_confirmation" name="password_confirmation" class="form-control form-control-xl" placeholder="Şifre Tekrarı">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5 log_button">Kayıt ol</button>
                </form>

                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Zaten hesabınız var mı? <a  href="{{ route('login') }}" class="font-bold">Giriş</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block  reg-img">

            <div id="auth-right" >
                <img src="{{asset('front/assets/img/bdthm.png')}}" style="height: 100%!important;" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    </div>

</div>

</body>

</html>
