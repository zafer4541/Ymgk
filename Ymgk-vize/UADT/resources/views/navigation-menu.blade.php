<nav x-data="{ open: false }" class="bg-gray-500 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  ">
        <div class="flex justify-between h-16 ">
            <div class="flex">
                <a class="navbar-brand" href="{{route('front.homePage')}}"><img style="width: 4em" src="{{asset('front')}}/assets/img/logo.jpeg" alt="..." /></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="py-3 px-3">
                @include('front.widget.user')
            </div>

        </div>
    </div>
</nav>








