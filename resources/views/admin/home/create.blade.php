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
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
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
                                                    $contentImage2 = $contentCard?->image_2 ?? optional($contentCards->get(1))->image;
                                                    $contentImage3 = $contentCard?->image_3 ?? optional($contentCards->get(2))->image;
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
                                                        $blogs = old('name')
                                                            ? collect(old('name'))->map(function ($item, $index) {
                                                                return (object) [
                                                                    'name' => old('name')[$index],
                                                                    'description' => old('section_description')[$index],
                                                                    'image' => null,
                                                                    'id' => old('sub_section_id')[$index] ?? null,
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

        document.getElementById('addNewRow').addEventListener('click', function() {

            let wrapper = document.getElementById('features-wrapper');

            let html = `
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
            <input type="file" name="sub_section_image[]"
                   accept="image/*"
                   class="d-none image-input">
        </div>

        <button type="button"
                class="btn btn-danger btn-sm remove-row mt-2">
            Remove
        </button>
    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });


        // ✅ Open file picker (works for dynamic rows)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }
        });


        // ✅ Image preview (works for all rows)
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('image-input')) {

                let file = e.target.files[0];
                let row = e.target.closest('.feature-row');
                let preview = row.querySelector('.image-preview');
                let placeholder = row.querySelector('.triangle-placeholder');

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                        if (placeholder) {
                            placeholder.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        // ✅ Remove row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
