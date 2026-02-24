@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>
    <section class="tj-page-header section-gap-x hospital-icu" data-bg-image="{{ $banner->image }}">
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

        <div class="row">
            <div class="col-12">
                <div class="countup-wrap">
                    <div class="countup-item">
                        <div class="inline-content">
                            <span class="odometer countup-number" data-count="93"></span>
                            <!-- <span class="count-plus">%</span> -->
                        </div>
                        <span class="count-text">Projects Completed.</span>
                        <span class="count-separator" data-bg-image="assets/images/shape/separator.svg"></span>
                    </div>
                    <div class="countup-item">
                        <div class="inline-content">
                            <span class="odometer countup-number" data-count="20"></span>
                            <span class="count-plus">M</span>
                        </div>
                        <span class="count-text">Reach Worldwide</span>
                        <span class="count-separator" data-bg-image="assets/images/shape/separator.svg"></span>
                    </div>
                    <div class="countup-item">
                        <div class="inline-content">
                            <span class="odometer countup-number" data-count="8.5"></span>
                            <span class="count-plus">X</span>
                        </div>
                        <span class="count-text">Faster Growth</span>
                        <span class="count-separator" data-bg-image="assets/images/shape/separator.svg"></span>
                    </div>
                    <div class="countup-item">
                        <div class="inline-content">
                            <span class="odometer countup-number" data-count="100"></span>
                            <span class="count-plus">+</span>
                        </div>
                        <span class="count-text">Awards Archived</span>
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
                                <li>
                                    <a class="active" href="">Customer Experience<span class="icon"></span></a>
                                </li>
                                <li>
                                    <a href="service-details.html">Training Programs<span class="icon"></span></a>
                                </li>
                                <li>
                                    <a href="service-details.html">Business Strategy<span class="icon"></span></a>
                                </li>
                                <li>
                                    <a href="service-details.html">Training Program<span class="icon"></span></a>
                                </li>
                                <li>
                                    <a href="service-details.html">ESG Consulting<span class="icon"></span></a>
                                </li>
                                <li>
                                    <a href="service-details.html">Development Hub<span class="icon"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                            <img src="assets/images/service/service-details.webp" alt="Images" />
                        </div>
                        <h2 class="title title-anim">
                            Transforming Customer: Tailored Solutions for Experiences.
                        </h2>
                        <div class="blog-text">
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                Recognize that exceptional customer experiences are at
                                the heart of every successful business. Our Customer
                                Experience Solutions are crafted to help you transform
                                every interaction your customers have with your brand
                                into a meaningful and positive experience. We believe
                                that understanding the customer journey and providing
                                personalized, seamless experiences can significantly
                                enhance customer loyalty, satisfaction, and lifetime
                                value.Our approach to customer experience is
                                comprehensive and data-driven.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                Our approach to customer experience is comprehensive and
                                data-driven. We begin by assessing your current customer
                                touchpoints, identifying areas for improvement, and
                                using insights to develop strategies that meet your
                                customers’ evolving needs. From optimizing digital
                                platforms.
                            </p>
                            <ul class="wow fadeInUp" data-wow-delay=".3s">
                                <li>
                                    <span><i class="tji-check"></i></span>Personalization
                                    at Scale
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Improved
                                    Customer Retention
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Data-Driven
                                    Insights
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Omni-channel
                                    Integration
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Customer
                                    Retention
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Support
                                    Optimization
                                </li>
                                <li>
                                    <span><i class="tji-check"></i></span>Proactive
                                    Engagement
                                </li>
                            </ul>

                            <h3 class="wow fadeInUp" data-wow-delay=".3s">
                                Our Range of Customer Services
                            </h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                At Bexon, we don't just focus on solving customer
                                problems—we focus on creating experiences that delight
                                and build lasting relationships. Whether it's through
                                improving customer service operations, leveraging
                                technology, or designing more engaging digital
                                experiences, our team is here to help you exceed your
                                customers' expectations every time. We help you
                                understand your customers deeply, optimize their
                                experience.
                            </p>
                            <div class="details-content-box">
                                <div class="service-details-item wow fadeInUp" data-wow-delay=".2s">
                                    <span class="number">01.</span>
                                    <h6 class="title">
                                        Increased Customer <br />Satisfaction
                                    </h6>
                                    <div class="desc">
                                        <p>
                                            By prov consistent, personalized experience,
                                            customers are more likely to feel valued a
                                            satisfied, which directly.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-details-item wow fadeInUp" data-wow-delay=".4s">
                                    <div class="service-number">
                                        <span class="number">02.</span>
                                        <h6 class="title">
                                            Improved Operational <br />Efficiency
                                        </h6>
                                        <div class="desc">
                                            <p>
                                                With our tools and strategies, your customer
                                                support teams can handle inquiries faster, while
                                                automated systems.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-details-item wow fadeInUp" data-wow-delay=".6s">
                                    <div class="service-number">
                                        <span class="number">03.</span>
                                        <h6 class="title">
                                            Insights for Continuous Improvement
                                        </h6>
                                        <div class="desc">
                                            <p>
                                                Our data-driven approach provides team with
                                                valuable insights into customer behavior,
                                                enabling to continual.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->

    <!-- start: Choose Section -->
    <section id="choose" class="tj-choose-section h6-choose section-gap core-about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-2 style-6 text-center">
                        <h2 class="sec-title title-anim">
                            {{ $feature_data->title }}
                        </h2>
                        <p class="desc">
                            {{ $feature_data->sub_title }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4 rightSwipeWrap">
                @foreach ($feature_data->featureContents as $value)
                    <div class="col-xl-3 col-md-6">
                        <div class="choose-box h6-choose-box right-swipe">
                            <div class="choose-content">
                                <div class="choose-icon">
                                    <i class="{{ $value->icon }}"></i>
                                </div>
                                <h4 class="title">{{ $value->name }}</h4>
                                <p class="desc">
                                    {{ $value->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end: Choose Section -->

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
