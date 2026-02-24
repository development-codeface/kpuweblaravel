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

        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>

    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        <h2 class="title title-anim">
                            {{ $contents->title }}
                        </h2>
                        <div class="blog-text">
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                {!! $contents->description ?? '' !!}
                            </p>

                            <h3 class="wow fadeInUp" data-wow-delay=".3s">
                                {{ $contents->sub_title }}
                            </h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                {!! $contents->sub_description ?? '' !!}
                            </p>
                            <div class="details-content-box">
                                @foreach ($contents->sub_content as $sub_content)
                                    <div class="service-details-item wow fadeInUp" data-wow-delay=".2s">
                                        <span class="number">0{{ $loop->iteration }}.</span>
                                        <h6 class="title">
                                            {{ $sub_content->title }}
                                        </h6>
                                        <div class="desc">
                                            <p>
                                                {{ $sub_content->description }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <div class="tj-sidebar-widget widget-feature-item wow fadeInUp ambulnce-sticky"
                            data-wow-delay=".3s">
                            <div class="feature-box">
                                <div class="feature-images">
                                    <img src="{{ $contents->image }}" alt="" />
                                </div>

                                <div class="feature-content">
                                    <h3>How to book our Ambulance</h3>
                                    <p class="desc">Getting help</p>
                                    <ul class="list-items">
                                        <li>Global Leadership</li>
                                        <li>Transformative Impact</li>
                                        <li>Sustainable Success</li>
                                    </ul>
                                    <a class="read-more feature-contact" href="tel:8321890640">
                                        <i class="tji-phone-3"></i>
                                        <span>{{ $contents->number }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tj-sidebar-widget service-categories wow fadeInUp" data-wow-delay=".1s">
                            <div class="contact-form wow fadeInUp" data-wow-delay=".1s">
                                <h3 class="title">Request a call Back</h3>
                                <form id="contact-form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-input">
                                                <input type="text" name="cfName" />
                                                <label class="cf-label">Full Name <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-input">
                                                <input type="tel" name="cfPhone" />
                                                <label class="cf-label">Phone number <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-input">
                                                <div class="tj-nice-select-box">
                                                    <div class="tj-select">
                                                        <select name="cfSubject">
                                                            <option value="0">Chose a option</option>
                                                            <option value="1">
                                                                Business Strategy
                                                            </option>
                                                            <option value="2">
                                                                Customer Experience
                                                            </option>
                                                            <option value="3">
                                                                Sustainability and ESG
                                                            </option>
                                                            <option value="4">
                                                                Training and Development
                                                            </option>
                                                            <option value="5">
                                                                IT Support & Maintenance
                                                            </option>
                                                            <option value="6">
                                                                Marketing Strategy
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="submit-btn">
                                            <button class="tj-primary-btn" type="submit">
                                                <span class="btn-text"><span>Submit Now</span></span>
                                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
