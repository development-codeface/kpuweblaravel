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
@endsection
