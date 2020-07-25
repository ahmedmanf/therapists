<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/fontawesome-free-5.14.0-web/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-4.5.0/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/extra.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/datepicker/bootstrap-datepicker.en-CA.min.js')}}"></script>
    <script src="{{asset('js/extra.js')}}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand mr-5" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="btn btn-primary">
                            <a href="{{route('index')}}" class="text-white">Therapist</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <li class="dropdown">
                            <a id="navbarDropdown"
                               class="nav-link dropdown-toggle"
                               href="#" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false" v-pre
                            >
                                Dashboard <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @guest
                                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('therapists') }}">
                                        Therapists
                                    </a>
                                    <a class="dropdown-item" href="{{ route('reservations') }}">
                                        Reservations
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </div>

                        </li>
                    </ul>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="bg-dark footer" id="scroll-to">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 justify-content-center">
                        <img src="{{asset('images/logo.png')}}" alt="Almoasher" class="mt-5" />
                    </div>
                    <div class="col-md-8">
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <h4 class="text-white text-uppercase">About us</h4>
                                <p class="text-white">
                                    Business Academy is a dream that has never gone beyond the mind and heart of each of us in the Business Business team, and we have all strived with all power and faith to achieve it and transfer it from the world of dreams to reality.
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h4 class="text-white text-uppercase">Managements</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Development</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Software</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Mobile Apps</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Accounting</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="text-white text-uppercase">Pages</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Terms</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Conditions</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Privacy</a>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <a href="#">Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
