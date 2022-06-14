@if (Route::has('login'))
        <a href="{{ route('login') }}">
            Giriş Yap
        </a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}">
            Kayıt Ol
        </a>
    @endif
@endif



