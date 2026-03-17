@extends('frondend.app')
@section('content')
    <div class="top-space-15"></div>

    <div class="top-space-15"></div>

    <section class="tj-page-header section-gap-x" data-bg-image="{{ $banner->image }}">
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

    <!-- start: About Section -->
    <section class="tj-about-section h6-about section-gap section-gap-x second-op">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="working-process-area">

                        @foreach ($contents as $index => $content)
                            <div class="process-item wow fadeInLeft" data-wow-delay=".5s">

                                <div class="process-step">
                                    <span>
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <div class="process-content">
                                    <h4 class="title">
                                        {{ $content->heading }}
                                    </h4>

                                    <p class="desc">
                                        {{ $content->description }}
                                    </p>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: About Section -->

    <!-- start: Contact Section -->
    <section class="tj-contact-section h4-contact-section section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form style-3 wow fadeInUp" data-wow-delay=".4s">
                        <div class="sec-heading style-4">
                            <h2 class="sec-title title-anim">
                                Select a doctor for second opinion
                            </h2>
                        </div>
                        <form id="contact-form-3" action="{{ route('second_opinion.index') }}" method="GET">
                            <div class="row wow fadeInUp" data-wow-delay=".5s">
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <div class="tj-nice-select-box">
                                            <div class="tj-select">
                                                <label class="cf-label">choose </label>
                                                <select name="department_id" id="departmentSelect" class="departmentSelect">
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <div class="tj-nice-select-box">
                                            <div class="tj-select">
                                                <label class="cf-label">Doctor</label>
                                                <select name="doctor_id" class="doctorSelect">
                                                    <option value="">Select Doctor</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row leftSwipeWrap selact-dr-card">
                @foreach ($doctors as $doctor)
                    <div class="col-lg-3 col-sm-6 doctor-card" data-doctor-id="{{ $doctor->id }}">
                        <div class="team-item left-swipe">
                            <div class="team-img">
                                <div class="team-img-inner">
                                    <img src="{{ asset($doctor->image) }}" alt="" />
                                </div>
                             
                            </div>
                            <div class="team-content">
                                <h4 class="title">
                                    <a href="team-details.html">{{ $doctor->name }}</a>
                                </h4>
                                <span class="designation">{{ $department->name }}</span>
                                <div class="h5-banner-content speciality-btn team-section">
                                    <div class="slider-btn">
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>View Profile</span></span>
                                        </a>
                                        <a class="tj-primary-btn" href="contact.html">
                                            <span class="btn-text"><span>Second opinion</span></span>
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
    <!-- end: Contact Section -->

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
                                                <img src="{{ asset('images/facility/' . $value->image) }}"
                                                    alt="">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // $.ajax({
            //     url: '/get-doctors-list/',
            //     type: 'GET',
            //     dataType: 'json',
            //     success: function(doctor) {
            //         console.log(doctor);
            //         // Update image
            //         $('.team-img-inner img').attr('src', doctor.image);

            //         // Update name
            //         $('.team-content .title a').text(doctor.name);

            //         // Update designation
            //         $('.designation').text(doctor.designation);
            //     },
            //     error: function(xhr) {
            //         console.log('Error:', xhr.responseText);
            //     }
            // });

            // loadAllDoctors();

            $(document).on('change', '.departmentSelect', function() {

                let departmentId = $(this).val();

                if (!departmentId) {

                    $('.doctorSelect').html('<option value="">Select Doctor</option>');
                    $('.doctorSelect').niceSelect('update'); // refresh
                    return;
                }

                $('.doctorSelect').html('<option value="">Loading...</option>');
                $('.doctorSelect').niceSelect('update'); // refresh

                $.ajax({
                    url: '/get-doctors/' + departmentId,
                    type: 'GET',
                    success: function(response) {

                        let options = '<option value="">Select Doctor</option>';

                        $.each(response, function(index, doctor) {
                            options += '<option value="' + doctor.id + '">' + doctor
                                .name + '</option>';
                        });

                        $('.doctorSelect').html(options);

                        // 🔥 VERY IMPORTANT
                        $('.doctorSelect').niceSelect('update');

                    }
                });

            });

            $(document).on('change', '.doctorSelect', function() {

                let doctorId = $(this).val();

                // If no doctor selected → show all
                if (doctorId === '') {
                    $('.doctor-card').fadeIn();
                    return;
                }

                // Hide all first
                $('.doctor-card').hide();

                // Show only selected doctor
                $('.doctor-card[data-doctor-id="' + doctorId + '"]').fadeIn();

                $.ajax({
                    url: '/get-doctor-details/' + doctorId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(doctor) {
                        // Update image
                        $('.team-img-inner img').attr('src', doctor.image);

                        // Update name
                        $('.team-content .title a').text(doctor.name);

                        // Update designation
                        $('.designation').text(doctor.designation);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });

            });

            // function loadAllDoctors() {

            //     $.ajax({
            //         url: '/get-doctors-list/',
            //         type: 'GET',
            //         dataType: 'json',
            //         success: function(doctors) {

            //             let html = '';

            //             $.each(doctors, function(index, doctor) {

            //                 html += `
        //         <div class="col-lg-3 col-sm-6">
        //             <div class="team-item left-swipe">
        //                 <div class="team-img">
        //                     <div class="team-img-inner">
        //                         <img src="${doctor.image}" alt="${doctor.name}" />
        //                     </div>
        //                 </div>
        //                 <div class="team-content">
        //                     <h4 class="title">
        //                         <a href="#">${doctor.name}</a>
        //                     </h4>
        //                     <span class="designation">${doctor.designation}</span>
        //                 </div>
        //             </div>
        //         </div>
        //     `;
            //             });

            //             $('.leftSwipeWrap').html(html);
            //         }
            //     });

            // }
        });
    </script>

    <!-- end: Project Section -->
@endsection
