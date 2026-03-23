@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>

    <section class="tj-page-header section-gap-x insurence-page" data-bg-image="{{ $banner->image }}">
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

    <!-- start: Choose Section -->
    <section id="choose" class="tj-choose-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        
                        <div class="heading-wrap-content">
                            <div class="sec-heading">
                                @php
                                    $words = explode(' ', $contents->sub_title);
                                    $lastWord = array_pop($words);
                                @endphp

                                <h2 class="sec-title insurence">
                                    {{ implode(' ', $words) }}
                                    {{ $lastWord }}
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4 rightSwipeWrap">
                @foreach ($contents->subContents as $content)
                    <div class="client-logo insurence-details">
                        <div class="choose-box right-swipe">
                            <div class="choose-content">
                                <div class="choose-image">
                                    <img src="../../../../assets/health-india-logo.png" alt="">
                                    {{-- <i class="{{ $content->icon }}"></i> --}}
                                </div>
                                <p class="desc">{{ $content->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
