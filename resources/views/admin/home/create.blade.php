@extends('layouts.admin')
@section('content')
    <style>
        .image-box {
            width: 180px;
            height: 220px;
            border: 1px dashed #c7c7c7;
            cursor: pointer;
            position: relative;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .triangle-placeholder {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 40px solid #b5b5b5;
        }

        .image-box img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }


        #aboutMenu {
            position: sticky;
            top: 20px;
            /* distance from top */
        }

        .col-md-3 {
            align-self: flex-start;
        }

        #icuMenu {
            position: sticky;
            top: 20px;
        }

        .feature-row,
        .home-feature-row {
            border: 1px solid #d9d9d9;
            border-radius: 8px;
            background: #fbfbfb;
        }

        .feature-row .image-box,
        .home-feature-row .image-box {
            width: 100%;
            max-width: 220px;
            height: 200px;
        }

        .icu-tab-pane .section-title {
            margin-bottom: 0.35rem;
        }

        .icu-tab-pane .section-copy {
            margin-bottom: 1.5rem;
            color: #6c757d;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} Home</p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#bannerSection" role="tab">
                            home 1
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'contentSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#contentSection" role="tab">
                            home 2
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#Section" role="tab">
                            home 3
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'feature_Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#feature_Section" role="tab">
                            Core Values
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content" id="homeTabContent">
                        <!-- ================= Banner Section ================= -->
                        <div class="tab-pane fade {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'show active' : '' }}"
                            id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Banner Section</h1>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.banners.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="banner_id" value="{{ $edit_banner->id ?? '' }}">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.director.fields.title') }}</label>
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
                                                        class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.director.fields.button_text') }}</label>
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
                                                        class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required">Image</label>
                                                    <div class="image-box"
                                                        onclick="document.getElementById('image').click();">
                                                        @if (isset($edit_banner) && $edit_banner->image)
                                                            <img src="{{ asset($edit_banner->image) }}" id="imagePreview"
                                                                style="width:100%; display:block;">
                                                        @else
                                                            <div class="triangle-placeholder" id="trianglePlaceholder">
                                                            </div>
                                                            <img id="imagePreview" style="display:none;">
                                                        @endif
                                                    </div>
                                                    <input type="file" name="image" id="image" accept="image/*"
                                                        class="d-none {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                        onchange="previewImage(this)">

                                                    @if ($errors->has('image'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('image') }}
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
                        <div class="tab-pane fade {{ old('active_tab') == 'contentSection' ? 'show active' : '' }}"
                            id="contentSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="contentSection">
                                                <input type="hidden" name="content_id"
                                                    value="{{ $edit_content->id ?? '' }}">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Button Text</label>
                                                            <input
                                                                class="form-control {{ $errors->has('content_btn_text') ? 'is-invalid' : '' }}"
                                                                type="text" name="content_btn_text"
                                                                placeholder="Enter button text" id="content_btn_text"
                                                                value="{{ old('content_btn_text', $edit_content->button_text ?? '') }}">
                                                            @if ($errors->has('content_btn_text'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_btn_text') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Heading</label>
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
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Sub Heading</label>
                                                            <input
                                                                class="form-control {{ $errors->has('content_sub_heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="content_sub_heading"
                                                                placeholder="Enter heading" id="content_sub_heading"
                                                                value="{{ old('content_sub_heading', $edit_content->sub_heading ?? '') }}">
                                                            @if ($errors->has('content_sub_heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_sub_heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $contentCards = $edit_content?->subContent ?? collect();
                                                    $contentCard = $contentCards->first();
                                                    $contentImage2 =
                                                        $contentCard?->image_2 ??
                                                        optional($contentCards->get(1))->image;
                                                    $contentImage3 =
                                                        $contentCard?->image_3 ??
                                                        optional($contentCards->get(2))->image;
                                                @endphp
                                                <div class="border p-3 mb-3">
                                                    <input type="hidden" name="sub_content_id"
                                                        value="{{ old('sub_content_id', $contentCard?->id ?? '') }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required">Title</label>
                                                                <input type="text" name="content_title"
                                                                    value="{{ old('content_title', $contentCard?->title ?? '') }}"
                                                                    class="form-control {{ $errors->has('content_title') ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('content_title'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('content_title') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required">Description</label>
                                                                <textarea name="content_description"
                                                                    class="form-control {{ $errors->has('content_description') ? 'is-invalid' : '' }}" rows="4">{{ old('content_description', $contentCard?->description ?? '') }}</textarea>

                                                                @if ($errors->has('content_description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('content_description') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="required">Image 1</label>
                                                                <div class="image-box"
                                                                    onclick="document.getElementById('content_image').click();">
                                                                    @if (!empty($contentCard?->image))
                                                                        <img src="{{ asset($contentCard->image) }}"
                                                                            id="contentImagePreview"
                                                                            style="width:100%; display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"
                                                                            id="contentImagePlaceholder"></div>
                                                                        <img id="contentImagePreview"
                                                                            style="display:none;">
                                                                    @endif
                                                                </div>
                                                                <input type="file" name="content_image"
                                                                    id="content_image" accept="image/*"
                                                                    class="d-none {{ $errors->has('content_image') ? 'is-invalid' : '' }}"
                                                                    onchange="previewContentImage(this, 'contentImagePreview', 'contentImagePlaceholder')">

                                                                @if ($errors->has('content_image'))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('content_image') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Image 2</label>
                                                                <div class="image-box"
                                                                    onclick="document.getElementById('content_image_2').click();">
                                                                    @if (!empty($contentImage2))
                                                                        <img src="{{ asset($contentImage2) }}"
                                                                            id="contentImagePreview2"
                                                                            style="width:100%; display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"
                                                                            id="contentImagePlaceholder2"></div>
                                                                        <img id="contentImagePreview2"
                                                                            style="display:none;">
                                                                    @endif
                                                                </div>
                                                                <input type="file" name="content_image_2"
                                                                    id="content_image_2" accept="image/*"
                                                                    class="d-none {{ $errors->has('content_image_2') ? 'is-invalid' : '' }}"
                                                                    onchange="previewContentImage(this, 'contentImagePreview2', 'contentImagePlaceholder2')">

                                                                @if ($errors->has('content_image_2'))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('content_image_2') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Image 3</label>
                                                                <div class="image-box"
                                                                    onclick="document.getElementById('content_image_3').click();">
                                                                    @if (!empty($contentImage3))
                                                                        <img src="{{ asset($contentImage3) }}"
                                                                            id="contentImagePreview3"
                                                                            style="width:100%; display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"
                                                                            id="contentImagePlaceholder3"></div>
                                                                        <img id="contentImagePreview3"
                                                                            style="display:none;">
                                                                    @endif
                                                                </div>
                                                                <input type="file" name="content_image_3"
                                                                    id="content_image_3" accept="image/*"
                                                                    class="d-none {{ $errors->has('content_image_3') ? 'is-invalid' : '' }}"
                                                                    onchange="previewContentImage(this, 'contentImagePreview3', 'contentImagePlaceholder3')">

                                                                @if ($errors->has('content_image_3'))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('content_image_3') }}
                                                                    </div>
                                                                @endif
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
                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'Section' ? 'show active' : '' }}"
                            id="Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Section</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.section.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="Section">
                                                <input type="hidden" name="section_id"
                                                    value="{{ $edit_section->id ?? '' }}">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Heading</label>
                                                            <input
                                                                class="form-control {{ $errors->has('section_heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="section_heading"
                                                                placeholder="Enter Heading" id="section_heading"
                                                                value="{{ old('section_heading', $edit_section->heading ?? '') }}">
                                                            @if ($errors->has('section_heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('section_heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Sub Heading</label>
                                                            <input
                                                                class="form-control {{ $errors->has('section_sub_heading') ? 'is-invalid' : '' }}"
                                                                type="text" name="section_sub_heading"
                                                                placeholder="Enter sub heading" id="section_sub_heading"
                                                                value="{{ old('section_sub_heading', $edit_section->sub_heading ?? '') }}">
                                                            @if ($errors->has('section_sub_heading'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('section_sub_heading') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Title</label>
                                                            <input
                                                                class="form-control {{ $errors->has('section_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="section_title"
                                                                placeholder="Enter heading" id="section_title"
                                                                value="{{ old('section_title', $edit_section->title ?? '') }}">
                                                            @if ($errors->has('section_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('section_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="title">Sub Title</label>
                                                            <input
                                                                class="form-control {{ $errors->has('section_sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="section_sub_title"
                                                                placeholder="Enter heading" id="section_sub_title"
                                                                value="{{ old('section_sub_title', $edit_section->sub_title ?? '') }}">
                                                            @if ($errors->has('section_sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('section_sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.director.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required">Image</label>
                                                                <div class="image-box"
                                                                    onclick="document.getElementById('imagess').click();">
                                                                    @if (isset($edit_section) && $edit_section->image)
                                                                        <img src="{{ asset($edit_section->image) }}"
                                                                            id="image-preview"
                                                                            style="width:100%; display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"
                                                                            id="triangle-placeholder">
                                                                        </div>
                                                                        <img id="image-preview" style="display:none;">
                                                                    @endif
                                                                </div>
                                                                <input type="file" name="imagess" id="imagess"
                                                                    accept="image/*"
                                                                    class="d-none {{ $errors->has('imagess') ? 'is-invalid' : '' }}"
                                                                    onchange="previewsectionImage(this)">

                                                                @if ($errors->has('imagess'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('imagess') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="features-wrapper">
                                                    @php
                                                        $oldNames = old('name', []);
                                                        $oldDescriptions = old('section_description', []);
                                                        $oldSubSectionIds = old('sub_section_id', []);
                                                        $blogs = is_array($oldNames) && count($oldNames)
                                                            ? collect($oldNames)->map(function ($item, $index) use ($oldDescriptions, $oldSubSectionIds) {
                                                                return (object) [
                                                                    'name' => $item,
                                                                    'description' => $oldDescriptions[$index] ?? '',
                                                                    'image' => null,
                                                                    'id' => $oldSubSectionIds[$index] ?? null,
                                                                ];
                                                            })
                                                            : $edit_section->subContent ?? collect([null]);
                                                    @endphp
                                                    @foreach ($blogs as $index => $blog)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_section_id[]"
                                                                value="{{ $blog->id ?? '' }}">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Name</label>
                                                                        <input type="text" name="name[]"
                                                                            value="{{ old('name.' . $index, $blog->name ?? '') }}"
                                                                            class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('name.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('name.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Description</label>
                                                                        <textarea name="section_description[]"
                                                                            class="form-control {{ $errors->has('section_description.' . $index) ? 'is-invalid' : '' }}" rows="4">{{ old('section_description.' . $index, $blog->description ?? '') }}</textarea>

                                                                        @if ($errors->has('section_description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_description.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Image</label>
                                                                        <div class="image-box image-trigger"
                                                                            style="cursor:pointer;">
                                                                            @if (isset($blog) && $blog->image)
                                                                                <img src="{{ asset($blog->image) }}"
                                                                                    class="image-preview"
                                                                                    style="width:200px; display:block;">
                                                                            @else
                                                                                <div class="triangle-placeholder"></div>
                                                                                <img class="image-preview"
                                                                                    style="display:none; width:200px;">
                                                                            @endif
                                                                        </div>
                                                                        <input type="file" name="sub_section_image[]"
                                                                            accept="image/*"
                                                                            class="d-none image-input {{ $errors->has('sub_section_image.' . $index) ? 'is-invalid' : '' }}">
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm remove-row mt-2">
                                                                            Remove
                                                                        </button>

                                                                        @if ($errors->has('sub_section_image.' . $index))
                                                                            <div class="text-danger mt-1">
                                                                                {{ $errors->first('sub_section_image.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" id="addNewRow" class="btn btn-primary mb-3">
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
                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'feature_Section' ? 'show active' : '' }}"
                            id="feature_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="section-title">Core Values</h1>
                                    <p class="section-copy">This matches the About page feature form with repeatable icon,
                                        name, and description rows.</p>

                                    <form method="POST" action="{{ route('admin.features.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="feature_Section">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="feature_id" value="{{ $features->id ?? '' }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="feature_title">{{ trans('cruds.feature.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('feature_title') ? 'is-invalid' : '' }}"
                                                        type="text" name="feature_title" id="feature_title"
                                                        value="{{ old('feature_title', $features->title ?? '') }}"
                                                        placeholder="Enter title">
                                                    @if ($errors->has('feature_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('feature_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="feature_sub_title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('feature_sub_title') ? 'is-invalid' : '' }}"
                                                        type="text" name="feature_sub_title" id="feature_sub_title"
                                                        value="{{ old('feature_sub_title', $features->sub_title ?? '') }}"
                                                        placeholder="Enter sub title">
                                                    @if ($errors->has('feature_sub_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('feature_sub_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $oldNames = old('names', []);
                                            $oldContentIds = old('content_id', []);
                                            $oldDescriptions = old('feature_description', []);
                                            $existingIcons = old('existing_feature_icon', []);
                                            if (is_array($oldNames) && count($oldNames)) {
                                                $rows = collect($oldNames)->map(function ($name, $index) use (
                                                    $existingIcons,
                                                    $oldContentIds,
                                                    $oldDescriptions
                                                ) {
                                                    return (object) [
                                                        'id' => $oldContentIds[$index] ?? null,
                                                        'icon' => $existingIcons[$index] ?? '',
                                                        'name' => $name ?? '',
                                                        'description' => $oldDescriptions[$index] ?? '',
                                                    ];
                                                });
                                            } else {
                                                $rows =
                                                    isset($features) && $features->featureContents->count()
                                                        ? $features->featureContents
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

                                        <div id="featuress-wrapper">
                                                @foreach ($rows as $index => $row)
                                                <div class="home-feature-row p-3 mb-3">
                                                    <input type="hidden" name="content_id[]"
                                                        value="{{ $row->id }}">
                                                    <input type="hidden" name="existing_feature_icon[]"
                                                        value="{{ $row->icon ?? '' }}">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required">Icon</label>
                                                                <div class="image-box home-feature-image-trigger">
                                                                    @if (!empty($row->icon))
                                                                        <img src="{{ asset($row->icon) }}"
                                                                            class="image-preview" style="display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"></div>
                                                                        <img class="image-preview" style="display:none;">
                                                                    @endif
                                                                </div>

                                                                <input type="file" name="feature_icon[]"
                                                                    accept="image/*"
                                                                    class="d-none home-feature-image-input {{ $errors->has('feature_icon.' . $index) ? 'is-invalid' : '' }}">
                                                                @if ($errors->has('feature_icon.' . $index))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('feature_icon.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required">Name</label>
                                                                <input type="text" name="names[]"
                                                                    value="{{ $row->name ?? '' }}"
                                                                    class="form-control {{ $errors->has('names.' . $index) ? 'is-invalid' : '' }}">
                                                                @if ($errors->has('names.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('names.' . $index) }}
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
                                                                    class="form-control {{ $errors->has('feature_description.' . $index) ? 'is-invalid' : '' }}" rows="2">{{ $row->description ?? '' }}</textarea>
                                                                @if ($errors->has('feature_description.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('feature_description.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm home-feature-remove-row">
                                                        Remove
                                                    </button>
                                                </div>
                                                @endforeach
                                        </div>

                                        <button type="button" id="addRow" class="btn btn-primary mb-3">
                                            + Add Row
                                        </button>

                                        <div class="form-group">
                                            <button class="btn btn-success min-w-200" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    </div>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('imagePreview');
                    const triangle = document.getElementById('trianglePlaceholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewsectionImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('image-preview');
                    const triangle = document.getElementById('triangle-placeholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewContentImage(input, imageId, placeholderId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById(imageId);
                    const triangle = document.getElementById(placeholderId);

                    img.src = e.target.result;
                    img.style.display = 'block';

                    if (triangle) {
                        triangle.style.display = 'none';
                    }
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewDynamicRowImage(input, rowSelector = '.feature-row') {
            if (!input.files || !input.files[0]) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                const row = input.closest(rowSelector);

                if (!row) {
                    return;
                }

                const preview = row.querySelector('.image-preview');
                const placeholder = row.querySelector('.triangle-placeholder');

                if (preview) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                }

                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        function buildHomeFeatureRow() {
            return `
                <div class="home-feature-row p-3 mb-3">
                    <input type="hidden" name="content_id[]" value="">
                    <input type="hidden" name="existing_feature_icon[]" value="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Icon</label>
                                <div class="image-box home-feature-image-trigger">
                                    <div class="triangle-placeholder"></div>
                                    <img class="image-preview" style="display:none;">
                                </div>
                                <input type="file" name="feature_icon[]" accept="image/*"
                                    class="d-none home-feature-image-input">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Name</label>
                                <input type="text" name="names[]" class="form-control">
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

                    <button type="button" class="btn btn-danger btn-sm home-feature-remove-row">
                        Remove
                    </button>
                </div>
            `;
        }

        function initHomeTabs() {
            const menu = document.getElementById('aboutMenu') || document.getElementById('icuMenu');
            const content = document.getElementById('homeTabContent') || document.getElementById('icuTabContent');

            if (!menu || !content) {
                return;
            }

            const links = Array.from(menu.querySelectorAll('a[href^="#"]'));
            const panes = Array.from(content.querySelectorAll('.tab-pane'));
            const activeTabInputs = Array.from(document.querySelectorAll('input[name="active_tab"]'));
            const storageKey = 'homeCmsActiveTab';

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
                    console.warn('Unable to store active Home tab.', error);
                }

                const nextUrl = `${window.location.pathname}${window.location.search}#${tabKey}`;

                if (window.history && window.history.replaceState) {
                    window.history.replaceState(null, '', nextUrl);
                } else {
                    window.location.hash = tabKey;
                }
            };

            links.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    setTabState(this.getAttribute('href').replace('#', ''));
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

        document.addEventListener('DOMContentLoaded', function() {
            initHomeTabs();

            const addNewRowButton = document.getElementById('addNewRow');

            if (addNewRowButton) {
                addNewRowButton.addEventListener('click', function() {
                    const wrapper = document.getElementById('features-wrapper');

                    if (!wrapper) {
                        return;
                    }

                    const html = `
                        <div class="feature-row border p-3 mb-3">
                            <input type="hidden" name="sub_section_id[]" value="">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name[]" class="form-control">
                            </div>

                            <div class="form-group mt-2">
                                <label>Description</label>
                                <textarea name="section_description[]" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group mt-2">
                                <label>Image</label>
                                <div class="image-box image-trigger" style="cursor:pointer;">
                                    <div class="triangle-placeholder"></div>
                                    <img class="image-preview" style="display:none; width:200px;">
                                </div>
                                <input type="file" name="sub_section_image[]" accept="image/*" class="d-none image-input">
                            </div>

                            <button type="button" class="btn btn-danger btn-sm remove-row mt-2">
                                Remove
                            </button>
                        </div>
                    `;

                    wrapper.insertAdjacentHTML('beforeend', html);
                });
            }

            const featureAddRowButton = document.getElementById('addRow');
            const featureWrapper = document.getElementById('featuress-wrapper');

            if (featureAddRowButton && featureWrapper) {
                featureAddRowButton.addEventListener('click', function() {
                    featureWrapper.insertAdjacentHTML('beforeend', buildHomeFeatureRow());
                });
            }

            document.addEventListener('click', function(event) {
                const homeFeatureImageTrigger = event.target.closest('.home-feature-image-trigger');

                if (homeFeatureImageTrigger) {
                    const row = homeFeatureImageTrigger.closest('.home-feature-row');
                    const input = row ? row.querySelector('.home-feature-image-input') : null;

                    if (input) {
                        input.click();
                    }

                    return;
                }

                const imageTrigger = event.target.closest('.image-trigger');

                if (imageTrigger) {
                    const row = imageTrigger.closest('.feature-row');
                    const input = row ? row.querySelector('.image-input') : null;

                    if (input) {
                        input.click();
                    }
                }

                if (event.target.classList.contains('home-feature-remove-row')) {
                    const row = event.target.closest('.home-feature-row');

                    if (row) {
                        row.remove();
                    }

                    return;
                }

                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('.feature-row');

                    if (row) {
                        row.remove();
                    }
                }
            });

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('home-feature-image-input')) {
                    previewDynamicRowImage(event.target, '.home-feature-row');
                    return;
                }

                if (event.target.classList.contains('image-input')) {
                    previewDynamicRowImage(event.target, '.feature-row');
                }
            });
        });
    </script>
@endsection
