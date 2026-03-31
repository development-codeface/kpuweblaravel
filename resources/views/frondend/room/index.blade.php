@extends('frondend.app')
@section('content')
    <style>
        :root {
            --teal: #0d9488;
            --teal-light: #14b8a6;
            --teal-dark: #0f766e;
            --navy: #0f2a3f;
            --navy-light: #1e3a52;
            --cream: #f8fafb;
            --white: #ffffff;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
            --text: #1f2937;
            --card-shadow:
                0 4px 24px rgba(13, 148, 136, 0.1), 0 1px 4px rgba(0, 0, 0, 0.06);
            --card-hover:
                0 8px 40px rgba(13, 148, 136, 0.18), 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ─── Section ─── */
       .rooms-section {
    padding-top: 120px;
    padding-bottom: 120px;
}

        .section-label {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--teal-dark);
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 34px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 36px;
        }

        /* ─── Grid ─── */
        .rooms-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 26px;
        }

        .rooms-grid .card {
            width: 31%;
        }

        /* ─── Card ─── */
        .card {
            background: var(--white);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(13, 148, 136, 0.08);
            transition:
                transform 0.28s ease,
                box-shadow 0.28s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover);
        }

        /* Room image */
        .card-img {
            width: 100%;
            height: 195px;
            object-fit: cover;
            display: block;
            position: relative;
        }

        .card-img-wrap {
            position: relative;
            overflow: hidden;
        }

        .card-img-wrap img {
            width: 100%;
            height: 195px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .card:hover .card-img-wrap img {
            transform: scale(1.04);
        }

        .card-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(15, 38, 63, 0.72);
            backdrop-filter: blur(6px);
            color: white;
            border-radius: 100px;
            padding: 5px 14px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Card body */
        .card-body {
            padding: 22px 24px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            padding: 14px 0px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--navy);
        }

        .card-beds {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--teal);
            background: rgba(13, 148, 136, 0.09);
            border-radius: 100px;
            padding: 3px 12px;
        }

        /* Features */
        .features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 22px;
            flex: 1;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 0.84rem;
            color: var(--gray);
        }

        .features li::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--teal-light);
            flex-shrink: 0;
        }

        /* Book button */
        .btn-book {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 11px 20px;
            background: linear-gradient(135deg,
                    var(--teal) 0%,
                    var(--teal-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: "DM Sans", sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition:
                opacity 0.2s,
                transform 0.18s;
            text-decoration: none;
            letter-spacing: 0.02em;
            margin-top: auto;
        }

        .btn-book:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .btn-book svg {
            width: 15px;
            height: 15px;
            fill: none;
            stroke: white;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ─── Modal ─── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 38, 63, 0.55);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 20px;
            padding: 36px;
            max-width: 460px;
            width: 100%;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.18);
            animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(16px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 4px;
        }

        .modal-sub {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--gray-light);
            border-radius: 9px;
            font-family: "DM Sans", sans-serif;
            font-size: 0.88rem;
            color: var(--text);
            background: var(--cream);
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--teal);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-cancel {
            flex: 1;
            padding: 11px;
            border: 1.5px solid var(--gray-light);
            border-radius: 10px;
            background: white;

            font-size: 0.88rem;
            cursor: pointer;
            color: var(--gray);
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: var(--cream);
        }

        .btn-confirm {
            flex: 2;
            padding: 11px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg,
                    var(--teal) 0%,
                    var(--teal-dark) 100%);
            color: white;

            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-confirm:hover {
            opacity: 0.9;
        }

        /* Success toast */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--navy);
            color: white;
            border-radius: 12px;
            padding: 14px 22px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            transform: translateY(80px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 2000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast-icon {
            color: var(--teal-light);
            font-size: 1.1rem;
        }

        @media (max-width: 1100px) and (min-width: 786px) {
            .rooms-grid .card {
                width: 47%;
            }
        }

        @media (max-width: 786px) {
            .rooms-grid .card {
                width: 95%;
            }
        }
    </style>
    <div class="top-space-15"></div>


    <section class="tj-page-header section-gap-x" data-bg-image="{{ asset( $edit_banner->image) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5-banner-content">
                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn tag-port">
                                <span class="btn-text">{{ $edit_banner->button_text }}</span>
                            </a>
                        </div>
                        <h1 class="banner-title">{{ $edit_banner->title }}</h1>
                        <p class="desc">
                           {{ $edit_banner->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div> -->
    </section>



    <!-- Rooms Section -->
   <section class="rooms-section">
    <div class="container">
        <div class="section-label">Accommodation Options</div>
        <div class="section-title">Choose Your Room Type</div>

        <div class="rooms-grid">
            @foreach ($edit_rooms as $room)
                <div class="card">
                    <div class="card-img-wrap">
                        <img
                            src="{{ $room->image ? asset($room->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80' }}"
                            alt="{{ $room->type }}"
                        />
                        <span class="card-badge">{{ $room->type ?? 'Standard' }}</span>
                    </div>

                    <div class="card-body">
                        <div class="card-header">
                            <span class="card-title">{{ $room->heading }}</span>
                            <span class="card-beds">{{ $room->bed_count }} beds</span>
                        </div>

                        <ul class="features">
                            @if($room->specRooms && $room->specRooms->count())
                                @foreach ($room->specRooms as $spec)
                                    <li>{{ $spec->features }}</li>
                                @endforeach
                            @else
                                <li>No features available</li>
                            @endif
                        </ul>

                        <button class="btn-book" onclick="openModal('{{ $room->type }}')">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Book Appointment
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Booking Modal -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
        <div class="modal">
            <div class="modal-title" id="modalTitle">Book Appointment</div>
            <div class="modal-sub" id="modalSub">
                Fill in your details to reserve your room
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Enter your full name" />
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" placeholder="+91 00000 00000" />
            </div>
            <div class="form-group">
                <label>Preferred Date</label>
                <input type="date" id="dateInput" />
            </div>
            <div class="form-group">
                <label>Time Slot</label>
                <select>
                    <option>9:00 AM – 10:00 AM</option>
                    <option>10:00 AM – 11:00 AM</option>
                    <option>11:00 AM – 12:00 PM</option>
                    <option>2:00 PM – 3:00 PM</option>
                    <option>3:00 PM – 4:00 PM</option>
                </select>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal()">
                    Cancel
                </button>
                <button class="btn-confirm" onclick="confirmBooking()">
                    Confirm Booking
                </button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast">
        <span class="toast-icon">✓</span>
        <span id="toastMsg">Appointment booked successfully!</span>
    </div>


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
    </section>

    <script>
        // Set min date to today
        const dateInput = document.getElementById("dateInput");
        const today = new Date().toISOString().split("T")[0];
        dateInput.min = today;
        dateInput.value = today;

        let currentRoom = "";

        function openModal(roomType) {
            currentRoom = roomType;
            document.getElementById("modalTitle").textContent =
                `Book – ${roomType}`;
            document.getElementById("modalSub").textContent =
                `Reserve your ${roomType} at KPU Hospital`;
            document.getElementById("modalOverlay").classList.add("open");
        }

        function closeModal() {
            document.getElementById("modalOverlay").classList.remove("open");
        }

        function closeModalOutside(e) {
            if (e.target === document.getElementById("modalOverlay"))
                closeModal();
        }

        function confirmBooking() {
            closeModal();
            const toast = document.getElementById("toast");
            document.getElementById("toastMsg").textContent =
                `${currentRoom} appointment confirmed!`;
            toast.classList.add("show");
            setTimeout(() => toast.classList.remove("show"), 3500);
        }
    </script>
@endsection
