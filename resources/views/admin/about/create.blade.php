@extends('layouts.admin')
@section('content')
    <style>
        .about-editor-card {
            border: 0;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(7, 53, 60, 0.12);
            background: linear-gradient(180deg, #eef8f7 0%, #ffffff 22%);
        }

        .about-editor-header {
            padding: 1.35rem 1.75rem;
            border: 0;
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.26), transparent 24%),
                linear-gradient(135deg, #0b4f5b 0%, #0e6d64 52%, #18a07f 100%);
        }

        .about-editor-header p {
            margin: 0;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .about-editor-body {
            padding: 1.75rem;
        }

        .about-page-intro {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1.5rem;
            padding: 1.5rem 1.6rem;
            margin-bottom: 1.75rem;
            border: 1px solid rgba(14, 109, 100, 0.12);
            border-radius: 24px;
            background:
                radial-gradient(circle at top left, rgba(24, 160, 127, 0.16), transparent 30%),
                linear-gradient(135deg, #f8fffe 0%, #eef7f6 100%);
        }

        .about-page-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            background: rgba(11, 79, 91, 0.1);
            color: #0b4f5b;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .about-page-intro h2 {
            margin: 0.85rem 0 0.5rem;
            color: #12343a;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.15;
        }

        .about-page-intro p {
            max-width: 760px;
            margin: 0;
            color: #577277;
            font-size: 1rem;
            line-height: 1.7;
        }

        .about-page-meta {
            min-width: 220px;
            padding: 1rem 1.1rem;
            border-radius: 20px;
            background: #ffffff;
            border: 1px solid rgba(14, 109, 100, 0.12);
            box-shadow: 0 20px 45px rgba(8, 50, 58, 0.08);
        }

        .about-page-meta span {
            display: block;
            margin-bottom: 0.35rem;
            color: #18a07f;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .about-page-meta strong {
            display: block;
            color: #12343a;
            font-size: 1.05rem;
            font-weight: 800;
            line-height: 1.45;
        }

        .about-editor-layout {
            align-items: flex-start;
        }

        .about-sidebar-col {
            align-self: flex-start;
            margin-bottom: 1.5rem;
        }

        #aboutMenu {
            position: sticky;
            top: 20px;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            padding: 1rem;
            border: 1px solid rgba(14, 109, 100, 0.12);
            border-radius: 24px;
            background: linear-gradient(180deg, #f7fcfb 0%, #eef7f6 100%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        #aboutMenu .list-group-item {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            min-height: 76px;
            padding: 1rem 1rem 1rem 0.95rem;
            border: 1px solid transparent;
            border-radius: 18px;
            background: #ffffff;
            color: #24474d;
            box-shadow: 0 14px 32px rgba(9, 42, 49, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease,
                background 0.2s ease, color 0.2s ease;
        }

        #aboutMenu .list-group-item+.list-group-item {
            margin-top: 0;
        }

        #aboutMenu .list-group-item:hover {
            transform: translateY(-1px);
            border-color: rgba(24, 160, 127, 0.25);
            box-shadow: 0 18px 36px rgba(9, 42, 49, 0.1);
        }

        #aboutMenu .list-group-item.active {
            border-color: transparent;
            background: linear-gradient(135deg, #0b4f5b 0%, #0f7b6b 58%, #18a07f 100%);
            color: #ffffff;
            box-shadow: 0 22px 40px rgba(11, 79, 91, 0.28);
        }

        .about-nav-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 14px;
            background: rgba(11, 79, 91, 0.08);
            color: #0b4f5b;
            font-size: 0.9rem;
            font-weight: 800;
        }

        #aboutMenu .list-group-item.active .about-nav-count {
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
        }

        .about-nav-copy {
            display: flex;
            flex-direction: column;
            gap: 0.18rem;
        }

        .about-nav-copy strong {
            font-size: 0.98rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .about-nav-copy small {
            font-size: 0.78rem;
            color: #6d878b;
            line-height: 1.35;
        }

        #aboutMenu .list-group-item.active .about-nav-copy small {
            color: rgba(255, 255, 255, 0.82);
        }

        .about-panel-col {
            margin-bottom: 1.5rem;
        }

        .about-tab-content {
            min-height: 100%;
        }

        .about-tab-pane {
            padding: 0.15rem 0;
        }

        .editor-section-head {
            margin-bottom: 1.35rem;
        }

        .editor-section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(24, 160, 127, 0.1);
            color: #0f7b6b;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .editor-section-title {
            margin: 1rem 0 0.45rem;
            color: #16393f;
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .editor-section-copy {
            max-width: 780px;
            margin: 0;
            color: #607b80;
            font-size: 0.98rem;
            line-height: 1.7;
        }

        .about-editor-card .section-item {
            margin: 0 !important;
            padding: 0 !important;
            border: 0 !important;
            background: transparent;
        }

        .about-form-shell {
            padding: 1.6rem;
            border: 1px solid rgba(15, 77, 87, 0.1);
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfefe 100%);
            box-shadow: 0 18px 44px rgba(10, 49, 56, 0.08);
        }

        .about-editor-card .form-group {
            margin-bottom: 1.15rem;
        }

        .about-editor-card label {
            display: inline-block;
            margin-bottom: 0.5rem;
            color: #173b40;
            font-size: 0.92rem;
            font-weight: 700;
        }

        .about-editor-card .form-control {
            min-height: 52px;
            border: 1px solid #d5e4e3;
            border-radius: 16px;
            background: #fdfefe;
            color: #173b40;
            padding: 0.9rem 1rem;
            box-shadow: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .about-editor-card textarea.form-control {
            min-height: 140px;
            resize: vertical;
        }

        .about-editor-card .form-control:focus {
            border-color: #18a07f;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(24, 160, 127, 0.14);
        }

        .about-editor-card .help-block {
            display: inline-block;
            margin-top: 0.45rem;
            color: #80979b;
            font-size: 0.8rem;
        }

        .about-editor-card .invalid-feedback {
            font-size: 0.82rem;
        }

        .about-editor-card .feature-row {
            margin-bottom: 1rem !important;
            padding: 1.2rem !important;
            border: 1px solid rgba(14, 109, 100, 0.12) !important;
            border-radius: 20px;
            background: linear-gradient(180deg, #fcfffe 0%, #f4fbfa 100%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        .about-editor-card #feature-wrapper,
        .about-editor-card #feature-wrappers,
        .about-editor-card #feature-wrapperss {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-box {
            width: 100%;
            max-width: 240px;
            height: 220px;
            border: 1px dashed #9bc7bf;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f7fbfa 0%, #edf6f5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .image-box:hover {
            transform: translateY(-1px);
            border-color: #18a07f;
            box-shadow: 0 16px 32px rgba(12, 75, 82, 0.12);
        }

        .feature-row .image-box {
            max-width: 100%;
            height: 200px;
        }

        .triangle-placeholder {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 40px solid #91afa9;
        }

        .image-box img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
        }

        .about-editor-card .btn {
            border: 0;
            border-radius: 14px;
            font-weight: 700;
            padding: 0.82rem 1.2rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .about-editor-card .btn:hover {
            transform: translateY(-1px);
        }

        .about-editor-card .btn-success {
            min-width: 190px;
            background: linear-gradient(135deg, #0c6d63 0%, #18a07f 100%);
            box-shadow: 0 18px 34px rgba(12, 109, 99, 0.24);
        }

        .about-editor-card .btn-primary {
            background: linear-gradient(135deg, #143f58 0%, #1c6a87 100%);
            box-shadow: 0 14px 28px rgba(20, 63, 88, 0.18);
        }

        .about-editor-card .btn-danger {
            background: linear-gradient(135deg, #c25555 0%, #dc6f6f 100%);
            box-shadow: 0 14px 28px rgba(194, 85, 85, 0.18);
        }

        .about-editor-card .ck.ck-editor__main>.ck-editor__editable {
            min-height: 280px;
            border-radius: 0 0 16px 16px !important;
        }

        .about-editor-card .ck.ck-toolbar {
            border-radius: 16px 16px 0 0 !important;
        }

        @media (max-width: 991.98px) {
            .about-editor-body {
                padding: 1.25rem;
            }

            .about-page-intro {
                flex-direction: column;
            }

            .about-page-meta {
                width: 100%;
                min-width: 0;
            }

            #aboutMenu {
                position: static;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .about-nav-copy small {
                display: none;
            }

            .about-form-shell {
                padding: 1.25rem;
            }
        }

        @media (max-width: 767.98px) {
            #aboutMenu {
                grid-template-columns: 1fr;
            }

            .about-page-intro h2 {
                font-size: 1.6rem;
            }

            .editor-section-title {
                font-size: 1.45rem;
            }

            .about-editor-card .btn-success,
            .about-editor-card .btn-primary {
                width: 100%;
            }

            .image-box {
                max-width: 100%;
            }
        }
    </style>
    <div class="card about-editor-card">
        <div class="card-header about-editor-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                About Page CMS Builder</p>
        </div>

        <div class="card-body about-editor-body">
            <div class="about-page-intro">
                <div>
                    <span class="about-page-badge">Client View Inspired Layout</span>
                    <h2>Manage the public About page with a cleaner section-by-section editor.</h2>
                    <p>Use the left tabs to switch between the same banner, story, highlights, and pillar blocks shown on
                        the client-facing About page. Each tab opens its own form inside this CMS screen.</p>
                </div>
                <div class="about-page-meta">
                    <span>7 Editable Blocks</span>
                    <strong>Tabbed About page builder with a more polished CMS design</strong>
                </div>
            </div>
            <div class="row about-editor-layout">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3 about-sidebar-col">
                    <div class="list-group position-sticky" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#bannerSection" role="tab">
                            <span class="about-nav-count">01</span>
                            <span class="about-nav-copy">
                                <strong>Hero Banner</strong>
                                <small>Top heading and CTA</small>
                            </span>
                        </a>

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'blogSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#blogSection" role="tab">
                            <span class="about-nav-count">02</span>
                            <span class="about-nav-copy">
                                <strong>Who We Are</strong>
                                <small>Intro cards and icon copy</small>
                            </span>
                        </a>

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'contentSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#contentSection" role="tab">
                            <span class="about-nav-count">03</span>
                            <span class="about-nav-copy">
                                <strong>Story Content</strong>
                                <small>Main image and rich text</small>
                            </span>
                        </a>

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'featureSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#featureSection" role="tab">
                            <span class="about-nav-count">04</span>
                            <span class="about-nav-copy">
                                <strong>Core Values</strong>
                                <small>Feature grid items</small>
                            </span>
                        </a>

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'sub_content_Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#sub_content_Section" role="tab">
                            <span class="about-nav-count">05</span>
                            <span class="about-nav-copy">
                                <strong>Mission Block</strong>
                                <small>Standalone content highlight</small>
                            </span>
                        </a>

                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'mid_content_Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#mid_content_Section" role="tab">
                            <span class="about-nav-count">06</span>
                            <span class="about-nav-copy">
                                <strong>Highlights</strong>
                                <small>Scrollable image cards</small>
                            </span>
                        </a>
                        <a class="list-group-item list-group-item-action about-nav-item {{ old('active_tab') == 'sections' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#sections" role="tab">
                            <span class="about-nav-count">07</span>
                            <span class="about-nav-copy">
                                <strong>Strategic Pillars</strong>
                                <small>Bottom section cards</small>
                            </span>
                        </a>
                        {{-- <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#blog_sections"
                            role="tab">
                            About 8
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-9 about-panel-col">
                    <div class="tab-content about-tab-content">

                        <!-- ================= Banner Section ================= -->
                        <div class="tab-pane fade about-tab-pane {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'show active' : '' }}"
                            id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 01</span>
                                        <h1 class="editor-section-title">Hero Banner</h1>
                                        <p class="editor-section-copy">Update the opening title and call-to-action used at
                                            the top of the public About page.</p>
                                    </div>
                                    <form class="about-form-shell" method="POST"
                                        action="{{ route('admin.about.banner.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="banner_id" value="{{ $edit_banner->id }}">
                                        <input type="hidden" name="about_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.about.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title"
                                                        value="{{ old('title', $edit_banner->title ?? '') }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.about.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text', $edit_banner->button_text ?? '') }}"
                                                        placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class=" btn btn-success min-w-200 " type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- KEEP YOUR EXISTING BANNER INPUTS HERE -->
                            <!-- DO NOT CHANGE ANYTHING INSIDE -->
                        </div>


                        <!-- ================= Blogs Section ================= -->
                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'blogSection' ? 'show active' : '' }}"
                            id="blogSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 02</span>
                                        <h1 class="editor-section-title">Who We Are</h1>
                                        <p class="editor-section-copy">Shape the intro area with headline copy, supporting
                                            text, icon content, and the featured image.</p>
                                    </div>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.blog.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="blogSection">
                                                <input type="hidden" name="blog_id" value="{{ $edit_blog->id }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.about.fields.heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="heading" placeholder="Enter heading"
                                                                id="heading"
                                                                value="{{ old('heading', $edit_blog->heading ?? '') }}">
                                                            @if ($errors->has('heading', $edit_blog->heading ?? ''))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="Blog_title">{{ trans('cruds.about.fields.Blog_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('Blog_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="Blog_title" id="Blog_title"
                                                                value="{{ old('Blog_title', $edit_blog->title ?? '') }}"
                                                                placeholder="Enter button text">
                                                            @if ($errors->has('Blog_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('Blog_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required">Image</label>

                                                            <div class="image-box"
                                                                onclick="document.getElementById('Blog_image').click();">

                                                                @if (isset($edit_blog) && $edit_blog->image)
                                                                    <img src="{{ asset($edit_blog->image) }}"
                                                                        id="imagePreview"
                                                                        style="width:100%; display:block;">
                                                                @else
                                                                    <div class="triangle-placeholder"
                                                                        id="trianglePlaceholder">
                                                                    </div>
                                                                    <img id="imagePreview" style="display:none;">
                                                                @endif
                                                            </div>

                                                            <input type="file" name="Blog_image" id="Blog_image"
                                                                accept="image/*"
                                                                class="d-none {{ $errors->has('Blog_image') ? 'is-invalid' : '' }}"
                                                                onchange="previewImage(this)">

                                                            @if ($errors->has('Blog_image'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('Blog_image') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_heading">{{ trans('cruds.about.fields.sub-heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_heading"
                                                                placeholder="Enter Sub heading" id="heading"
                                                                value="{{ old('sub_heading', $edit_blog->sub_heading ?? '') }}">
                                                            @if ($errors->has('sub_heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="description">
                                                                {{ trans('cruds.about.fields.description') }}
                                                            </label>

                                                            <textarea class="form-control {{ $errors->has('blog_description') ? 'is-invalid' : '' }}" name="blog_description"
                                                                id="blog_description" rows="5" placeholder="Enter description">{{ old('blog_description', $edit_blog->description ?? '') }}</textarea>

                                                            @if ($errors->has('blog_description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('blog_description') }}
                                                                </div>
                                                            @endif

                                                            <span class="help-block">
                                                                {{ trans('cruds.about.fields.name_helper') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="blog_icon">{{ trans('cruds.about.fields.icon') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('blog_icon') ? 'is-invalid' : '' }}"
                                                                type="text" name="blog_icon" placeholder="Enter icon"
                                                                id="blog_icon"
                                                                value="{{ old('blog_icon', $edit_blog->icon ?? '') }}">
                                                            @if ($errors->has('blog_icon'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('blog_icon') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_heading_two">{{ trans('cruds.about.fields.sub_heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_heading_two') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_heading_two"
                                                                placeholder="Enter Sub heading" id="sub_heading_two"
                                                                value="{{ old('sub_heading_two', $edit_blog->icon_heading ?? '') }}">
                                                            @if ($errors->has('sub_heading_two'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_heading_two') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="description">
                                                                {{ trans('cruds.about.fields.description') }}
                                                            </label>

                                                            <textarea class="form-control {{ $errors->has('sub_description') ? 'is-invalid' : '' }}" name="sub_description"
                                                                id="description" rows="5" placeholder="Enter description">{{ old('sub_description', $edit_blog->icon_description ?? '') }}</textarea>

                                                            @if ($errors->has('sub_description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_description') }}
                                                                </div>
                                                            @endif

                                                            <span class="help-block">
                                                                {{ trans('cruds.about.fields.name_helper') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- KEEP YOUR EXISTING BLOG SECTION CODE HERE -->
                        <!-- Your #section-wrapper and inputs remain SAME -->
                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'contentSection' ? 'show active' : '' }}"
                            id="contentSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 03</span>
                                        <h1 class="editor-section-title">Story Content</h1>
                                        <p class="editor-section-copy">Manage the main About story area, including the
                                            supporting image and rich text content block.</p>
                                    </div>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="contentSection">
                                                <input type="hidden" name="content_id" value="{{ $edit_content->id }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="content_heading">{{ trans('cruds.about.fields.heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('content_heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="content_heading"
                                                                placeholder="Enter heading" id="content_heading"
                                                                value="{{ old('content_heading', $edit_content->heading ?? '') }}">
                                                            @if ($errors->has('content_heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required">Image</label>

                                                            <div class="image-box"
                                                                onclick="document.getElementById('logo_image').click();">
                                                                @if (isset($edit_content) && $edit_content->logo_image)
                                                                    <img src="{{ asset($edit_content->logo_image) }}"
                                                                        id="imagePreview"
                                                                        style="width:100%; display:block;">
                                                                @else
                                                                    <div class="triangle-placeholder"
                                                                        id="logo_trianglePlaceholder">
                                                                    </div>
                                                                    <img id="logo_imagePreview" style="display:none;">
                                                                @endif
                                                            </div>

                                                            <input type="file" name="logo_image" id="logo_image"
                                                                accept="image/*"
                                                                class="d-none {{ $errors->has('logo_image') ? 'is-invalid' : '' }}"
                                                                onchange="logopreviewImage(this)">

                                                            @if ($errors->has('logo_image'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('logo_image') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="description">
                                                                {{ trans('cruds.about.fields.description') }}
                                                            </label>

                                                            <textarea class="form-control {{ $errors->has('content_description') ? 'is-invalid' : '' }}"
                                                                name="content_description" id="editor" rows="6">{{ old('content_description', $edit_content->content ?? '') }}</textarea>

                                                            @if ($errors->has('content_description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_description') }}
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add future service inputs here -->
                        </div>

                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'featureSection' ? 'show active' : '' }}"
                            id="featureSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 04</span>
                                        <h1 class="editor-section-title">Core Values</h1>
                                        <p class="editor-section-copy">Build the public value cards with a section heading,
                                            subtitle, and repeatable icon-driven feature items.</p>
                                    </div>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.feature.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="featureSection">
                                                <input type="hidden" name="feature_id"
                                                    value="{{ $about_feature->id ?? '' }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="feature_title">{{ trans('cruds.feature.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('feature_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="feature_title"
                                                                placeholder="Enter title" id="feature_title"
                                                                value="{{ old('feature_title', $about_feature->title ?? '') }}">
                                                            @if ($errors->has('feature_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('feature_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="feature_sub_title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('feature_sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="feature_sub_title"
                                                                id="feature_sub_title"
                                                                value="{{ old('feature_sub_title', $about_feature->sub_title ?? '') }}"
                                                                placeholder="Enter Sub title">
                                                            @if ($errors->has('feature_sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('feature_sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapper">

                                                    @php
                                                        if (old('feature_icon')) {
                                                            $rows = collect(old('feature_icon'))->map(function (
                                                                $icon,
                                                                $index,
                                                            ) {
                                                                return (object) [
                                                                    'id' => old('content_id')[$index] ?? null,
                                                                    'icon' => old('feature_icon')[$index],
                                                                    'name' => old('name')[$index],
                                                                    'description' => old('feature_description')[$index],
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($about_feature) &&
                                                                $about_feature->featureContents->count()
                                                                    ? $about_feature->featureContents
                                                                    : collect([
                                                                        (object) [
                                                                            'id' => null,
                                                                            'icon' => '',
                                                                            'name' => '',
                                                                            'description' => '',
                                                                        ],
                                                                    ]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="content_id[]"
                                                                value="{{ $row->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="feature_icon[]"
                                                                            value="{{ $row->icon }}"
                                                                            class="form-control {{ $errors->has('feature_icon.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('feature_icon.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('feature_icon.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Name</label>
                                                                        <input type="text" name="name[]"
                                                                            value="{{ $row->name }}"
                                                                            class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('name.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('name.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="feature_description[]"
                                                                            class="form-control {{ $errors->has('feature_description.' . $index) ? 'is-invalid' : '' }}" rows="2">{{ $row->description }}</textarea>

                                                                        @if ($errors->has('feature_description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('feature_description.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" id="addRow" class="btn btn-primary mb-3">
                                                    + Add Row
                                                </button>

                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add future service inputs here -->
                        </div>

                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'sub_content_Section' ? 'show active' : '' }}"
                            id="sub_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 05</span>
                                        <h1 class="editor-section-title">Mission Block</h1>
                                        <p class="editor-section-copy">Edit the standalone About highlight with its title,
                                            subtitle, and descriptive content.</p>
                                    </div>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.sub_content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="sub_content_Section">
                                                <input type="hidden" name="sub_content_id"
                                                    value="{{ $sub_content->id }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.feature.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $sub_content->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('content_sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="content_sub_title"
                                                                placeholder="Enter Sub title" id="content_sub_title"
                                                                value="{{ old('content_sub_title', $sub_content->sub_title ?? '') }}">
                                                            @if ($errors->has('content_sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- LEFT -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required" for="content_description">
                                                                    {{ trans('cruds.about.fields.description') }}
                                                                </label>
                                                                <textarea class="form-control {{ $errors->has('content_description') ? 'is-invalid' : '' }}"
                                                                    name="content_description" id="content_description" rows="4" placeholder="Enter description">{{ old('content_description', $sub_content->description ?? '') }}</textarea>
                                                                @if ($errors->has('content_description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('content_description') }}
                                                                    </div>
                                                                @endif

                                                                <span class="help-block">
                                                                    {{ trans('cruds.about.fields.name_helper') }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add future service inputs here -->
                        </div>

                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'mid_content_Section' ? 'show active' : '' }}"
                            id="mid_content_Section" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 06</span>
                                        <h1 class="editor-section-title">Highlights</h1>
                                        <p class="editor-section-copy">Manage the scroll-style highlight cards with icon,
                                            title, description, and image for each item.</p>
                                    </div>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.mid_content.store') }}"
                                                enctype="multipart/form-data">
                                                <input type="hidden" name="active_tab" value="mid_content_Section">
                                                @csrf
                                                <input type="hidden" name="mid_content_id"
                                                    value="{{ $mid_content->id }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.about.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter Content"
                                                                id="title"
                                                                value="{{ old('title', $mid_content->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrappers">

                                                    @php
                                                        if (old('icon')) {
                                                            $rows = collect(old('icon'))->map(function ($icon, $index) {
                                                                return (object) [
                                                                    'id' => old('mid_sub_content_id')[$index] ?? null,
                                                                    'icon' => old('icon')[$index],
                                                                    'title' => old('sub_title')[$index],
                                                                    'description' => old('description')[$index],
                                                                    'image' => null,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($mid_content) &&
                                                                $mid_content->aboutMidSubContent->count()
                                                                    ? $mid_content->aboutMidSubContent
                                                                    : collect([
                                                                        (object) [
                                                                            'id' => null,
                                                                            'icon' => '',
                                                                            'title' => '',
                                                                            'description' => '',
                                                                            'image' => null,
                                                                        ],
                                                                    ]);
                                                        }
                                                    @endphp

                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="mid_sub_content_id[]"
                                                                value="{{ $row->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icon[]"
                                                                            value="{{ $row->icon }}"
                                                                            class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('icon.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('icon.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Title</label>
                                                                        <input type="text" name="sub_title[]"
                                                                            value="{{ $row->title }}"
                                                                            class="form-control {{ $errors->has('sub_title.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('sub_title.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('sub_title.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="description[]" class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}"
                                                                            rows="2">{{ $row->description ?? '' }}</textarea>

                                                                        @if ($errors->has('description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('description.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Image</label>
                                                                        <div class="image-box image-trigger">
                                                                            @if (isset($row->image))
                                                                                <img src="{{ asset($row->image) }}"
                                                                                    class="image-preview"
                                                                                    style="width:200px; display:block;">
                                                                            @else
                                                                                <div class="triangle-placeholder"></div>
                                                                                <img class="image-preview"
                                                                                    style="display:none; width:200px;">
                                                                            @endif
                                                                        </div>

                                                                        <input type="file" name="images[]"
                                                                            accept="image/*"
                                                                            class="d-none image-input {{ $errors->has('images.' . $index) ? 'is-invalid' : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" id="mid_addRow" class="btn btn-primary mb-3">
                                                    + Add Row
                                                </button>
                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add future service inputs here -->
                        </div>

                        <div class="tab-pane fade about-tab-pane {{ old('active_tab') == 'sections' ? 'show active' : '' }}"
                            id="sections" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="editor-section-head">
                                        <span class="editor-section-kicker">Section 07</span>
                                        <h1 class="editor-section-title">Strategic Pillars</h1>
                                        <p class="editor-section-copy">Control the closing About section with the main
                                            heading, title, and repeatable pillar entries.</p>
                                    </div>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form class="about-form-shell" method="POST"
                                                action="{{ route('admin.about.section.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="sections">
                                                <input type="hidden" name="section_id"
                                                    value="{{ $section->id ?? '' }}">
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="content_heading">{{ trans('cruds.about.fields.heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="heading" placeholder="Enter Heading"
                                                                id="heading"
                                                                value="{{ old('heading', $section->heading ?? '') }}">
                                                            @if ($errors->has('heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.about.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter Title"
                                                                id="title"
                                                                value="{{ old('title', $section->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapperss">
                                                    @php
                                                        if (old('section_icon')) {
                                                            $rows = collect(old('section_icon'))->map(function (
                                                                $icon,
                                                                $index,
                                                            ) {
                                                                return (object) [
                                                                    'id' => old('sub_section_id')[$index] ?? null,
                                                                    'icon' => old('section_icon')[$index],
                                                                    'title' => old('section_sub_title')[$index],
                                                                    'description' => old('section_description')[$index],
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($section) && $section->subSection->count()
                                                                    ? $section->subSection
                                                                    : collect([
                                                                        (object) [
                                                                            'id' => null,
                                                                            'icon' => '',
                                                                            'title' => '',
                                                                            'description' => '',
                                                                        ],
                                                                    ]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_section_id[]"
                                                                value="{{ $row->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="section_icon[]"
                                                                            value="{{ $row->icon }}"
                                                                            class="form-control {{ $errors->has('section_icon.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('section_icon.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_icon.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Sub Title</label>
                                                                        <input type="text" name="section_sub_title[]"
                                                                            value="{{ $row->title }}"
                                                                            class="form-control {{ $errors->has('section_sub_title.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('section_sub_title.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_sub_title.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="section_description[]"
                                                                            class="form-control {{ $errors->has('section_description.' . $index) ? 'is-invalid' : '' }}" rows="2">{{ $row->description }}</textarea>

                                                                        @if ($errors->has('section_description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_description.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>

                                                <button type="button" id="section_addRow" class="btn btn-primary mb-3">
                                                    + Add Row
                                                </button>

                                                <div class="form-group">
                                                    <button class=" btn btn-success min-w-200 " type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add future service inputs here -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        function previewSingleBox(input) {
            if (!input.files || !input.files[0]) {
                return;
            }

            const formGroup = input.closest('.form-group');
            const imageBox = formGroup ? formGroup.querySelector('.image-box') : null;
            const preview = imageBox ? imageBox.querySelector('img') : null;
            const placeholder = imageBox ? imageBox.querySelector('.triangle-placeholder') : null;

            if (!preview) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block';

                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        function previewDynamicRowImage(input) {
            if (!input.files || !input.files[0]) {
                return;
            }

            const row = input.closest('.feature-row');
            const preview = row ? row.querySelector('.image-preview') : null;
            const placeholder = row ? row.querySelector('.triangle-placeholder') : null;

            if (!preview) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block';

                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        function bindAddRow(buttonId, wrapperId, html) {
            const button = document.getElementById(buttonId);
            const wrapper = document.getElementById(wrapperId);

            if (!button || !wrapper) {
                return;
            }

            button.addEventListener('click', function() {
                wrapper.insertAdjacentHTML('beforeend', html);
            });
        }

        function initAboutTabs() {
            const menu = document.getElementById('aboutMenu');
            const content = document.querySelector('.about-tab-content');

            if (!menu || !content) {
                return;
            }

            const links = Array.from(menu.querySelectorAll('a[href^="#"]'));
            const panes = Array.from(content.querySelectorAll('.tab-pane'));
            const activeTabInputs = Array.from(document.querySelectorAll('input[name="active_tab"]'));
            const storageKey = 'aboutCmsActiveTab';

            const setTabState = function(tabKey, persistState = true) {
                const pane = document.getElementById(tabKey);
                const link = menu.querySelector(`a[href="#${tabKey}"]`);

                if (!pane || !link) {
                    return;
                }

                links.forEach(function(item) {
                    item.classList.toggle('active', item === link);
                });

                panes.forEach(function(item) {
                    const isActive = item === pane;
                    item.classList.toggle('show', isActive);
                    item.classList.toggle('active', isActive);
                });

                activeTabInputs.forEach(function(input) {
                    input.value = tabKey;
                });

                if (!persistState) {
                    return;
                }

                try {
                    window.localStorage.setItem(storageKey, tabKey);
                } catch (error) {
                    console.warn('Unable to store active About tab.', error);
                }

                const nextUrl = `${window.location.pathname}${window.location.search}#${tabKey}`;

                if (window.history && window.history.replaceState) {
                    window.history.replaceState(null, '', nextUrl);
                } else {
                    window.location.hash = tabKey;
                }
            };

            links.forEach(function(link) {
                link.removeAttribute('data-bs-toggle');
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const tabKey = this.getAttribute('href').replace('#', '');
                    setTabState(tabKey);
                });
            });

            let initialTab = window.location.hash ? window.location.hash.replace('#', '') : '';

            if (!initialTab) {
                try {
                    initialTab = window.localStorage.getItem(storageKey) || '';
                } catch (error) {
                    initialTab = '';
                }
            }

            if (!initialTab) {
                const serverActiveLink = menu.querySelector('.list-group-item.active');
                initialTab = serverActiveLink ? serverActiveLink.getAttribute('href').replace('#', '') : '';
            }

            if (!initialTab && links.length) {
                initialTab = links[0].getAttribute('href').replace('#', '');
            }

            if (initialTab) {
                setTabState(initialTab, false);
            }
        }

        window.previewImage = previewSingleBox;
        window.logopreviewImage = previewSingleBox;

        document.addEventListener('DOMContentLoaded', function() {
            const editorElement = document.querySelector('#editor');

            if (editorElement && window.ClassicEditor) {
                ClassicEditor
                    .create(editorElement)
                    .catch(function(error) {
                        console.error(error);
                    });
            }

            initAboutTabs();

            bindAddRow('addRow', 'feature-wrapper', `
                <div class="feature-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Icon</label>
                                <input type="text" name="feature_icon[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Name</label>
                                <input type="text" name="name[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="feature_description[]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                        Remove
                    </button>
                </div>
            `);

            bindAddRow('mid_addRow', 'feature-wrappers', `
                <div class="feature-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Icon</label>
                                <input type="text" name="icon[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Title</label>
                                <input type="text" name="sub_title[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description[]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required">Image</label>

                                <div class="image-box image-trigger" style="cursor:pointer;">
                                    <div class="triangle-placeholder"></div>
                                    <img class="image-preview" style="display:none; width:200px;">
                                </div>

                                <input type="file" name="images[]" accept="image/*" class="d-none image-input">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                        Remove
                    </button>
                </div>
            `);

            bindAddRow('section_addRow', 'feature-wrapperss', `
                <div class="feature-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Icon</label>
                                <input type="text" name="section_icon[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Title</label>
                                <input type="text" name="section_sub_title[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="section_description[]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                        Remove
                    </button>
                </div>
            `);

            document.addEventListener('click', function(event) {
                const imageTrigger = event.target.closest('.image-trigger');

                if (imageTrigger) {
                    const row = imageTrigger.closest('.feature-row');
                    const input = row ? row.querySelector('.image-input') : null;

                    if (input) {
                        input.click();
                    }
                }

                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('.feature-row');

                    if (row) {
                        row.remove();
                    }
                }
            });

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('image-input')) {
                    previewDynamicRowImage(event.target);
                }
            });
        });
    </script>
@endsection
