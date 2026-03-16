@extends('frondend.app')
@section('content')

        <div class="top-space-15"></div>
        <!-- start: Banner Section -->
        <section class="h5-banner-section section-gap-x">
            <div class="banner-bg" data-bg-image="{{ asset($banner->image) }}">
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
                <button class="book-content ">
                    <i class="tji-arrow-right-long"></i>
                    <h4 class="title">Book Appointment</h4>
                </button>
                <button class="book-content">
                    <i class="tji-arrow-right-long"></i>
                    <h4 class="title">Book Appointment</h4>
                </button>
                <button class="book-content">
                    <i class="tji-arrow-right-long"></i>
                    <h4 class="title">Book Appointment</h4>
                </button>
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
                                    {{ $feature->title }}
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
                                        <div class="next-icon">
                                            <i class="tji-arrow-right-long"></i>
                                        </div>
                                        <div class="choose-icon">
                                            <i class="{{ $content->icon }}"></i>
                                        </div>
                                        <h4 class="title">{{  $content->name  }}</h4>
                                        <p class="desc">
                                           {{  $content->description  }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                        <a class="tj-primary-btn" href="contact.html">
                            <span class="btn-text"><span>Get Started Now</span></span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- end: Choose Section -->

        <!-- start: About Section -->
        <section class="tj-about-section h7-about section-gap section-gap-x mt-10">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="h7-about-banner wow fadeInUp" data-wow-delay=".2s">
                            <div class="sec-heading style-3 text-left">
                                <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                                    <a class="tj-primary-btn tag-port">
                                        <span class="btn-text">#Healthy Families First</span>
                                    </a>
                                </div>
                                <h2 class="sec-title">
                                    Find quality care nearby and access it when you
                                    <span class="blue-clr"> need</span> it
                                </h2>
                                <p class="desc">
                                    We stay ahead of the leveraging cutting-edge
                                    technologies and strategies to keep.
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
                                        <img src="{{ asset('images/doctor.jpg') }}" alt="">
                                        <h4 class="count-text">Find quality care nearby and access it when you</h4>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="customers-box style-2 wow fadeInUp" data-wow-delay=".5s">
                                        {{-- <div class="customers-bg" data-bg-image="assets/images/about/h7-about-item-bg.webp"></div> --}}

                                        <h6 class="customers-text wow fadeInLeft" data-wow-delay=".6s">
                                            Enabling startups to raise $25M+ in venture funding.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-div">
                                <div class="col-12 col-md-6">
                                    <div class="customers-box style-2 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="customers-bg" data-bg-image="assets/images/about/h7-about-item-bg.webp">
                                        </div>

                                        <h6 class="customers-text wow fadeInLeft" data-wow-delay=".6s">
                                            Enabling startups to raise $25M+ in venture funding.
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".6s"></div>
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
                                Empowering Business with Expertise.
                            </h2>
                            <p class="desc">
                                We stay ahead of the leveraging cutting-edge technologies
                                and strategies to keep.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row leftSwipeWrap">
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item style-6">
                            <div class="service-image">
                                <img src="./assets/images/team/team-1.webp" alt="" />
                            </div>
                            <div class="service-content">
                                <a class="text-btn" href="service-details.html">
                                    <span class="btn-text"><span>Learn More</span></span>
                                </a>
                                <div class="team-content desc">
                                    <h4 class="title">
                                        <a href="team-details.html">Kristin Watson</a>
                                    </h4>
                                    <span class="designation">Marketing Lead</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item style-6">
                            <div class="service-image">
                                <img src="./assets/images/team/h7-team-2.webp" alt="" />
                            </div>
                            <div class="service-content">
                                <a class="text-btn" href="service-details.html">
                                    <span class="btn-text"><span>Learn More</span></span>
                                </a>
                                <div class="team-content desc">
                                    <h4 class="title">
                                        <a href="team-details.html">Kristin Watson</a>
                                    </h4>
                                    <span class="designation">Marketing Lead</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item style-6">
                            <div class="service-image">
                                <img src="./assets/images/team/h7-team-2.webp" alt="" />
                            </div>
                            <div class="service-content">
                                <div class="team-content desc">
                                    <h4 class="title">
                                        <a href="team-details.html">Kristin Watson</a>
                                    </h4>
                                    <span class="designation">Marketing Lead</span>
                                </div>
                                <a class="text-btn" href="service-details.html">
                                    <span class="btn-text"><span>Learn More</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item style-6">
                            <div class="service-image">
                                <img src="./assets/images/team/h7-team-2.webp" alt="" />
                            </div>
                            <div class="service-content">
                                <div class="team-content desc">
                                    <h4 class="title">
                                        <a href="team-details.html">Kristin Watson</a>
                                    </h4>
                                    <span class="designation">Marketing Lead</span>
                                </div>
                                <a class="text-btn" href="service-details.html">
                                    <span class="btn-text"><span>Learn More</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
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
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <!-- <div class="h5-testimonial-author-wrapper"> -->
                                            <img src="./assets/images/award/download (4).jpg" alt="" />
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <img src="./assets/images/award/download (5).jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <!-- <div class="h5-testimonial-author-wrapper"> -->
                                            <img src="./assets/images/award/download (4).jpg" alt="" />
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <!-- <div class="h5-testimonial-author-wrapper"> -->
                                            <img src="./assets/images/award/download (4).jpg" alt="" />
                                            <!-- </div> -->
                                        </div>
                                    </div>
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
                    <div class="col-lg-6">
                        <div class="blog-item style-2">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="assets/images/blog/blog-4.webp"
                                        alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <div class="sec-heading style-3 text-left">
                                    <h2 class="sec-title ">
                                        second-Opinion
                                    </h2>
                                    <p class="desc">
                                        We stay ahead of the leveraging cutting-edge
                                        technologies and strategies to keep.
                                    </p>
                                </div>
                                <a class="text-btn" href="blog-details.html">
                                    <span class="btn-text"><span>Read More</span></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 service-side-12">
                        <div class="col-12">
                            <div class="sec-heading style-3 text-left">
                                <h2 class="sec-title ">
                                    Empowering Business with Expertise.
                                </h2>
                                <p class="desc">
                                    We stay ahead of the leveraging cutting-edge
                                    technologies and strategies to keep.
                                </p>
                            </div>
                        </div>
                        <div class="swiper swiper-container h5-testimonial-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="h5-testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <div class="author-inner">
                                                    <div class="author-header">
                                                        <h4 class="title">Guy Hawkins</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desc">
                                            <p>
                                                “Working with Bexon has been a game-changer for
                                                our business. Their team's professionalism,
                                                attention to detail, and innovative solutions have
                                                helped us streamline operations our goals faster
                                                than imagined. We truly feel like a valued
                                                partner.”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="h5-testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <div class="author-inner">
                                                    <div class="author-header">
                                                        <h4 class="title">Ralph Edwards</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desc">
                                            <p>
                                                “Working with Bexon has been a game-changer for
                                                our business. Their team's professionalism,
                                                attention to detail, and innovative solutions have
                                                helped us streamline operations our goals faster
                                                than imagined. We truly feel like a valued
                                                partner.”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="h5-testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <div class="author-inner">
                                                    <div class="author-header">
                                                        <h4 class="title">Devon Lane</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desc">
                                            <p>
                                                “Working with Bexon has been a game-changer for
                                                our business. Their team's professionalism,
                                                attention to detail, and innovative solutions have
                                                helped us streamline operations our goals faster
                                                than imagined. We truly feel like a valued
                                                partner.”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="h5-testimonial-author-wrapper">
                                            <div class="testimonial-author">
                                                <div class="author-inner">
                                                    <div class="author-header">
                                                        <h4 class="title">Guy Hawkins</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desc">
                                            <p>
                                                “Working with Bexon has been a game-changer for
                                                our business. Their team's professionalism,
                                                attention to detail, and innovative solutions have
                                                helped us streamline operations our goals faster
                                                than imagined. We truly feel like a valued
                                                partner.”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
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
                            <h2 class="sec-title "><span>Blogs</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row row-gap-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="assets/images/blog/blog-1.webp"
                                        alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="categories"><a href="blog-details.html">Business</a></span>
                                </div>
                                <h4 class="title">
                                    <a href="blog-details.html">Innovative Solutions for every Business Success.</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="assets/images/blog/blog-1.webp"
                                        alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="categories"><a href="blog-details.html">Business</a></span>
                                </div>
                                <h4 class="title">
                                    <a href="blog-details.html">Innovative Solutions for every Business Success.</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="assets/images/blog/blog-2.webp"
                                        alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="categories"><a href="blog-details.html">Business</a></span>
                                </div>
                                <h4 class="title">
                                    <a href="blog-details.html">Harnessing Digital Transform a Roadmap Businesses.</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="assets/images/blog/blog-3.webp"
                                        alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="categories"><a href="blog-details.html">Business</a></span>
                                </div>
                                <h4 class="title">
                                    <a href="blog-details.html">Mastering Change Management Lessons for
                                        Businesses.</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-area scroled-ab wow fadeInUp" data-wow-delay=".8s">
                    <a class="tj-primary-btn" href="contact.html">
                        <span class="btn-text"><span>Get Started Now</span></span>
                    </a>
                </div>
            </div>
        </section>
        <!-- end: Blog Section -->

        <!-- start: Cta Section -->

        <!-- end: Cta Section -->
    </main>
@endsection
