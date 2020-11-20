
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-m" id="top-dash-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" onclick="checkToggle()" type="button" data-toggle="collapse" data-target="#navbarSupportedContentREMOVED" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item pr-4">
                    <a class="nav-link icons-font-size">
                        <i class="fas fa-3x fa-arrow-left top-icon-style"></i>
                    </a>
                </li>
                <li class="nav-item pr-4">
                    <a class="nav-link icons-font-size">
                        <i class="fas fa-3x fa-redo top-icon-style"></i>
                    </a>
                </li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" >
                    <a class="nav-link pl-5 icons-font-size">
                        <i class="fas fa-4x fa-home top-icon-style"></i>
                    </a>
                </li>
                <li class="nav-item" onclick="checkToggle()">
                    <a class="nav-link pl-5 icons-font-size" >
                        <i class="fas fa-4x fa-bars top-icon-style"></i>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="mySidenav" class="sidenav">
        {{-- <a href="javascript:void(0)" class="closebtn" onclick="checkToggle()">&times;</a> --}}
        <a href="#" class="hideText icon-span menu-active">
            <i class="fas fa-2x fa-calendar-check pr-4"></i>
            <span>Calendar</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-clock pr-4"></i>
            <span>Bookings</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-user-friends pr-4"></i>
            <span>Customers</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-file-alt pr-4"></i>
            <span>Invoices</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-shopping-cart pr-4"></i>
            <span>Services</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-paper-plane pr-4"></i>
            <span>SMS templates</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-chart-bar pr-4"></i>
            <span>Statistics</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-id-badge pr-4"></i>
            <span>Staff</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-toolbox pr-4"></i>
            <span>Settings</span>
        </a>
        <a href="#" class="hideText icon-span">
            <i class="fas fa-2x fa-user-circle pr-4"></i>
            <span>My account</span>
        </a>
    </div>
    

    
    <!-- the main content goes here -->
    <div id="main">
        <button wire:click.prevent="openComponent" type="button" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            ADD BOOKING</button>

            @if ($showBookingComponent)
                @livewire('booking-component')                            
            @endif
            <div></div>
    </div>

















        <script>

            var toggle = false;

            function checkToggle()
            {


                if(!toggle) {
                    openNav();
                } else {
                    closeNav();
                }
            }

        /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
            function openNav() {
                toggle = true;

                // sideNav = document.getElementById('mySidenav');
                // mainArea = document.getElementById('main');

                document.getElementById("mySidenav").style.width = "250px";
                // document.classList.remove('showNavText');
                document.getElementById("main").style.marginRight = "250px";

                var elements = document.getElementsByClassName('icon-span');
                var i;
                    for (i = 0; i < elements.length; i++) {
                        elements[i].classList.remove('hideText');
                    }
            }
            
            /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
            function closeNav() {
                toggle = false;

                // sideNav = document.getElementById('mySidenav');
                // mainArea = document.getElementById('main');

                document.getElementById("mySidenav").style.width = "100px";
                // document.classList.append('showNavText');
                document.getElementById("main").style.marginRight = "0";

                var elements = document.getElementsByClassName('icon-span');
                var i;
                    for (i = 0; i < elements.length; i++) {
                        elements[i].classList.add('hideText');
                    }
            }
        </script>
