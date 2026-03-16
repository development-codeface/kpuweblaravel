@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>

    <section class="tj-page-header section-gap-x" data-bg-image="{{ asset('assets/images/hero/banner.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $banner->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title ">{{ $banner->title }}</h1>

                    </div>
                </div>
            </div>
        </div>
        <div class="booking-container banner-menu">
            <div class="banner-menu-conta">
                <a href="">Who we are</a>
                <a href="">Our Values</a>
                <a href="">Our Guiding Mission</a>
                <a href="">Mile stones</a>
                <a href="">Strategic Pillars</a>
            </div>
        </div>
        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Choose Section -->
    <section id="choose" class="tj-choose-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-8 sec-heading-centered">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">{{ $blog->heading }}</span>
                        <h2 class="sec-title title-anim">{{ $blog->title }}</h2>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4 rightSwipeWrap">
                <div class="col-lg-4">
                    <div class=" about-us h9-choose-box ">
                        <div class="choose-content">
                            <h4 class="titleBtn">{{ $blog->sub_heading }}</h4>
                            <h4 class="descAbout">{{ $blog->description }}</h4>
                            <a class="text-btn" href="contact.html">
                                <span class="btn-text"><span>Contact Us</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h5-strategy-item h5-strategy-item-3 wow fadeInUp" data-wow-delay=".5s">
                         <p class="desc">{{ $blog->icon_description }}</p>
