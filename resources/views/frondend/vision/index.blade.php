@extends('frondend.app')
@section('content')
    

    <section class="tj-page-header section-gap-x" data-bg-image="{{ asset($edit_banner->image) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $edit_banner->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title">{{ $edit_banner->title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Faq Section -->
    <section class="tj-faq-section section-gap ">
        <div class="container">
            <div class="row justify-content-between">
                @foreach ($edit_section as $key => $value)
                    <div class="col-lg-6">
                        <div class="testimonial-item tj-arrange-item-2">
                            <div class="h6-testimonial-author-wrapper">
                                <div class="service-icon">
                                    <i class="{{ $value->icon }}"></i>
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-inner">
                                        <div class="author-header">
                                            <h4 class="title">{{ $value->heading }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desc">
                                <p>
                                    {{ $value->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end: Faq Section -->

    <!-- start: Service Section -->
    <section class="tj-service-section-5 section-gap">
        <div class="container">

            <!-- TITLE -->
            <div class="row">
                <div class="col-lg-12 visionery">
                    <div class="sec-heading style-4 text-center">
                        <span class="sub-title">
                            <i class="tji-box"></i>
                            {{ $edit_content->title ?? '' }}
                        </span>
                        <h2 class="sec-title">
                            {{ $edit_content->sub_title ?? '' }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- SERVICES -->
            <div class="row">
                <div class="col-12">
                    <div class="service-wrapper">

                        @foreach ($edit_content->subContent as $index => $item)
                            <div class="service-item style-5">

                                @if ($index % 2 == 0)
                                    <!-- LEFT CONTENT -->
                                    <div class="service-content-area">
                                        <h3 class="vision-title">Digital health</h3>

                                        <div class="service-content">
                                            <span class="no">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                                            </span>

                                            <p class="desc">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="service-img">
                                        <img src="{{ asset($item->image) }}" alt="">
                                    </div>
                                @else
                                    <!-- RIGHT CONTENT -->
                                    <div class="service-img">
                                        <img src="{{ asset($item->image) }}" alt="">
                                    </div>

                                    <div class="service-content-area">
                                        <h3 class="vision-title">Digital health</h3>

                                        <div class="service-content">
                                            <span class="no">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                                            </span>

                                            <p class="desc">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end: Service Section -->

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
                                                    <span class="categories">
                                                        <a href="#">{{ $value->button_text }}</a>
                                                    </span>
                                                    <div class="project-text">
                                                        <h4 class="title">
                                                            <a href="#">{{ $value->heading }}</a>
                                                        </h4>
                                                        <a class="project-btn" href="#">
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
