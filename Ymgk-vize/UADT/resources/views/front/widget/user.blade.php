

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('back')}}/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('back')}}/dist/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="{{asset('back')}}/dist/assets/css/app.css">
<script src="{{ mix('js/app.js') }}" defer></script>
<div class="hidden sm:flex sm:items-center sm:ml-12">
<!-- Settings Dropdown -->
    <div>
        <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex text-sm border-3 border-transparent rounded-full  focus:border-gray-300 transition">
                        <img class="bg-gray-200 h-8 w-8 rounded-full object-cover" src="@if(Auth::user()->profile_photo_path !=null) {{asset('storage/'.Auth::user()->profile_photo_path)}} @else{{Auth::user()->profile_photo_url }}@endif" alt="{{ Auth::user()->name }}" />
                        <div class="ms-lg-3" >
                            <h6 style=" @if(Request::segment(1)!="panel")color:#021130!important; @else color:rgb(37, 57, 111)!important;opacity: 0.9; @endif margin-top: 8px !important;" class="font-bold">{{ Auth::user()->name }}</h6>
                        </div>
                    </button>
                @else
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">{{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                @if(auth()->user()->role!=='user')
                    <div class="block px-4 py-2 text-sm  text-gray-400 bg-gray-200" style="border-radius:3px;color: #021130!important;">
                        {{ __('Panel İşlemleri') }}
                    </div>

                    <x-jet-dropdown-link href="{{route('back.dashboard')}}" style="text-decoration: none; color: #021130!important;">
                        {{ __('Panel') }}
                    </x-jet-dropdown-link>
                @endif
                <div class="block px-4 py-2 text-sm text-gray-400 bg-gray-200" style="border-radius:3px;color: #021130!important;">
                    {{ __('Hesabı Yönet') }}
                </div>

                <x-jet-dropdown-link href="{{route('front.profile', \Illuminate\Support\Facades\Auth::user()->id)}}" style="text-decoration: none;color: #021130!important;">
                    {{ __('Profil') }}
                </x-jet-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}" >
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();" style="text-decoration: none;color: #021130!important;">
                        {{ __('Çıkış Yap') }}
                    </x-jet-dropdown-link>
                </form>
            </x-slot>
        </x-jet-dropdown>
    </div>
</div>

