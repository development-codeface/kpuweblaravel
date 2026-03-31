@extends('frondend.app')
@section('content')
    {{-- <div class="top-space-15"></div> --}}

    <section class="tj-page-header section-gap-x" data-bg-image="{{ asset($banner->image) }}">
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
                        <p class="desc">{{ $banner->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Careers Section -->
     <section class="tj-careers-section section-gap">
        <div class="container">
            <div class="row rg-30">
                @foreach ($career_content as $career)
                    <div class="col-xl-4 col-md-6">
                        <div class="tj-careers wow fadeInUp" data-wow-delay="0.1s">

                            <div class="tj-careers-icon mb-30">
                                <i class="{{ $career->icon }}"></i>
                            </div>

                            <div class="tj-careers-tag">
                                <span>
                                    {{ $career->job_type }} / {{ $career->work_mode }}
                                </span>

                                @if (!empty($career->is_urgent))
                                    <span>Urgent</span>
                                @endif
                            </div>

                            <h4 class="tj-careers-title">
                                <a href="#">
                                    {{ $career->title }}
                                </a>
                            </h4>

                            <div class="tj-careers-salary">
                                <span>
                                    ${{ $career->salary_min }} - ${{ $career->salary_max }}
                                </span> / {{ $career->salary_type }}
                            </div>

                            <div class="tj-careers-bottom">
                                <span class="location">
                                    <i class="tji-location"></i>
                                    {{ $career->location }}
                                </span>

                                <a href="#" class="tj-careers-btn">
                                    <div class="btn-text">
                                        <span>Apply Now</span>
                                    </div>
                                    <span class="btn-icon">
                                        <i class="tji-arrow-right"></i>
                                        <i class="tji-arrow-right"></i>
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            <!-- post pagination -->
            <div class="tj-pagination d-flex justify-content-center">
                {{ $career_content->links() }}
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
@endsection
