@extends('frondend.app')
@section('content')
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <div class="top-space-15"></div>


    <section class="tj-page-header section-gap-x spacialiy-banner">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content speciality">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $banner->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title ">{{ $banner->title }}</h1>
                        <p class="desc">{{ $banner->description }}
                        </p>
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text"><i class="tji-arrow-right-long"></i> {{ $banner->text }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="h5-banner-content speciality-btn">
                        <div class="slider-btn">
                            <a class="tj-primary-btn" href="contact.html">
                                <span class="btn-text"><span>Book Appointment</span></span>
                            </a>
                            <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                        </div>
                        <div class="slider-btn">
                            <a class="tj-primary-btn" href="contact.html">
                                <span class="btn-text"><span>Get Second Opinion</span></span>
                            </a>
                            <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                        </div>

                    </div>


                </div>
            </div>

        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>
    <section class="tj-page-header section-gap-x mt-0" data-bg-image="{{ asset($banner->image) }}">
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
            <div class="booking-container banner-menu">
                <div class="banner-menu-conta">
                    <a href="#who-we-are">Who we are</a>
                    <a href="#our-values">Our Values</a>
                    <a href="#our-guiding-mission">Our Guiding Mission</a>
                    <a href="#mile-stone">Mile stones</a>
                    <a href="#strategic-pillars">Strategic Pillars</a>
                </div>
            </div>
        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Product Section -->
    <section class="tj-product-area section-gap" id="who-we-are">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="sec-heading style-3 text-left">
                        <h2 class="sec-title title-anim">Empowering Business with Expertise.</h2>
                        <p class="desc">We stay ahead of the leveraging cutting-edge technologies and strategies to keep.
                            We stay ahead of the leveraging cutting-edge technologies and strategies to keep.
                        </p>
                    </div>

                    <div class="tj-product-details-bottom ">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tj-product-details-tab-nav tj-tab">
                                    <nav>
                                        <div class="nav nav-tabs p-relative tj-product-tab" id="navPresentationTab"
                                            role="tablist">
                                            <button class="nav-link description_tab active" id="nav-desc-tab-description"
                                                data-bs-toggle="tab" data-bs-target="#nav-desc-description" type="button"
                                                role="tab" aria-controls="nav-desc-description"
                                                aria-selected="true">Description
                                            </button>
                                            <button class="nav-link additional_information_tab"
                                                id="nav-desc-tab-additional_information" data-bs-toggle="tab"
                                                data-bs-target="#nav-desc-additional_information" type="button"
                                                role="tab" aria-controls="nav-desc-additional_information"
                                                aria-selected="false" tabindex="-1">Additional information </button>
                                            <button class="nav-link reviews_tab" id="nav-desc-tab-reviews"
                                                data-bs-toggle="tab" data-bs-target="#nav-desc-reviews" type="button"
                                                role="tab" aria-controls="nav-desc-reviews" aria-selected="false"
                                                tabindex="-1">Reviews (01)
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="navPresentationTabContent">
                                        <div class="tab-pane fade active show" id="nav-desc-description" role="tabpanel"
                                            aria-labelledby="nav-desc-tab-description">
                                            <div class="tj-product-details-description mt-30">
                                                <p>Experience true wireless freedom with our latest earbuds, designed to
                                                    deliver
                                                    crystal-clear sound and deep bass in a compact, lightweight package.
                                                    Perfectly
                                                    crafted for everyday use, these earbuds feature advanced Bluetooth
                                                    connectivity for seamless pairing and stable audio streaming. Whether
                                                    you’re
                                                    hitting the gym, commuting, or relaxing at home, enjoy up to 8 hours of
                                                    uninterrupted playtime with a portable charging case that keeps you
                                                    powered on
                                                    the go.</p>
                                                <p>With ergonomic ear tips and sweat-resistant materials, they provide a
                                                    secure
                                                    and comfortable fit for any activity. Plus, intuitive touch controls let
                                                    you
                                                    manage music, calls, and voice assistants effortlessly. Elevate your
                                                    audio
                                                    experience with earbuds that combine style, performance, and convenience
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-desc-additional_information" role="tabpanel"
                                            aria-labelledby="nav-desc-tab-additional_information">
                                            <div class="tj-product-details-description mt-30">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                Weight</th>
                                                            <td>55 kg</td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Dimensions</th>
                                                            <td>55 × 55 × 55 cm
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-desc-reviews" role="tabpanel"
                                            aria-labelledby="nav-desc-tab-reviews">
                                            <div class="tj-product-details-description mt-30">
                                                <div class="reviews-area">
                                                    <div class="comments-area">
                                                        <h3 class="d-none mb-30">
                                                            1 review for “<span>Personal holding earbud</span>” </h3>

                                                        <ol class="commentlist">
                                                            <li class="review">
                                                                <div class="comment_container">

                                                                    <div class="comment-text">


                                                                        <div class="description">
                                                                            <p>“I’ve been using these earbuds daily for a
                                                                                few
                                                                                weeks, and
                                                                                they’ve truly exceeded my expectations. The
                                                                                sound
                                                                                quality
                                                                                is crisp, with deep bass and clear highs —
                                                                                perfect
                                                                                for
                                                                                music, calls, or podcasts. The Bluetooth
                                                                                connection
                                                                                is
                                                                                stable, and pairing was super easy.”</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li><!-- #comment-## -->
                                                        </ol>


                                                    </div>


                                                    <div class="clear"></div>
                                                </div>
                                            </div>
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
    <!-- end: Product Section -->

    <!-- start: Choose Section -->
    <section id="our-values" class="tj-choose-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-3 text-left">
                        <h2 class="sec-title title-anim">{{ $feature->title }}</h2>
                        <p class="desc">{{ $feature->sub_title }}
                        </p>

                    </div>
                </div>
            </div>
            <div class="row row-gap-4 rightSwipeWrap">
                @foreach ($feature->featureContents as $content)
                    <div class="col-lg-4">
                        <div class="choose-box right-swipe">
                            <div class="choose-content">
                                <div class="choose-icon">
                                    <i class="{{ $content->icon }}"></i>
                                </div>
                                <h4 class="title">{{ $content->name }}</h4>
                                <p class="desc">{{ $content->description }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end: Choose Section -->

    <!-- start: Team Section -->
    <section class="tj-team-section-3 section-gap section-gap-x" id="our-guiding-mission">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i> Meet Our
                            Team</span>
                        <h2 class="sec-title ">Success <span>Stories</span> Fuel our Innovation.</h2>
                    </div>
                </div>
            </div>
            <div class="row leftSwipeWrap selact-dr-card">
                @foreach ($doctors as $value)
                    <div class="col-lg-3 col-sm-6 doctor-card">
                        <div class="team-item left-swipe">
                            <div class="team-img">
                                <div class="team-img-inner">
                                    <img src="{{ $value->image }}" alt="">
                                </div>

                            </div>
                            <div class="team-content">
                                <h4 class="title"><a href="team-details.html">{{ $value->name }}</a></h4>
                                <span class="designation">{{ $value->designation }}</span>
                                <div class="h5-banner-content speciality-btn team-section">
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>Get Started</span></span>
                                        </a>

                                    </div>
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>Get Started</span></span>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- end: Team Section -->


    <!-- start: Faq Section -->
    <section class="tj-faq-section section-gap tj-arrange-container-2" id="mile-stone">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="col-12">
                        <div class="sec-heading text-left">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Choose the Best</span>
                            <h4 class="title">{{ $contents->title ?? '' }}</h4>
                            <p class="desc">{{ $contents->sub_title ?? '' }}</p>
                        </div>
                    </div>
                    <div class="faq-img-area tj-arrange-item-2">
                        <div class="faq-img overflow-hidden">
                            <img src="{{ asset($contents->image) }}" alt="">

                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion tj-faq tj-arrange-item-2" id="faqOne">

                        @foreach ($contents->subContents as $key => $item)
                            <div class="accordion-item {{ $key == 0 ? 'active' : '' }}">

                                <button class="faq-title" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-{{ $key }}"
                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

                                    {{ $item->heading }}
                                </button>

                                <div id="faq-{{ $key }}" class="collapse {{ $key == 0 ? 'show' : '' }}"
                                    data-bs-parent="#faqOne">

                                    <div class="accordion-body faq-text">
                                        <p>{{ $item->description }}</p>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Faq Section -->

    <!-- start: Service Section -->
    <section class="h5-service-section h10-service section-gap" id="strategic-pillars">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap style-8">
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">

                                <h2 class="sec-title text-anim"> Healthy Blogs</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="service-wrapper h10-service-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="swiper h10-service-slider">
                            <div class="swiper-wrapper">

                                @foreach ($blog as $key => $item)
                                    <div class="swiper-slide">
                                        <div class="service-item style-4 wow fadeInUp" data-wow-delay=".1s">

                                            <!-- Number -->
                                            <h6 class="h10-service-sln">
                                                {{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}.
                                            </h6>

                                            <!-- Icon -->
                                            <div class="service-icon">
                                                <i class="{{ $item->icon }}"></i>
                                            </div>

                                            <!-- Content -->
                                            <div class="service-content">
                                                <h4 class="title">
                                                    <a href="#">
                                                        {{ $item->title }}
                                                    </a>
                                                </h4>

                                                <p class="desc">
                                                    {{ $item->description }}
                                                </p>

                                                <a class="text-btn" href="#">
                                                    <span class="btn-text">
                                                        <span>Learn More</span>
                                                    </span>
                                                    <span class="btn-icon">
                                                        <i class="tji-arrow-right-long"></i>
                                                    </span>
                                                </a>
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
    <!-- end: Service Section -->

    <!-- start: Client Section -->
    <section class="tj-client-section client-section-gap wow fadeInUp" data-wow-delay=".4s">
        <div class="container-fluid client-container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center">

                        <h2 class="sec-title title-anim">Other spacialities</span></h2>
                    </div>
                    <div class="swiper client-slider client-slider-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-1.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-2.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-3.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-4.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-5.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide client-item">
                                <div class="client-logo">
                                    <img src="assets/images/brands/brand-6.webp" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.banner-menu-conta a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute('href'));

                if (target) {
                    const elementPosition = target.offsetTop;
                    const elementHeight = target.offsetHeight;
                    const windowHeight = window.innerHeight;

                    const offsetPosition = elementPosition - (windowHeight / 2) + (elementHeight / 2);

                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        });
    </script>
@endsection
