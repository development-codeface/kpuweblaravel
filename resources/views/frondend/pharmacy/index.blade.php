@extends('frondend.app')
@section('content')

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

                                            <h2 class="sec-title  pharmacy">
                                               Why choose Our Pharmacy
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
                                                <h2 class="sec-title pharmacy">Pharmacy Locations</h2>
                                                <div class="col-12">
                                                    @foreach ($plans as $plan)
                                                        <div class="service-wrapper">
                                                            <div class="service-item style-3 wow fadeInUp"
                                                                data-wow-delay=".3s"
                                                                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                                                <div class="service-content-wrap pharmacy-service">
                                                                    <div class="service-title">

                                                                        <h4 class="title"><a
                                                                                href="service-details.html">{{ $plan->title }}
                                                                            </a></h4>
                                                                        <p class="desc"><i class="tji-service-1"></i>
                                                                            {{ $plan->sub_title }} </p>
                                                                    </div>
                                                                    <div class="service-content">
                                                                        <div class="service-icon pharmacy-time">
                                                                            <p>
                                                                                {{ $plan->from_time }} -
                                                                                {{ $plan->to_time }}
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
                                class="tji-box"></i>{{ $facility->title }}</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">
                                <h2 class="sec-title title-anim">
                                    <span>{{ explode(',', $facility->sub_title)[0] ?? '' }}</span><br>
                                    <span>{{ explode(',', $facility->sub_title)[1] ?? '' }}</span>
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="swiper project-slider-2">
                            <div class="swiper-wrapper">
                                @foreach ($facility->content as $value)
                                    <div class="swiper-slide">
                                        <div class="project-item">
                                            <div class="project-img">
                                                <img src="{{ asset('images/facility/' . $value->image) }}" alt="">

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
    <!-- end: Project Section -->
@endsection
