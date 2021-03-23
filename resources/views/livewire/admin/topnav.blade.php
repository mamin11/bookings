
    <div class="container-fluid">
        <button class="navbar-toggler" onclick="toggleSidebar()" type="button" data-toggle="collapse" data-target="#navbarSupportedContentREMOVED" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item pr-4">
                    <a class="nav-link " href="/shop">
                        {{-- <i class="fas fa-3x fa-arrow-left top-icon-style"></i> --}}
                        Store
                    </a>
                </li>
                <li class="nav-item pr-4">
                    <a class="nav-link icons-font-size" href="/shop">
                        <i class="fas fa-3x fa-store top-icon-style"></i>
                    </a>
                </li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" >
                    <a class="nav-link pl-5 icons-font-size" href="{{route('home')}}">
                        <i class="fas fa-4x fa-home top-icon-style"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-5 icons-font-size" href="{{route('messages')}}">
                        <i class="fas fa-4x fa-bell top-icon-style" >@livewire('chat.message-count') </i>
                    </a>
                </li>
                </ul>
            </div>
        </div>


