<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- Site Title -->
    <title>KPU</title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logos/kpu-logo1.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gantari:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bexon-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/odometer-theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>

<body>
    <!-- start: Search Popup -->
    <div class="search-popup-overlay"></div>
    <!-- end: Search Popup -->

    <!-- end: Offcanvas Menu -->

    <!-- start: Hamburger Menu -->
    <div class="hamburger-area d-lg-none">
        <div class="hamburger_bg"></div>
        <div class="hamburger_wrapper">
            <div class="hamburger_inner">
                <div class="hamburger_top d-flex align-items-center justify-content-between">
                    <div class="hamburger_logo">
                        <a href="index-11.html" class="mobile_logo">
                            <img src="{{ asset('assets/images/logos/kpu-logo1.png') }}" alt="Logo" />
                        </a>
                    </div>
                    <div class="hamburger_close">
                        <button class="hamburger_close_btn">
                            <i class="fa-thin fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="hamburger_menu">
                    <div class="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    @include('frondend.header')
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main id="primary" class="site-main">
                <div class="top-space-15"></div>
                @yield('content')
                @include('frondend.form')
            </main>
            @include('frondend.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollSmoother.js') }}"></script>
    <script src="{{ asset('assets/js/gsap-scroll-to-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap-scroll-trigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap-split-text.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/js/appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
