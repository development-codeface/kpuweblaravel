@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>
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
                        <h1 class="banner-title ">{{ $banner->title }}</h1>

                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Blog Section -->
    <section class="tj-blog-section h7-blog  section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-2 style-7 text-center">

                        <h2 class="sec-title text-anim">{{ $blogs_data->title }}</h2>
                        <p class="desc">{{ $blogs_data->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4 h7-blog-wrapper">
                @foreach ($blogs_data->directorBlog as $blog)
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                            <div class="blog-thumb">
                                <a href="blog-details.html"><img src="{{ asset($blog->image) }}" alt=""></a>
                                <div class="blog-meta">
                                    <span class="categories">
                                        <h3>{{ $blog->heading }}</h3>
                                        <a>{{ $blog->designation }}</a>
                                    </span></span>
                                </div>
                            </div>
                            <div class="blog-content">

                                <div class="title-wrapper">
                                    <h4 class="title"><a href="blog-details.html">{{ $blog->text }}</a>
                                    </h4>
                                </div>
                                <a class="text-btn" href="service-details.html">
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->

    <!-- start: Pricing Section -->
    <section class="h5-pricing section-gap">
        <div class="container gap-30-30">

            <div class="row  ">
                <div class="col-12">


                    <div class="tab-content  package__tab__content ">
                        <div class="tab-pane active show" id="monthlyPackageContent">
                            <div class="h5-pricing-box-wrapper">
                                <div class="sec-heading style-3">
                                    <h2 class="sec-title text-anim">Our Pricing Plan.</h2>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="pricing-box h5-pricing-box h5-pricing-box-premium wow fadeInUp"
                                            data-wow-delay=".4s">

                                            <div class="list-items">
                                                <h6 class="h5-pricing-list-title">Plan Include</h6>
                                                <ul>
                                                    @foreach ($contents as $item)
                                                        @if (!empty($item->basic_plan))
                                                            <li>
                                                                <i class="tji-list"></i>
                                                                {{ $item->basic_plan }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="pricing-box h5-pricing-box h5-pricing-box-premium wow fadeInUp"
                                            data-wow-delay=".5s">

                                            <div class="list-items">
                                                <h6 class="h5-pricing-list-title">Plan Include</h6>
                                                <ul>
                                                    @foreach ($contents as $item)
                                                        @if (!empty($item->standard_plan))
                                                            <li>
                                                                <i class="tji-list"></i>
                                                                {{ $item->standard_plan }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
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
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Proud
                            {{ $facility->title }}</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">
                                <h2 class="sec-title title-anim"> {{ $facility->sub_title }}</h2>
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
                                                <img src="{{ asset('images/facility/'.$value->image) }}" alt="">

                                                <div class="project-content">
                                                    <span class="categories"><a
                                                            href="portfolio-details-2.html">{{ $value->button_text }}</a></span>
                                                    <div class="project-text">
                                                        <h4 class="title"><a href="portfolio-details-2.html">{{ $value->heading }}</a></h4>
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