<div class="locations">
<a class="text-btn" href="contact.html">
                                <span class="btn-text"><span>Contact Us</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="choose-box h9-choose-box right-swipe">
                        <div class="choose-content">
                            <div class="choose-icon">
                                <i class="{{ $blog->icon }}"></i>
                            </div>
                            <h4 class="title">{{ $blog->icon_heading }}</h4>
                            <p class="desc">{{ $blog->icon_description }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- end: Choose Section -->

    <!-- start: About Section -->
    <section class="tj-about-section-2 section-gap section-gap-x ">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 order-lg-1 order-2 who-about-imge">
                    <div class="about-img-area style-2 wow fadeInLeft" data-wow-delay=".3s">
                        <div class="about-img overflow-hidden">
                            <img src="{{ $content->logo_image }}" alt="">
                        </div>

                    </div>
                </div>



                <div class="col-xl-6 col-lg-6 order-lg-2 order-1 about-content">
                    <div class="about-content-area">
                        <div class="sec-heading style-3">

                            <h2 class="sec-title title-anim">{{ $content->heading }}</h2>
                        </div>
                    </div>


                    @if ($content)
                        @php
                            // Split by closing </p>
                            $paragraphs = explode('</p>', $content->content);

                            // Remove empty values
                            $paragraphs = array_filter($paragraphs);

                            // Re-add </p> because explode removes it
                            $paragraphs = array_map(function ($p) {
                                return $p . '</p>';
                            }, $paragraphs);

                            // Split into two halves
                            $half = ceil(count($paragraphs) / 2);
                            $left = array_slice($paragraphs, 0, $half);
                            $right = array_slice($paragraphs, $half);
                        @endphp

                        <div class="about-bottom-area">

                            <div class="mission-vision-box wow fadeInLeft" data-wow-delay=".5s">
                                {!! implode('', $left) !!}
                            </div>

                            <div class="mission-vision-box wow fadeInRight" data-wow-delay=".5s">
                                {!! implode('', $right) !!}
                            </div>

                        </div>
                    @endif




                </div>


            </div>
        </div>

    </section>
    <!-- end: About Section -->

    <!-- start: Choose Section -->
    @foreach ($about_feature as $feature)
        <section id="choose" class="tj-choose-section h6-choose section-gap core-about">
            <div class="container about-us-choose">

                {{-- Section Heading --}}
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading about-feature style-2 style-6 text-center">

                            <h2 class="sec-title title-anim">
                                {{ $feature->title }}
                            </h2>

                            <p class="desc">
                                {{ $feature->sub_title }}
                            </p>

                        </div>
                    </div>
                </div>

                {{-- Feature Boxes --}}
                <div class="row row-gap-4 rightSwipeWrap">

                    @foreach ($feature->featureContents as $content)
                        <div class="col-xl-3 col-md-6">
                            <div class="choose-box h6-choose-box right-swipe">
                                <div class="choose-content">

                                    <div class="choose-icon">
                                        <i class="{{ $content->icon }}"></i>
                                    </div>

                                    <h4 class="title">
                                        {{ $content->name }}
                                    </h4>

                                    <p class="desc">
                                        {{ $content->description }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>
    @endforeach

    <!-- end: Choose Section -->


    <!-- start: About Section -->
    @if ($sub_content)
        <section class="h10-about section-gap">
            <div class="container">
                <div class="row flex-column-reverse flex-md-row">

                    {{-- Left Side --}}
                    <div class="col-12 col-lg-5 d-block d-md-none d-lg-block">
                        <div class="about-img-area h10-about-banner wow bounceInLeft" data-wow-delay=".3s">
                            <div class="about-img overflow-hidden">
                                <h2 class="sec-title">
                                    {{ $sub_content->title }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    {{-- Right Side --}}
                    <div class="col-12 col-lg-7 core-about">
                        <div class="h10-about-content-wrapper">
                            <div class="sec-heading style-3">

                                <h2 class="sec-title wow fadeInUp" data-wow-delay=".3s">
                                    {{ $sub_content->sub_title }}
                                </h2>

                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="h10-about-content">

                                        <p class="desc wow fadeInUp" data-wow-delay=".4s">
                                            {{ $sub_content->description }}
                                        </p>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    <!-- end: About Section -->

    <!-- start: Service Section -->
    @if ($mid_content)
        <section class="h9-service section-gap section-gap-x tj-sticky-panel-container-2 tj-progress-wrapper">
            <div class="container">
                <div class="row">

                    {{-- LEFT SIDE TITLE (Single) --}}
                    <div class="col-12 col-lg-4">
                        <div class="sec-heading style-8 tj-sticky-panel-2">

                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                {{-- {{ $mid_content->sub_title ?? '' }} --}}
                            </span>

                            <h2 class="sec-title title-anim">
                                {{ $mid_content->title }}
                            </h2>

                        </div>
                    </div>

                    {{-- RIGHT SIDE CONTENT (Multiple Items) --}}
                    <div class="col-12 col-lg-8">

                        {{-- Scroll Numbers --}}
                        <div class="h9-service-scroll-progress about-us tj-scroll-progress tj-sticky-panel-2">

                            @foreach ($mid_content->aboutMidSubContent as $index => $item)
                                <div class="tj-scroll-progress-item {{ $index == 0 ? 'active' : '' }}">
                                    <h5 class="tj-scroll-progress-sln">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                                    </h5>
                                    <div class="tj-scroll-progress-ind">
                                        <div class="tj-scroll-progress-ind-inner"></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- Service Items --}}
                        <div class="service-wrapper h9-service-wrapper">

                            @foreach ($mid_content->aboutMidSubContent as $item)
                                <div class="service-item style-5 tj-progress-item">
                                    <div class="service-content-area">

                                        <div class="service-icon">
                                            <i class="{{ $item->icon }}"></i>
                                        </div>

                                        <div class="service-content">
                                            <h4 class="title">
                                                <a href="#">
                                                    {{ $item->title }}
                                                </a>
                                            </h4>

                                            <p class="desc">
                                                {{ $item->description }}
                                            </p>
                                        </div>

                                        <a href="#" class="h9-service-nav">
                                            <i class="tji-arrow-right-long"></i>
                                        </a>

                                    </div>

                                    <div class="service-img">
                                        <img src="{{ asset($item->image) }}" alt="">
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>
        </section>
    @endif

    <!-- end: Service Section -->

    <!-- start: Service Section -->
    <section class="tj-service-section service-3 section-gap stragetic-pillers">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading style-3 text-center">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">{{ $section->heading }}</span>
                        <h2 class="sec-title title-anim">{{ $section->title }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="service-wrapper">
                        <div class="service-item style-3 about-us wow fadeInUp" data-wow-delay=".3s">
                            @foreach ($section->subSection as $sectionData)
                                <div class="service-content-wrap">
                                    <div class="service-title">
                                        <div class="service-icon">
                                            <i class="{{ $sectionData->icon }}"></i>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h4 class="title"><a href="service-details.html">{{ $sectionData->title }}</a>
                                        </h4>
                                        <p class="desc">{{ $sectionData->description }}</p>
                                    </div>
                                </div>

                                <!-- <div class="service-reveal-bg" data-bg-image="assets/images/service/service-2.webp"></div> -->
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
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
                                <h2 class="sec-title title-anim">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="swiper project-slider-2">
                            <div class="swiper-wrapper">
                                @foreach ($facility->content as $value)
                                    <div class="swiper-slide">
                                        <div class="project-item">

                                            <div class="project-img">
                                                <img src="{{ asset('images/facility/' . $value->image) }}"
                                                    alt="">

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
@endsection
