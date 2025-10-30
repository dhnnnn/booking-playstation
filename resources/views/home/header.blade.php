<div class="header-top">
    <div class="container">
        <div class="d-flex align-items-center">
            <div id="logo">
                <a href="{{url('/')}}"><img src="img/Logo.png" alt="" title="" /></a>
            </div>
            <div class="ml-auto">
                    @if (Route::has('login'))
                            @auth
                                <!-- Dropdown for authenticated user -->
                                <li class="nav-item dropdown list-unstyled">
                                    <button 
                                        class="btn-gaming dropdown-toggle border-0 focus:outline-none focus:ring-0"
                                        id="userDropdown" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-dark list-unstyle" aria-labelledby="userDropdown">
                                        @if(Auth::user()->usertype == 'admin')
                                            <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                        @endif

                                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <li><a class="dropdown-item" href="{{ route('api-tokens.index') }}">API Tokens</a></li>
                                        @endif

                                        <li><hr class="dropdown-divider"></li>

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Log Out</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            @else
                                <a
                                    href="{{url('/login')}}"
                                    class="btn-gaming text-decoration-none"
                                    >
                                    login
                                </a>

                                @if (Route::has('register'))
                                <a
                                    href="{{url('/register')}}"
                                    class="btn-gaming btn-outline d-none d-lg-inline text-decoration-none"
                                    >
                                    Registers
                                </a>
                                @endif
                            @endauth
                    @endif
            </div>
        </div>
    </div>
    </div>
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav">
                        <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/about')}}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/room')}}">Room</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/gallery')}}">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/contact')}}">Contact</a></li>

                        @if (Route::has('login'))
                            @auth
                                @if(Auth::user()->usertype == 'user')
                                    <li class="nav-item"><a class="nav-link" href="contact.html">Transaksi</a></li>                
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
                <ul class="social-icons ml-auto">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                      <li><a href="#"><i class="fas fa-rss"></i></a></li>
                </ul>                
            </div>
        </nav>        
    </div>
</div>