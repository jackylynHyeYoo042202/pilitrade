<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('pageTitle')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="/images/site/{{ get_settings()->site_favicon }}" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/front/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/front/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/app-3rETTqe7.css') }}">
    @livewireStyles()
    @stack('stylesheets')
</head>

<style>
    
    /* Adjusting the position of Browse Categories behind the logo */
    .browse-category-container {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 999;
        background: white;
        padding: 10px;
        border-radius: 0 0 5px 5px;
    }

    .browse-category-container .dropdown-category {
        padding: 8px 16px;
        font-size: 14px;
        color: #000;
        display: flex;
        align-items: center;
    }

    /* Adjusting logo size if needed */
    .logo-img {
        max-width: 250px;
        height: auto;
    }

    /* Category dropdown adjustments */
    .category-dropdown {
        width: 300px;
        background-color: #f8f9fa;
        padding: 15px;
    }

    .category-list img {
        width: 30px;
        margin-right: 10px;
    }

    /* Adjust Pages dropdown size */
    .nav-item .dropdown-menu {
        width: 200px;
    }

    /* Fix the header to top */
    .fixed-top {
        top: 0;
        z-index: 1030;
        position: sticky;
    }

    /* Ensures spinner covers the full screen */
    #spinner {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Adjust the dropdown layout and scroll behavior */
    .browse-category-container .category-dropdown {
        width: 300px; /* Width of dropdown */
        max-height: 300px; /* Restrict the height */
        overflow-y: auto; /* Enable scroll for long lists */
        background-color: #f8f9fa;
        padding: 15px;
    }

    .category-list img {
        width: 30px;
        margin-right: 10px;
    }

    /* Adjust the height and layout for vertical listing */
    .category-list-container {
        max-height: 300px;
        overflow-y: auto;
    }

    /* Adjust the dropdown toggle */
    .nav-item .dropdown-category {
        padding: 8px 16px;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .logo-img {
            max-width: 150px;
        }

        .nav-item .dropdown-menu {
            width: 100%; /* Full width on mobile */
        }

        .browse-category-container {
            position: relative;
            width: 100%;
            padding: 5px;
        }

        .browse-category-container .dropdown-category {
            font-size: 12px;
            padding: 5px 10px;
        }

        .browse-category-container .category-dropdown {
            width: 100%;
            max-height: 200px;
            padding: 10px;
        }

        .container-fluid {
            padding: 15px; /* Reduce padding on mobile */
        }

        .footer .container, .container-fluid.copyright {
            padding: 10px 15px;
        }

        .btn.back-to-top {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .category-list img {
            width: 25px;
        }
    }

</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
    @include('front.layout.inc.header')
    <!-- Header End -->

    <!-- Main Content Start -->
    <div class="container-fluid py-5">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- Main Content End -->

    <!-- Footer Start -->
    @include('front.layout.inc.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    
    

    <!-- Template Javascript -->
    <script src="/front/js/main.js"></script>
    <script src="{{ asset('build/assets/app-DaqstIkQ.js') }}" defer></script>
    @livewireScripts()
    @stack('scripts')
</body>

</html>
