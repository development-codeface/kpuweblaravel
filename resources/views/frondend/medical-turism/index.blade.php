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
            <h1>Why Choose India for Medical Treatment?</h1>
            <p>
                India has emerged as a global leader in medical tourism,
                attracting millions of patients annually.
            </p>
        </div>

        <div class="benefits-grid">
            <!-- World-Class Care -->
            <div class="benefit-card">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                    </svg>
                </div>
                <h3>World-Class Care</h3>
                <p>
                    JCI & NABH accredited hospitals with internationally trained
                    doctors
                </p>
            </div>

            <!-- Cost Savings -->
            <div class="benefit-card">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="6" x2="12" y2="12" />
                        <line x1="12" y1="12" x2="16" y2="16" />
                    </svg>
                </div>
                <h3>Cost Savings</h3>
                <p>
                    Save 60-90% compared to US, UK, and other developed countries
                </p>
            </div>

            <!-- No Wait Times -->
            <div class="benefit-card">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2z" />
                        <path d="M17 12H12V7" />
                    </svg>
                </div>
                <h3>No Wait Times</h3>
                <p>
                    Immediate appointments and treatments without long waiting
                    periods
                </p>
            </div>

            <!-- English Speaking -->
            <div class="benefit-card">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <h3>English Speaking</h3>
                <p>
                    Medical staff fluent in English for seamless communication
                </p>
            </div>
        </div>
    </div>

    <div class="container medical-iner">
        <div class="header">
            <h1>Plan Your Medical Trip</h1>
            <p>
                A step-by-step guide to help you plan your medical journey to
                KPU Hospital.
            </p>
        </div>

        <div class="steps-grid">
            <!-- Step 1 -->
            <div class="step-card">
                <div class="step-number">
                    <div class="number">1</div>
                    <div class="icon">📄</div>
                </div>
                <div class="step-content">
                    <h3>Send Your Medical Reports</h3>
                    <p>
                        Share your medical history, reports, and diagnosis with our
                        team for evaluation.
                    </p>
                    <ul class="step-features">
                        <li>Upload reports via our website or</li>
                        <li>Include recent test results</li>
                        <li>Share your medical history</li>
                        <li>Describe your current symptoms</li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-card">
                <div class="step-number">
                    <div class="number">2</div>
                    <div class="icon">⏱️</div>
                </div>
                <div class="step-content">
                    <h3>Receive Treatment Plan & Estimate</h3>
                    <p>
                        Our specialists will review your case and provide a detailed
                        treatment plan with cost estimate.
                    </p>
                    <ul class="step-features">
                        <li>Doctor's opinion within 48 hours</li>
                        <li>Transparent cost breakdown</li>
                        <li>Detailed treatment protocol</li>
                        <li>Duration of hospital stay</li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-card">
                <div class="step-number">
                    <div class="number">3</div>
                    <div class="icon">🏨</div>
                </div>
                <div class="step-content">
                    <h3>Accommodation & Stay</h3>
                    <p>
                        We arrange comfortable accommodation for you and your
                        attendants during your visit.
                    </p>
                    <ul class="step-features">
                        <li>Hospital room options</li>
                        <li>Guest house facilities</li>
                        <li>Nearby hotel arrangements</li>
                        <li>Long-stay accommodations</li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-card">
                <div class="step-number">
                    <div class="number">4</div>
                    <div class="icon">🔄</div>
                </div>
                <div class="step-content">
                    <h3>Treatment & Recovery</h3>
                    <p>
                        Receive world-class treatment with comprehensive care
                        throughout your stay.
                    </p>
                    <ul class="step-features">
                        <li>Personal care coordinator</li>
                        <li>24/7 support</li>
                        <li>Language assistance</li>
                        <li>Regular family updates</li>
                    </ul>
                </div>
            </div>
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
    <section class="tj-project-section-3 section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Proud
                            Projects</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-3">
                                <h2 class="sec-title title-anim">
                                    Breaking Boundaries, Building Dreams.
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="swiper project-slider-2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-6.webp" alt="" />

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title">
                                                        <a href="portfolio-details-2.html">Event Management Platform</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-7.webp" alt="" />

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title">
                                                        <a href="portfolio-details-2.html">Rebranding Strategy for a
                                                            Growing</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-8.webp" alt="" />

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title">
                                                        <a href="portfolio-details-2.html">Interactive Learning
                                                            Platform</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="project-item">
                                        <div class="project-img">
                                            <img src="assets/images/project/project-9.webp" alt="" />

                                            <div class="project-content">
                                                <span class="categories"><a
                                                        href="portfolio-details-2.html">Business</a></span>
                                                <div class="project-text">
                                                    <h4 class="title">
                                                        <a href="portfolio-details-2.html">Environmental Impact
                                                            Dashboard</a>
                                                    </h4>
                                                    <a class="project-btn" href="portfolio-details-2.html">
                                                        <i class="tji-arrow-right-big"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
