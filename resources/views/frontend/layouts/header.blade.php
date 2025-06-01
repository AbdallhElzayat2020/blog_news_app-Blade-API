<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{ $getSetting->site_email }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $getSetting->site_phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    @guest
                        <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    @endguest

                    {{-- logout --}}
                    @auth('web')
                        <div class="d-flex justify-content-end">

                            <!-- Logout Modal -->
                            @include('frontend.layouts.logout')

                            <a href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <a href="{{ route('frontend.dashboard.profile') }}"><i class="fas fa-user"></i> {{auth('web')->user()->username}}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset($getSetting->site_logo) }}" alt="Logo"/>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">

                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('frontend.search') }}" method="post">
                    @csrf
                    <div class="b-search">
                        <input type="text" name="search" placeholder="Search"/>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                <div class="navbar-nav mr-auto">
                    <a title="home" href="{{ route('frontend.home') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            @foreach($categories as $category)
                                <a href="{{ route('frontend.category-posts',$category->slug) }}" title="{{$category->name}}" class="dropdown-item">
                                    {{$category->name}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="single-page.html" class="nav-item nav-link">Single Page</a>
                    <a href="dashboard.html" class="nav-item nav-link">Dashboard</a>
                    <a title="contactUs" href="{{ route('frontend.contact.show') }}" class="nav-item nav-link">Contact Us</a>
                </div>

                <div class="social ml-auto">

                    <a title="x_link" href="{{ $getSetting->x_link }}">
                        <i class="fab fa-twitter"></i>
                    </a>

                    <a title="facebook_link" href="{{ $getSetting->facebook_link }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a title="linkedin_link" href="{{ $getSetting->linkedin_link }}">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a title="instagram_link" href="{{ $getSetting->instagram_link }}">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a title="youtube_link" href="{{ $getSetting->youtube_link }}">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a title="whatsapp_link" href="{{ $getSetting->whatsapp_link }}">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a title="telegram_link" href="{{ $getSetting->telegram_link }}">
                        <i class="fab fa-telegram"></i>
                    </a>

                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
