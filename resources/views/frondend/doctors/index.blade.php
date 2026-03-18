@extends('frondend.app')
@section('content')
    <section class="tj-page-header section-gap-x spacialiy-banner doctors-bnn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">Our Doctors</span>
                            </a>
                        </div>
                        <h1 class="banner-title">Find a Doctor</h1>
                        <p class="desc">
                            We stay ahead of the leveraging cutting-edge technologies
                            and strategies to keep. We stay ahead of the leveraging
                            cutting-edge technologies and strategies to keep.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="doctors-bner-fltr">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tj_search_wrapper dr">
                            <div class="search_form">
                                <form action="{{ route('doctor.search') }}" method="GET">
                                    <div class="search_input dr-banner-flr">
                                        <div class="search-box dr-search">
                                            <input class="search-form-input" type="text" name="q"
                                                value="{{ request('q') }}" placeholder="Search doctor or department"
                                                required />
                                            <button type="submit">
                                                <i class="tji-search"></i>
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
    <!-- start: Team Section -->
    <section class="tj-team-section-3 section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- <div class="sec-heading text-center">
                              <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i> Meet Our Team</span>
                              <h2 class="sec-title title-anim">Success <span>Stories</span> Fuel our Innovation.</h2>
                            </div> -->
                </div>
            </div>
            <div class="row leftSwipeWrap selact-dr-card">
                @foreach ($dcotor_data as $doctor)
                    <div class="col-lg-3 col-sm-6 doctor-card">
                        <div class="team-item left-swipe">
                            <div class="team-img">
                                <div class="team-img-inner">
                                    <img src="{{ $doctor->image }}" alt="" />
                                </div>
                               
                            </div>
                            <div class="team-content">
                                <h4 class="title">
                                    <a href="team-details.html">{{ $doctor->name }}</a>
                                </h4>
                                @foreach ($doctor->doctorDepartments as $row)
                                    @if ($row->department)
                                        <span class="designation">
                                            {{ $row->department->name }}
                                        </span>
                                    @endif
                                @endforeach

                                <div class="h5-banner-content speciality-btn team-section">
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>Book Appointment</span></span>
                                        </a>
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>View Profile</span></span>
                                        </a>
                                      
                                    </div>
                                </div>
                                <!-- <a class="mail-at" href="mailto:info@bexon.com"><i class="tji-at"></i></a> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
