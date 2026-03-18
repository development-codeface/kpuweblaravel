<header class="header-area header-1 header-absolute section-gap-x">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <!-- site logo -->
                    <div class="site_logo">
                        <a class="logo" href="index.html"><img src="assets/images/logos/kpu-logo1.png"
                                alt="" /></a>
                    </div>
                    <!-- navigation -->
                    <div class="menu-area d-none d-lg-inline-flex align-items-center">
                        <div class="header-top">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="header-top-content">
                                            <p class="topbar-text">
                                                Emergency <a href="tel:8089091313">808-909-1313</a>
                                            </p>
                                            <div class="header-info">
                                                <div class="info-item">
                                                    <a href="/second-opinion">Send Opinion</a>
                                                </div>
                                                <div class="info-item">
                                                    <a href="/doctors">Find a Doctor</a>
                                                </div>
                                                <div class="info-item">
                                                    <a href="/career">Careers</a>
                                                </div>
                                                <div class="info-item">
                                                    <a href="#">Blogs</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav id="mobile-menu" class="mainmenu">
                            <ul>
                                @foreach ($main_menu as $menuLocation)
                                    @foreach ($menuLocation->menuItems as $menu)
                                        @if ($menu->submenus->count() > 0)
                                            <!-- HAS SUBMENU -->
                                            <li class="has-dropdown">
                                                <a href="{{ $menu->url ?? '#' }}">
                                                    {{ $menu->name }}
                                                </a>

                                                <ul class="sub-menu">
                                                    @foreach ($menu->submenus as $sub)
                                                        <li>
                                                            <a href="{{ $sub->url ?? '#' }}">
                                                                {{ $sub->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <!-- NORMAL MENU -->
                                            <li>
                                                <a href="{{ $menu->url ?? '#' }}">
                                                    {{ $menu->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>

                            <div class="header-button">
                                <a class="tj-primary-btn" href="contact.html">
                                    <span class="btn-text"><span>Request Call Back</span></span>
                                </a>
                            </div>
                        </nav>
                    </div>

                    <!-- header right info -->

                    <!-- menu bar -->
                    <div class="menu_bar mobile_menu_bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Popup -->
</header>
