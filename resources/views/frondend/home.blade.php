@extends('frondend.app')
@section('content')
    {{-- <div class="top-space-15"></div> --}}
    <!-- start: Banner Section -->
    <section class="h5-banner-section section-gap-x" data-bg-image="{{ asset($banner->image) }}">
        <div class="container">
            <div class="banner-bg">
            </div>
            <div class="h5-banner-area">
                <div class="h5-banner-content">
                    <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                        <a class="tj-primary-btn tag-port">
                            <span class="btn-text">#Healthy Families First</span>
                        </a>
                    </div>
                    <h1 class="banner-title">
                        {{ $banner->title }}
                    </h1>
                </div>
            </div>

            <div class="booking-container">
                <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                    <a class="tj-primary-btn" href="">
                        <span class="btn-text"><span>Book Appointment</span></span>
                    </a>
                </div>
                <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                    <a class="tj-primary-btn" href="">
                        <span class="btn-text"><span>Find Speciality</span></span>
                    </a>
                </div>
                <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                    <a class="tj-primary-btn" href="">
                        <span class="btn-text"><span>Book Health Checkup</span></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Banner Section -->

    <!-- start: Choose Section -->
    <section id="choose" class="tj-choose-section section-gap">
        <div class="container">
            @foreach ($features as $feature)
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading style-3 text-left">
                            <h2 class="sec-title ">
                                Empowering Business with <span> Expertise.</span>
                            </h2>
                            <p class="desc">
                                {{ $feature->sub_title }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row row-gap-4 rightSwipeWrap">
                    @foreach ($feature->featureContents as $content)
                        <div class="col-xl-3 col-md-6">
                            <div class="choose-box style-2 right-swipe">
                                <div class="choose-content">
                                    {{-- <div class="next-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </div> --}}
                                    <div class="choose-icon index-page">
                                        <img src="{{ !empty($content->icon) ? asset($content->icon) : asset('images/kidney-icon.png') }}"
                                            alt="Feature icon">
                                    </div>
                                    <div class="description">

                                        <h4 class="title">{{ $content->name }}</h4>
                                        <p class="desc">
                                            {{ $content->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                    <a class="tj-primary-btn" href="">
                        <span class="btn-text"><span>Get Started Now</span></span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <!-- end: Choose Section -->

    <!-- start: About Section -->
    @php
        $contentCards = $edit_content?->subContent ?? collect();
        $contentCard = $contentCards->first();
        $homeContentImage1 = $contentCard?->image ?? 'images/doctor.jpg';
        $homeContentImage2 =
            $contentCard?->image_2 ?? (optional($contentCards->get(1))->image ?? 'images/doctors/doctor.jpg');
        $homeContentImage3 =
            $contentCard?->image_3 ?? (optional($contentCards->get(2))->image ?? 'images/doctors/doctor-2.jpg');
        $homeContentOverlay = $contentCard?->title ?? 'Find quality care nearby and access it when you';
    @endphp
    <section class="tj-about-section h7-about section-gap section-gap-x mt-10">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="h7-about-banner wow fadeInUp" data-wow-delay=".2s">
                        <div class="sec-heading style-3 text-left">
                            <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                                <a class="tj-primary-btn tag-port">
                                    <span class="btn-text">#{{ $edit_content->button_text }}</span>
                                </a>
                            </div>
                            <h2 class="sec-title">
                                {{ $edit_content->heading }}
                                <span class="blue-clr">{{ $edit_content->highlight_word }}</span>
                                it
                            </h2>
                            <p class="desc">
                                {{ $edit_content->sub_heading }}
                            </p>
                            <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                                <a class="tj-primary-btn" href="contact.html">
                                    <span class="btn-text"><span>About KPU Hospital</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="row h7-about-counter-wrapper 2-sectio-grid">
                        <div class="grid-div">
                            <div class="col-12 col-md-6">
                                <div class="countup-item img-sec style-2 wow fadeInUp" data-wow-delay=".3s">
                                    <img src="{{ asset($homeContentImage1) }}" alt="">
                                    <h4 class="count-text">{{ $homeContentOverlay }}</h4>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="customers-box style-2 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="inline-content">
                                        <span class="odometer countup-number" data-count="{{ $display_count }}">
                                            {{ $display_count }}
                                        </span>
                                        <span class="count-plus">+</span>
                                    </div>
                                    <h6 class="customers-text wow fadeInLeft" data-wow-delay=".6s">
                                        Doctors <br> Find your Doctor
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="grid-div">
                            <div class="col-12 col-md-6">
                                <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".6s">
                                    <img src="{{ asset($homeContentImage2) }}" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="customers-box bg-img style-2 wow fadeInUp" data-wow-delay=".5s">
                                    <img src="{{ asset($homeContentImage3) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: About Section -->

    <!-- start: Team Section -->
    <section class="tj-team-section section-separator">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-3 text-left">
                        <h2 class="sec-title title-anim">
                            Empowering Business with <span> Expertise.</span>
                        </h2>
                        <p class="desc">
                            We stay ahead of the leveraging cutting-edge technologies
                            and strategies to keep.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row leftSwipeWrap">
                @foreach ($dcotor_data as $data)
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item style-6">
                            <div class="service-image">
                                <img src="{{ $data->image }}" alt="" />
                            </div>
                            <div class="service-content">

                                <div class="team-content desc">
                                    <h4 class="title">
                                        <a href="team-details.html">{{ $data->name }}</a>
                                    </h4>
                                    <span class="designation">{{ $data->designation }}</span>
                                    <span class="degree">MD,DA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end: Team Section -->

    <!-- start: Testimonial Section -->
    <section class="h5-testimonial section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-wrapper h5-testimonial-wrapper wow fadeInUp" data-wow-delay=".5s">
                        <div class="swiper swiper-container h5-testimonial-slider">

                            <div class="swiper-wrapper">

                                @foreach ($slider as $item)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <img src="{{ asset($item->image) }}" alt="slider-image" />
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
    <!-- end: Testimonial Section -->

    <!-- start: Testimonial Section -->
    <section class="tj-testimonial-section-2 section-gap">
        <div class="container">
            <div class="row row-gap-3">
                <div class="col-lg-6 test-vers">
                    <div class="blog-item style-2">
                        <div class="blog-thumb">
                            <a href=""><img src="{{ asset($edit_section->image) }}" alt="" /></a>
                        </div>
                        <div class="blog-content">
                            <div class="sec-heading style-3 text-left">
                                <h2 class="sec-title ">
                                    {{ $edit_section->heading }}
                                </h2>
                                <p class="desc">
                                    {{ $edit_section->sub_heading }}
                                </p>
                            </div>
                            <a class="text-btn" href="">
                                <span class="btn-text"><span>Read More</span></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 service-side-12">
                    <div class="col-12">
                        <div class="sec-heading style-3 text-left">
                            <h2 class="sec-title ">
                                {{ $edit_section->title }}
                            </h2>
                            <p class="desc">
                                {{ $edit_section->sub_title }}
                            </p>
                        </div>
                    </div>
                    @php
                        $sectionSlides = collect($edit_section?->subContent)
                            ->filter(function ($sub) {
                                return !empty($sub->image);
                            })
                            ->values();
                    @endphp

                    {{-- @if ($sectionSlides->count() > 1) --}}
                    <div class="swiper swiper-container h5-testimonial-slider">
                        <div class="swiper-wrapper">

                            @foreach ($sectionSlides as $slide)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="h5-testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <div class="author-inner">
                                                    <div class="author-header">
                                                        <h4 class="title">
                                                            {{ $slide->name ?? 'No Name' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="desc">
                                            <p>
                                                {{ $slide->description ?? 'No Description' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="swiper-pagination-area"></div>
                    </div>
                    {{-- @elseif ($sectionSlides->count() === 1)
                        <div class="testimonial-item">
                            <div class="h5-testimonial-author-wrapper">
                                <img src="{{ asset($sectionSlides->first()->image) }}" alt="">
                            </div>
                        </div>
                    @endif --}}
                </div>
            </div>

            <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                <a class="tj-primary-btn" href="contact.html">
                    <span class="btn-text"><span>Get Started Now</span></span>
                </a>
            </div>
        </div>
    </section>
    <!-- end: Testimonial Section -->
    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading">
                        <h2 class="sec-title"><span>Blogs</span></h2>
                    </div>
                </div>
            </div>

            <div class="row row-gap-4">

                @foreach ($blog as $item)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">

                            <!-- Category -->
                            <div class="blog-meta">
                                <span class="categories">
                                    <i class="tji-box"></i>
                                    <a href="#">
                                        {{ $item->category->name ?? '' }}
                                    </a>
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="blog-thumb">
                                <a href="">
                                    <img src="{{ asset($item->image) }}" alt="blog-image" />
                                </a>
                            </div>

                            <!-- Title -->
                            <div class="blog-content">
                                <h4 class="title">
                                    <a href="">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Button -->
            <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                <a class="tj-primary-btn" href="">
                    <span class="btn-text"><span>Get Started Now</span></span>
                </a>
            </div>
        </div>
    </section>

    <!-- end: Blog Section -->
    </main>
@endsection
