@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>


    <section class="tj-page-header section-gap-x" style="background-image: url('{{ asset($banner->image) }}');">

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

                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- start: About Section -->
    @if ($content)
        <section class="tj-about-section h6-about section-gap section-gap-x">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-content-area  h6-about-content  style-1 wow fadeInLeft" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                            <div class="sec-heading style-2 style-6">
                                <span class="sub-title  wow fadeInUp" data-wow-delay=".3s"
                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">{{ $content->title }}</span>
                                <h2 class="sec-title title-anim" style="">
                                    <div style="display: block; text-align: start; position: relative;">
                                        <div style="position:relative;display:inline-block;">
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                {{ $content->sub_title }}</div>
                                        </div>

                                    </div>
                                </h2>
                                <p class="desc  wow fadeInUp" data-wow-delay=".8s"
                                    style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    {!! $content->description !!}
                                </p>


                                <div class="h5-strategy-tag-wrapper quality-page">

                                    <a class="h5-strategy-tag" href="#">
                                        Growth
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="row row-gap-4 rightSwipeWrap pharmacy">
                            @foreach ($content->subContents as $sub_content)
                                <div class="col-lg-6">
                                    <div class="choose-box right-swipe"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 100% 50%; opacity: 1; transform: perspective(1200px);">
                                        <div class="choose-content">
                                            <div class="choose-icon">
                                                <i class="{{ $sub_content->icon }}"></i>
                                            </div>
                                            <h4 class="title">{{ $sub_content->heading }}</h4>
                                            <p class="desc">{{ $sub_content->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-shape-3">
                <img src="assets/images/shape/shape-blur.svg" alt="">
            </div>

        </section>
    @endif
    <!-- end: About Section -->

    <!-- start: Pricing Section -->
    <section class="h5-pricing section-gap">
        <div class="container gap-30-30">

            <div class="row  ">
                <div class="col-12">


                    <div class="tab-content  package__tab__content ">
                        <div class="tab-pane active show" id="monthlyPackageContent">
                            <div class="h5-pricing-box-wrapper">

                                <div class="row ">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="pricing-box h5-pricing-box h5-pricing-box-premium wow fadeInUp"
                                            data-wow-delay=".4s"
                                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">

                                            <h2 class="sec-title text-anim">
                                                <div style="position:relative;display:inline-block;">
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        P</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        l</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        a</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        n</div>
                                                </div>
                                                <div style="position:relative;display:inline-block;">
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        I</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        n</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        c</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        l</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        u</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        d</div>
                                                    <div
                                                        style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                        e</div>
                                                </div>
                                            </h2>
                                            <div class="list-items pharmacy d-flex gap-5">

                                                {{-- LEFT SIDE (second, fourth, sixth...) --}}
                                                <ul>
                                                    @foreach ($plans_content as $key => $item)

                                                            <li>
                                                                <i class="tji-list"></i>
                                                                {{ $item->basic_plan }}
                                                            </li>

                                                    @endforeach
                                                </ul>

                                                {{-- RIGHT SIDE (first, third, fifth...) --}}
                                                <ul>
                                                    @foreach ($plans_content as $key => $item)
                                                            <li>
                                                                <i class="tji-list"></i>
                                                                {{ $item->standard_plan }}
                                                            </li>
                                                    @endforeach
                                                </ul>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="pricing-box h5-pricing-box h5-pricing-box-premium wow fadeInUp"
                                            data-wow-delay=".5s"
                                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">

                                            <div class="list-items">
                                                <h2 class="sec-title text-anim">
                                                    <div style="position:relative;display:inline-block;">
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            P</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            l</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            a</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            n</div>
                                                    </div>
                                                    <div style="position:relative;display:inline-block;">
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            I</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            n</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            c</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            l</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            u</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            d</div>
                                                        <div
                                                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                            e</div>
                                                    </div>
                                                </h2>
                                                <div class="col-12">
                                                    @foreach($plans as $plan)
                                                    <div class="service-wrapper">
                                                        <div class="service-item style-3 wow fadeInUp" data-wow-delay=".3s"
                                                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                                            <div class="service-content-wrap pharmacy-service">
                                                                <div class="service-title">

                                                                    <h4 class="title"><a href="service-details.html">{{ $plan->title }}
                                                                          </a></h4>
                                                                    <p class="desc"><i class="tji-service-1"></i>
                                                                          {{ $plan->sub_title }} </p>
                                                                </div>
                                                                <div class="service-content">
                                                                    <div class="service-icon pharmacy-time">
                                                                        <p>
                                                                             {{ $plan->from_time }}  -  {{ $plan->to_time }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="bg-shape-1">
                                    <img src="assets/images/shape/pattern-2.svg" alt="">
                                </div>
                                <div class="bg-shape-2">
                                    <img src="assets/images/shape/pattern-3.svg" alt="">
                                </div>
                                <div class="bg-shape-3">
                                    <img src="assets/images/shape/shape-blur-2.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end: Pricing Section -->

    <!-- start: Project Section -->
    <section class="tj-project-section-3 section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;"><i
                                class="tji-box"></i>Proud Projects</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">
                                <h2 class="sec-title title-anim" style="">
                                    <div style="display: block; text-align: start; position: relative;">
                                        <div style="position:relative;display:inline-block;">
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                B</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                r</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                e</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                a</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                k</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                i</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                n</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                g</div>
                                        </div>
                                        <div style="position:relative;display:inline-block;">
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                B</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                o</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                u</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                n</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                d</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                a</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                r</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                i</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                e</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                s</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                ,</div>
                                        </div>
                                    </div>
                                    <div style="display: block; text-align: start; position: relative;">
                                        <div style="position:relative;display:inline-block;">
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                B</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                u</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                i</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                l</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                d</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                i</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                n</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                g</div>
                                        </div>
                                        <div style="position:relative;display:inline-block;">
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                D</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                r</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                e</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                a</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                m</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                s</div>
                                            <div
                                                style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; visibility: inherit; transform: translate(0px, 0%);">
                                                .</div>
                                        </div>
                                    </div>
                                </h2>
                            </div>
                            <div class="slider-navigation d-none d-md-inline-flex wow fadeInUp" data-wow-delay=".5s"
                                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <div class="slider-prev" tabindex="0" role="button" aria-label="Previous slide"
                                    aria-controls="swiper-wrapper-d77240a8f1c12811">
                                    <span class="anim-icon">
                                        <i class="tji-arrow-left"></i>
                                        <i class="tji-arrow-left"></i>
                                    </span>
                                </div>
                                <div class="slider-next" tabindex="0" role="button" aria-label="Next slide"
                                    aria-controls="swiper-wrapper-d77240a8f1c12811">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div
                            class="swiper project-slider-2 swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                            <div class="swiper-wrapper" id="swiper-wrapper-d77240a8f1c12811" aria-live="polite"
                                style="transform: translate3d(-1236px, 0px, 0px); transition-duration: 0ms;">
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next"
                                    data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                                    style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-7.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Rebranding
                                                            Strategy for a Growing</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2"
                                    role="group" aria-label="3 / 4" style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-8.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Interactive
                                                            Learning Platform</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-prev"
                                    data-swiper-slide-index="3" role="group" aria-label="4 / 4"
                                    style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-9.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Environmental
                                                            Impact Dashboard</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" role="group"
                                    aria-label="1 / 4" style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-6.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Event
                                                            Management Platform</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" role="group"
                                    aria-label="2 / 4" style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-7.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Rebranding
                                                            Strategy for a Growing</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-swiper-slide-index="2" role="group" aria-label="3 / 4"
                                    style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-8.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Interactive
                                                            Learning Platform</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="3"
                                    role="group" aria-label="4 / 4" style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-9.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Environmental
                                                            Impact Dashboard</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                                    data-swiper-slide-index="0" role="group" aria-label="1 / 4"
                                    style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-6.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Event
                                                            Management Platform</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next"
                                    data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                                    style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-7.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Rebranding
                                                            Strategy for a Growing</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2"
                                    role="group" aria-label="3 / 4" style="width: 392px; margin-right: 20px;">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-8.webp" alt="">

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title"><a href="portfolio-details-2.html">Interactive
                                                            Learning Platform</a></h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="swiper-pagination-area swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                    role="button" aria-label="Go to slide 1" aria-current="true"></span><span
                                    class="swiper-pagination-bullet" tabindex="0" role="button"
                                    aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet"
                                    tabindex="0" role="button" aria-label="Go to slide 3"></span><span
                                    class="swiper-pagination-bullet" tabindex="0" role="button"
                                    aria-label="Go to slide 4"></span>
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end: Project Section -->
@endsection
