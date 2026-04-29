@extends('frondend.app')
@section('content')

    <section class="tj-page-header section-gap-x insurence-page" data-bg-image="{{ asset($banner->image) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $banner->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title">{{ $banner->title }}</h1>
                        <p class="desc">
                            {{ $banner->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <div class="tj-sidebar-widget service-categories wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">More services</h4>
                            <ul>
                                @foreach ($menu as $menuItem)
                                    <li>
                                        <a href="#menu-{{ $menuItem->id }}" class="scroll-link">
                                            {{ $menuItem->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        @foreach ($menu as $menuItems)
                            @foreach ($menuItems->contents as $item)
                                <div id="menu-{{ $item->menus_id }}" class="service-section">
                                    <br>
                                    <h2 class="title title-anim">
                                        {{ $item->title }}
                                    </h2>

                                    <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                                        <img src="assets/images/service/service-details.webp" alt="Images" />
                                    </div>
                                    <div class="blog-text">
                                        <p class="wow fadeInUp" data-wow-delay=".3s">
                                            {{ $item->description }}
                                        </p>

                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start: About Section -->
    <section class="tj-about-section h6-about section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content-area h6-about-content style-1 wow fadeInLeft" data-wow-delay=".2s">
                        <div class="sec-heading style-2 style-6">
                            <h2 class="sec-title title-anim">{{ $content->title }}</h2>
                            <p class="desc wow fadeInUp" data-wow-delay=".8s">
                                {{ $content->description }}
                            </p>
                        </div>
                    </div>
                     <div class="hspt-grid-contents">
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                        <div class="content-area-grid">
                            <h4 class="grid-content-title">Our International Services</h4>
                            <p class="desc">We provide comprehensive medical services to patients from around the world, </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-img-area h6-about-img wow inter-national fadeInLeft" data-wow-delay=".2s">
                        <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">
                            <img data-speed=".8" src="{{  $content->image  }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- end: About Section -->

    <!-- start: Project Section -->
    <section class="tj-project-section-3 section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i
                                class="tji-box"></i>{{ $facility->title }}
                        </span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">
                                <h2 class="sec-title ">
                                    {{ $facility->sub_title }}
                                </h2>
                            </div>
                            <div class="slider-navigation d-none d-md-inline-flex wow fadeInUp" data-wow-delay=".5s">
                                <div class="slider-prev">
                                    <span class="anim-icon">
                                        <i class="tji-arrow-left"></i>
                                        <i class="tji-arrow-left"></i>
                                    </span>
                                </div>
                                <div class="slider-next">
                                    <span class="anim-icon">
                                        <i class="tji-arrow-right"></i>
                                        <i class="tji-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="swiper project-slider-2">
                            <div class="swiper-wrapper">
                                @foreach ($facility->content as $value)
                                    <div class="swiper-slide">
                                        <div class="project-item">

                                            <div class="project-img">
                                                <img src="{{ asset('images/facility/' . $value->image) }}" alt="">

                                                <div class="project-content">
                                                    <span class="categories"><a
                                                            href="portfolio-details-2.html">{{ $value->button_text }}</a></span>
                                                    <div class="project-text">
                                                        <h4 class="title"><a
                                                                href="portfolio-details-2.html">{{ $value->heading }}</a>
                                                        </h4>
                                                        <a class="project-btn" href="portfolio-details-2.html">
                                                            <i class="tji-arrow-right-big"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.scroll-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute('href'));

                window.scrollTo({
                    top: target.offsetTop - 120,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
