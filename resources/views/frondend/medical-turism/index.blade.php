@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>
    <section class="tj-page-header section-gap-x hospital-icu" data-bg-image="{{ asset($banner->image) }}">
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
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <div class="tj-sidebar-widget service-categories wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">More services</h4>
                            <ul>
                                @foreach ($menu as $menuItem)
                                    <li>
                                        <a href="#menu-{{ $menuItem->id }}" class="scroll-link">
                                            {{ $menuItem->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        @foreach ($menu as $menuItems)
                            @foreach ($menuItems->contents as $item)
                                <div id="menu-{{ $item->menus_id }}" class="service-section">
                                    <br>
                                    <h2 class="title title-anim">
                                        {{ $item->title }}
                                    </h2>

                                    <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                                        <img src="assets/images/service/service-details.webp" alt="Images" />
                                    </div>
                                    <div class="blog-text">
                                        <p class="wow fadeInUp" data-wow-delay=".3s">
                                            {{ $item->description }}
                                        </p>

                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->

    <div class="container medical-tour">
        <div class="header">
            <h1>{{ $content->title }}</h1>
            <p>
                {{ $content->sub_title }}
            </p>
        </div>

        <div class="benefits-grid">
            <!-- World-Class Care -->
            @foreach ($content->subContents as $values)
                <div class="benefit-card">
                    <div class="icon-wrapper">
                        <i class="{{ $values->icon }}"></i>
                    </div>
                    <h3>{{ $values->heading }}</h3>
                    <p>
                        {{ $values->description }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container medical-iner">
        <div class="header">
            <h1>{{ $trip->title }}</h1>
            <p>
                {{ $trip->sub_title }}
            </p>
        </div>

        <div class="steps-grid hspt-intr">
            @foreach ($trip->contents as $index => $content)
                <div class="step-card">
                    <div class="step-number">
                         <div class="step-orde">

                             <div class="number"> {{ $index + 1 }}</div>
                             <div class="icon">📄</div>
                         </div>
                        <div class="step-detai">
        <h3>{{ $content->heading }}</h3>
                        <p>
                            {{ $content->description }}
                        </p>
                        </div>
                    </div>
                    <div class="step-content">
                        
                        @if ($content->subcontents->count())
                            <ul class="step-features">
                                @foreach ($content->subcontents as $sub)
                                    <li>{{ $sub->text }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="contact-section">
            <div class="contact-icon">🌍</div>
            <h2>Contact Our International Desk</h2>
            <p>
                Our dedicated team is available 24/7 to assist you with your
                medical travel needs.
            </p>
            <div class="contact-buttons">
                <a href="https://wa.me/919876543210" class="contact-btn">
                    📱 WhatsApp: +91 98765 43210
                </a>
                <a href="mailto:international@kpuhospital.com" class="contact-btn secondary">
                    ✉️ Email Us
                </a>
            </div>
        </div>
    </div>

    <!-- start: Project Section -->
    {{-- <section class="tj-project-section-3 section-gap section-gap-x">
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
    </section> --}}

    
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
