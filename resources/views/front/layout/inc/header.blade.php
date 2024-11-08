<!-- Navbar start -->
<header class="section-t-space">
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3">
                        <i class="fas fa-map-marker-alt me-2" style="color: yellow;"></i>
                        <a href="http://maps.google.com/maps?q={{ urlencode(get_settings()->site_address) }}" target="_blank" style="color: yellow;">{{ get_settings()->site_address }}</a>
                    </small>
                    <small class="me-3">
                        <i class="fas fa-envelope me-2" style="color: yellow;"></i>
                        <a href="mailto:{{ get_settings()->site_email }}" style="color: yellow;">{{ get_settings()->site_email }}</a>
                    </small>
                </div>

                <div class="top-link pe-2">
                    <a href="{{ route('privacy.policy') }}" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="{{ route('terms.use') }}" class="text-white"><small class="text-white mx-2">Terms of Use</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="/">
                    <img src="/images/site/{{ get_settings()->site_logo }}" class="blur-up lazyload logo-img" alt style="max-width: 300px; height: auto;">
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('home-page') }}" class="nav-item nav-link {{ request()->routeIs('home-page') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('shop') }}" class="nav-item nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Shops</a>
                        <a href="{{ route('seller.register') }}" class="nav-item nav-link {{ request()->routeIs('shopdetail') ? 'active' : '' }}">Seller Zone</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fas fa-comment-dots fa-2x me-2 text-primary"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                        
                        @if(auth('buyer')->check())
                            <div class="d-flex align-items-center me-4">
                                <i class="fas fa-user fa-2x me-2"></i>
                                <span class="me-2">{{ auth('buyer')->user()->name }}</span>
                                <a href="{{ route('buyer.profile') }}" class="btn btn-outline-primary btn-sm me-2" title="My Account">
                                    <i class="fas fa-cog"></i>
                                </a>
                                <a href="{{ route('buyer.logout') }}" class="btn btn-outline-danger btn-sm" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('buyer.register') }}" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        @endif


                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- Navbar End -->