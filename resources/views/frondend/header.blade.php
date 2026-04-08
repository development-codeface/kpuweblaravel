<header class="header-area header-1 header-absolute section-gap-x">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="header-wrapper ">
                    {{-- <div class="container"> --}}
                    <!-- site logo -->
                    <div class="site_logo">
                        <a class="logo" href="/home"><img src="assets/images/logos/kpu-logo1.png" alt="" /></a>
                    </div>
                    <!-- navigation -->
                    <div class="menu-area d-none d-lg-inline-flex align-items-center">
                        <div class="header-top-content">

                            <div class="header-info">
                                @if (isset($menus['header-menu']))
                                    @foreach ($menus['header-menu']->menuItems as $menu)
                                        <div class="info-item">
                                            <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <p class="topbar-text">
                                Emergency <a href="tel:8089091313">808-909-1313</a>
                            </p>
                        </div>
                        <nav id="mobile-menu" class="mainmenu">
                            <ul>
                                @if (isset($menus['main-menu']))
                                    @foreach ($menus['main-menu']->menuItems as $menu)
                                        @php
                                            $menuUrl = trim((string) ($menu->url ?? ''), '/');
                                            $isSpecialityMenu = in_array($menuUrl, ['Specialities', 'specialities', 'speciality', 'spaciality'], true);
                                        @endphp
                                        @if ($menu->submenus->count() > 0)
                                            <li class="has-dropdown">
                                                <a href="{{ $menu->url ?? '#' }}">
                                                    {{ $menu->name }}
                                                </a>

                                                <ul class="sub-menu">
                                                    @foreach ($menu->submenus as $sub)
                                                        @php
                                                            $subUrl = $sub->url ?? '#';

                                                            if ($isSpecialityMenu && !empty($departmentSpecialityUrls[$sub->name])) {
                                                                $subUrl = $departmentSpecialityUrls[$sub->name];
                                                            }
                                                        @endphp
                                                        <li>
                                                            <a href="{{ $subUrl }}">
                                                                {{ $sub->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $menu->url ?? '#' }}">
                                                    {{ $menu->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
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
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Search Popup -->
</header>
