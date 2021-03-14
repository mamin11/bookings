<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Sedowstudios') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="/shop">Shop</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="{{ route('viewBookings') }}">Bookings</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>

                
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
                @endauth

                
                    <li class="nav-item">
                        @livewire('cart.counter')
                    </li>
                

                @auth 
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="/logout">Logout</a>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>