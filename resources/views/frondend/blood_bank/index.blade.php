@extends('frondend.app')
@section('content')
    
    <section class="tj-page-header section-gap-x insurence-page" data-bg-image="{{ asset($blood_banks->image ?? 'images/blood-bank-banner.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $blood_banks->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title">{{ $blood_banks->title }}</h1>
                        <p class="desc">
                            {{ $blood_banks->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: About Section -->
    <section class="tj-about-section h6-about section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content-area h6-about-content style-1 wow fadeInLeft" data-wow-delay=".2s">
                        <div class="sec-heading style-2 style-6">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>
                                {{ $blood_contents->title }}</span>

                            <p class="desc wow fadeInUp" data-wow-delay=".8s">
                                {{ $blood_contents->description }}
                            </p>
                        </div>

                        <div class="details-content-box">
                            @foreach ($blood_contents->sub_content as $content)
                                <div class="service-details-item wow fadeInUp" data-wow-delay=".2s">

                                    <h6 class="title">
                                        {{ $content->heading }}
                                    </h6>

                                    <div class="desc">
                                        <p>{{ $content->text }}</p>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="col-12">
                        <div class="swiper client-slider client-slider-2 h6-client-slider">
                            <h2 class="sec-title">Blood Availability</h2>
                            <div class="blood-groups">
                                @foreach($blood_groups as $group)
                                    <div class="client-logo">
                                        <h1 class="banner-title">{{ $group->blood_group }}</h1>
                                        <p>{{ $group->status == 1 ? 'Available' : 'Not Available' }}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="h6-about-funfact-wrapper">
                        <div class="h6-about-funfact">
                            <div class="countup-item donate-blo">
                                <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>OUR
                                    COMPANY</span>
                                <span class="count-text">Reach Worldwide empower dreams everywhere.</span>

                                <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                                    <a class="tj-primary-btn" href="contact.html">
                                        <span class="btn-text"><span>Know More Us</span></span>
                                        <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($facility->content->isNotEmpty())
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
    @endif
    
@endsection
