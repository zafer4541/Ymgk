<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title','Elazığ Ticaret ve Sanayi Odası')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('back/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    @yield('css')
</head>
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="h2">
                        <a href="{{route('back.dashboard')}}">Uluslar Arası Dış Ticaret Admin Paneli</a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu" >
                    <li class="sidebar-item  ">
                        <a href="{{route('front.homePage')}}" target="_blank" class='sidebar-link'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                            <span>Siteyi Görüntüle</span>
                        </a>
                    </li>
                    <li class="sidebar-item @if(\Illuminate\Support\Facades\Request::segment(2)=='') active @endif  ">
                        <a href="{{route('back.dashboard')}}" class='sidebar-link'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                            </svg>
                            <span>Panel</span>
                        </a>
                    </li>
                    <li class="sidebar-item  has-sub  @if( Request::segment(2)=="Header"
                                            or  Request::segment(2)=="haberler"
                                            or Request::segment(2)=="duyurular"
                                            or Request::segment(2)=="hakkinda"
                                            or Request::segment(3)=="iletisim"
                                            ) active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Site Ayarları</span>
                        </a>
                        <ul class="submenu @if( Request::segment(2)=="Header"
                                            or  Request::segment(2)=="haberler"
                                            or Request::segment(2)=="duyurular"
                                            or Request::segment(2)=="hakkinda"
                                            or Request::segment(3)=="iletisim"
                                            ) active @endif ">
{{--                            <li class="submenu-item ">--}}
{{--                                <a href="component-list-group.html">Sabit Resimler</a>--}}
{{--                            </li>--}}
                            <li class="submenu-item @if(Request::segment(2)=='Header') active @endif">
                                <a href="{{route('back.header.update')}}">Anasayfa</a>
                            </li>
                            <li class="submenu-item @if(Request::segment(2)=="haberler") active @endif">
                                <a href="{{route('back.news')}}">Haberler</a>
                            </li>
                            <li class="submenu-item @if(Request::segment(2)=="duyurular") active @endif ">
                                <a href="{{route('back.announcements')}}">Duyurular</a>
                            </li>
                            <li class="submenu-item @if(Request::segment(2)=='hakkinda') active @endif">
                                <a href="{{route('back.web.about')}}">Hakkımızda</a>
                            </li>
                            <li class="submenu-item @if(Request::segment(3)=='iletisim') active @endif">
                                <a href="{{route('back.web.contact')}}">İletişim</a>
                            </li>


                        </ul>
                    </li>
                    <li class="sidebar-item  @if(Request::segment(2)=='kullanicilar') active @endif ">
                        <a href="{{route('back.users')}}" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Kullanıcılar</span>
                        </a>
                    </li>
                    <li class="sidebar-item  @if(Request::segment(2)=='iletisim') active @endif ">
                        <a href="{{route('back.contact')}}" class='sidebar-link'>
                            <i class="bi bi-telephone-fill"></i>
                            <span>İletişim</span>
                        </a>
                    </li>
                    <li class="sidebar-item  @if(Request::segment(2)=='ihracatlar') active @endif ">
                        <a href="{{route('back.export')}}" class='sidebar-link'>
                            <i class="bi bi-map-fill"></i>
                            <span>İhracat Fırsatları</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <section class="row">
                <div class="col-9 col-lg-9">
                    <h3>@yield('headingTitle','Uluslar Arası Dış Ticaret Hızlandırma Platformu')</h3>
                </div>
                <div class="col-3 col-lg-3">
                    @include('front.widget.user')
                </div>
            </section>
        </div>
        <div class="page-content">
            @yield('content')
        </div>
        <footer>
            <div class="footer mb-0 text-muted" >
                <div class="float-start">
                    <p> "UADT" <small> Tüm hakları saklıdır. </small> </p>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{asset('back/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('back/dist/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('back/dist/assets/vendors/apexcharts/apexcharts.js')}}"></script>
<script src="{{asset('back/dist/assets/js/pages/dashboard.js')}}"></script>
<script src="{{asset('back/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('back/dist/assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<script src="{{asset('back')}}/dist/assets/js/main.js"></script>
<script src="{{asset('back')}}/dist/assets/js/drag.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

@yield('js')
<script>
    removeUselessElement()
    function removeUselessElement(){
        let buttons = document.querySelectorAll('button.note-btn')
        for(let i = 0 ; i < buttons.length ; i++){
            if(buttons[i].getAttribute('aria-label') === 'Picture'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Video'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Table'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Link (CTRL+K)'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Full Screen'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Full Screen'){
                buttons[i].style.display = "none"
            }
            if(buttons[i].getAttribute('aria-label') === 'Code View'){
                buttons[i].style.display = "none"
            }
        }
    }
</script>
</html>
