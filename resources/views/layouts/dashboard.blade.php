<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sedowstudios') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- css animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    @livewireScripts
{{-- 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" integrity="sha512-GgUcFJ5lgRdt/8m5A0d0qEnsoi8cDoF0d6q+RirBPtL423Qsj5cI9OxQ5hWvPi5jjvTLM/YhaaFuIeWCLi6lyQ==" crossorigin="anonymous" />
     --}}
     @yield('extra-scripts')
</head>
<body>
    <style>
        .sidebar-link-item {
        color: #f3f4f6;
        padding: 10px;
        border-radius: 3px;
        margin-bottom: 5px;
        }

        .active-menu-link {
        background: rgba(62, 161, 117, 0.3);
        color: #3ea175;
        }

        .active-menu-link a {
        color: #3ea175 !important;
        }

        .sidebar-link-item > a {
        text-decoration: none;
        color: #ffffff;
        font-weight: 700;
        font-size: .8rem;
        }

        .sidebar-link-item > i {
        margin-right: 10px;
        font-size: .8rem;
        }

        .sidebar-logout {
        margin-top: 20px;
        padding: 10px;
        color: #e65061;
        }

        .sidebar-logout > a {
        text-decoration: none;
        color: #e65061;
        font-weight: 700;
        text-transform: uppercase;
        font-size: .8rem;
        }

        .sidebar-logout > i {
        margin-right: 10px;
        font-size: .8rem;
        }

        @media only screen and (max-width: 855px) {
        /* .sidebar-link-item > a {
        font-size: .5rem;
        }

        .sidebar-link-item > i {
        font-size: .5rem;
        }

        .sidebar-logout > a {
        font-size: .5rem;
        }

        .sidebar-logout > i {
        font-size: .5rem;
        } */
        }

        @media only screen and (max-width: 480px) {
        /* .sidebar-link-item > a {
        font-size: .3rem;
        }

        .sidebar-link-item > i {
        font-size: .3rem;
        }

        .sidebar-logout > a {
        font-size: .3rem;
        }

        .sidebar-logout > i {
        font-size: .3rem;
        } */
        }
    </style>
    <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow" id="top-dash-nav">
                @livewire('admin.topnav')
            </nav>
                
            
                <div id="mySidenav" class="sidenav ">

                    <div class="row">
                        <div class="col-12">
                            <div class="sidebar__title">
                                <div class="sidebar__img">
                                    {{-- <img src="assets/logo.png" alt="logo" /> --}}
                                    <div class="row d-flex">
                                        <div class="col-8">
                                            <h1>Dashboard</h1>
                                        </div>
                                        <div class="col-4 flex-row mt-auto">
                                            <div class="form-group mt-auto">
                                                <div class="form-check" id="form-slider">
                                                    <label class="switch">
                                                        <input type="checkbox" name="addComment" onClick="toggleNightMode()">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <i
                                    onclick="closeSidebar()"
                                    class="fa fa-times"
                                    id="sidebarIcon"
                                    aria-hidden="true"
                                    ></i>
                                </div>
                            @livewire('admin.sidenav')
                        </div>
                    </div>
                    
                </div>

                <!-- the main content goes here -->
                <main id="main">
            
                        <div>
                            @yield('content')
                        </div>

                        {{-- this empty div is rendered when components from the yield section are closed --}}
                        <div></div>
                </main>
    </div>

    @include('sweetalert::alert')
    <script src="https://kit.fontawesome.com/fb165c77d4.js" crossorigin="anonymous"></script>
</body>
</html>

<script>
    var sidebarOpen = false;
    var lgSidebarOpen = true;
    var sidebar = document.getElementById("mySidenav");
    var sidebarCloseIcon = document.getElementById("sidebarIcon");

    var nightMode = false;

    function toggleSidebar() {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar_responsive");

        sidebarOpen = true;
    }
    }

    function closeSidebar() {
    if (sidebarOpen) {
        sidebar.classList.remove("sidebar_responsive");
        sidebarOpen = false;
    }
    }

    function toggleSidebarLgScreen() {
        if(lgSidebarOpen) {
            sidebar.classList.add("sidebar_hidden");
            lgSidebarOpen = false;
        } else {
            sidebar.classList.remove("sidebar_hidden");
            lgSidebarOpen = true;
        }
    }

    function toggleNightMode() {
        nightMode = !nightMode;
        if(nightMode) {
            sidebar.classList.add("dark-mode-black");
        } else {
            sidebar.classList.remove("dark-mode-black");
        }
        // console.log('night mode ' + nightMode);
    }
</script>