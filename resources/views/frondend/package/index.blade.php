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
                        <h1 class="banner-title">{{ $banner->title }}</h1>
                        <p class="desc">
                            {{ $banner->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Project Section -->
    <section class="h10-project section-gap tj-sticky-panel-container health-packages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-3 sec-heading-centered">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Latest
                            {{ $content->title }}</span>
                        <h2 class="sec-title text-anim">
                            {{ $content->sub_title }}
                        </h2>
                        <div class="portfolio-filter h10-project-filter text-center wow fadeInUp" data-wow-delay=".5s">
                            <div class="button-group h10-project-button-group filter-button-group">
                                <button data-filter="*" class="active">All</button>
                                @foreach ($category as $cat)
                                    <button data-filter=".cat-{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                                <div class="active-bg"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row row-gap-4">
                    @foreach ($blog as $item)
                        <div class="col-xl-4 col-md-6 cat-{{ $item->category_id }}">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".4s">
                                <div class="blog-thumb">
                                    <a href="blog-details.html"><img src="{{ asset($item->image) }}" alt="" /></a>
                                </div>
                                <div class="blog-content">
                                    <h2 class="title">{{ $item->title }}</h2>
                                    <div class="blog-meta">
                                        <span>{{ $item->name }}</span>
                                        <span class="categories"><a
                                                href="blog-details.html">{{ $item->designation }}</a></span>
                                    </div>
                                    <h4 class="title">
                                        {{ $item->sub_title }}
                                    </h4>
                                    <div class="appointment-btn">
                                        <a class="text-btn" href="blog-details.html">
                                            <span class="btn-text"><span>Book Appointment</span></span>
                                        </a>
                                        <a class="text-btn" href="blog-details.html">
                                            <span class="btn-text"><span>View Profile</span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.filter-button-group button').click(function() {

            $('.filter-button-group button').removeClass('active');
            $(this).addClass('active');

            var filter = $(this).attr('data-filter');

            if (filter == '*') {
                $('.col-xl-4').show();
            } else {
                $('.col-xl-4').hide();
                $(filter).show();
            }
        });
    </script>

    <!-- end: Project Section -->
@endsection
