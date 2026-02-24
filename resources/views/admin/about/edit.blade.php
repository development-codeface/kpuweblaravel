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
    </style>
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ __('Edit') }}{{ trans('cruds.about.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            About 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#blogSection"
                            role="tab">
                            About 2
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            About 3
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#featureSection"
                            role="tab">
                            About 4
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#sub_content_Section"
                            role="tab">
                            About 5
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            About 6
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#sections"
                            role="tab">
                            About 7
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#blog_sections"
                            role="tab">
                            About 8
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">

                        <!-- ================= Banner Section ================= -->
                        <div class="tab-pane fade show active" id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Banner Section</h1>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.about.banner.update', $id) }}"
                                        enctype="multipart/form-data">
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
                                                        id="title" value="{{ old('title', $edit_banner->title) }}">
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
                                                        value="{{ old('button_text', $edit_banner->button_text) }}"
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
                        <div class="tab-pane fade" id="blogSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Blogs</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.about.blog.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
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
                                                                value="{{ old('heading', $edit_blog->heading) }}">
                                                            @if ($errors->has('heading'))
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
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="Blog_title" id="Blog_title"
                                                                value="{{ old('Blog_title', $edit_blog->title) }}"
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
                                                                @if (isset($edit_blog->image))
                                                                    <img id="imagePreview"
                                                                        src="{{ asset($edit_blog->image) }}"
                                                                        style="display:block; width:100%; height:100%; object-fit:cover;">
                                                                    <div class="triangle-placeholder"
                                                                        id="trianglePlaceholder" style="display:none;">
                                                                    </div>
                                                                @else
                                                                    <div class="triangle-placeholder"
                                                                        id="trianglePlaceholder"></div>
                                                                    <img id="imagePreview"
                                                                        style="display:none; width:100%; height:100%; object-fit:cover;">
                                                                @endif
                                                            </div>

                                                            <input type="file" name="Blog_image" id="Blog_image"
                                                                accept="image/*"
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
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_heading">{{ trans('cruds.about.fields.sub-heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_heading') ? 'is-invalid' : '' }}"
                                                                type="sub-heading" name="sub_heading"
                                                                placeholder="Enter Sub heading" id="heading"
                                                                value="{{ old('sub_heading', $edit_blog->sub_heading) }}">
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

                                                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                id="description" rows="5" placeholder="Enter description">{{ old('description', $edit_blog->description) }}</textarea>

                                                            @if ($errors->has('description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('description') }}
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
                                                                for="icon">{{ trans('cruds.about.fields.icon') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                                                                type="text" name="icon" placeholder="Enter icon"
                                                                id="icon"
                                                                value="{{ old('icon', $edit_blog->icon) }}">
                                                            @if ($errors->has('icon'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('icon') }}
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
                                                                value="{{ old('sub_heading_two', $edit_blog->icon_heading) }}">
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
                                                                id="description" rows="5" placeholder="Enter description">{{ old('sub_description', $edit_blog->icon_description) }}</textarea>

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
                        <div class="tab-pane fade" id="contentSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.about.content.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
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
                                                                value="{{ old('content_heading', $edit_content->heading) }}">
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
                                                                @if (!empty($edit_content?->logo_image))
                                                                    <img id="logo_imagePreview"
                                                                        src="{{ asset($edit_content->logo_image) }}"
                                                                        style="display:block; width:100%; height:100%; object-fit:cover;">

                                                                    <div class="triangle-placeholder"
                                                                        id="logo_trianglePlaceholder"
                                                                        style="display:none;">
                                                                    </div>
                                                                @else
                                                                    <div class="triangle-placeholder"
                                                                        id="logo_trianglePlaceholder"></div>

                                                                    <img id="logo_imagePreview"
                                                                        style="display:none; width:100%; height:100%; object-fit:cover;">
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

                                                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                id="editor" rows="6">{{ old('description', $edit_content->content) }}</textarea>

                                                            @if ($errors->has('description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('description') }}
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

                        <div class="tab-pane fade" id="featureSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Feature</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.about.feature.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="about_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.feature.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $about_feature->title) }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title" id="sub_title"
                                                                value="{{ old('sub_title', $about_feature->sub_title) }}"
                                                                placeholder="Enter Sub title">
                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapper">

                                                    @php
                                                        $oldIcons = old('icon');
                                                        $features =
                                                            $about_feature && $about_feature->featureContents->count()
                                                                ? $about_feature->featureContents
                                                                : collect([null]);
                                                    @endphp

                                                    @foreach ($features as $index => $feature)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="content_id[]"
                                                                value="{{ $feature->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icon[]"
                                                                            value="{{ old('icon.' . $index, $feature->icon ?? '') }}"
                                                                            class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                                                        @error('icon.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Name</label>
                                                                        <input type="text" name="name[]"
                                                                            value="{{ old('name.' . $index, $feature->name ?? '') }}"
                                                                            class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                        @error('name.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="description[]" rows="2"
                                                                            class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}">{{ old('description.' . $index, $feature->description ?? '') }}</textarea>

                                                                        @error('description.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
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

                        <div class="tab-pane fade" id="sub_content_Section" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Sub Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST"
                                                action="{{ route('admin.about.sub_content.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
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
                                                                value="{{ old('title', $sub_content->title) }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_content_title') }}
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
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title"
                                                                placeholder="Enter Sub title" id="sub_title"
                                                                value="{{ old('sub_title', $sub_content->sub_title) }}">
                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
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
                                                                <label class="required" for="description">
                                                                    {{ trans('cruds.about.fields.description') }}
                                                                </label>

                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" rows="5" placeholder="Enter description">{{ old('description', $sub_content->description) }}</textarea>

                                                                @if ($errors->has('description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('description') }}
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

                        <div class="tab-pane fade" id="mid_content_Section" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Mid Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST"
                                                action="{{ route('admin.about.mid_content.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
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
                                                                value="{{ old('title', $mid_content->title) }}">
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
                                                        $midContent = $mid_content ?? null;

                                                        $subContents = old('icon')
                                                            ? collect(old('icon'))->map(function ($icon, $index) {
                                                                return (object) [
                                                                    'icon' => $icon,
                                                                    'sub_title' => old('sub_title')[$index] ?? '',
                                                                    'description' => old('description')[$index] ?? '',
                                                                    'image' => null,
                                                                ];
                                                            })
                                                            : ($midContent && $midContent->aboutMidSubContent->count()
                                                                ? $midContent->aboutMidSubContent
                                                                : collect([null]));
                                                    @endphp

                                                    @foreach ($subContents as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="mid_content_id[]"
                                                                value="{{ $row->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icons[]"
                                                                            value="{{ old('icons.' . $index, $row->icon ?? '') }}"
                                                                            class="form-control {{ $errors->has('icons.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('icons.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Title</label>
                                                                        <input type="text" name="sub_titles[]"
                                                                            value="{{ old('sub_titles.' . $index, $row->title ?? '') }}"
                                                                            class="form-control {{ $errors->has('sub_titles.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('sub_titles.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="descriptions[]" rows="2"
                                                                            class="form-control {{ $errors->has('descriptions.' . $index) ? 'is-invalid' : '' }}">{{ old('descriptions.' . $index, $row->description ?? '') }}</textarea>
                                                                        @error('descriptions.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Image</label>

                                                                        <div class="image-box image-trigger">
                                                                            <div class="triangle-placeholder"
                                                                                style="{{ !empty($row->image) ? 'display:none;' : '' }}">
                                                                            </div>

                                                                            @if (!empty($row->image))
                                                                                <img src="{{ asset($row->image) }}"
                                                                                    class="image-preview"
                                                                                    style="width:200px;">
                                                                            @else
                                                                                <img class="image-preview"
                                                                                    style="display:none; width:200px;">
                                                                            @endif
                                                                        </div>

                                                                        <input type="file" name="images[]"
                                                                            accept="image/*" class="d-none image-input">
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

                        <div class="tab-pane fade" id="sections" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Sections</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.about.section.update',$id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
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
                                                                value="{{ old('heading', $section->heading) }}">
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
                                                                value="{{ old('title', $section->title) }}">
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
                                                        $subSections = old('icon')
                                                            ? collect(old('icon'))->map(function ($icon, $index) {
                                                                return [
                                                                    'icon' => $icon,
                                                                    'sub_title' => old('sub_title')[$index] ?? '',
                                                                    'description' => old('description')[$index] ?? '',
                                                                ];
                                                            })
                                                            : $section->subSection ?? collect();
                                                    @endphp

                                                    @foreach ($subSections as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <input type="hidden" name="sub_section_id[]"
                                                                value="{{ is_object($row) ? $row->id : '' }}">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icon[]"
                                                                            value="{{ is_object($row) ? $row->icon : $row['icon'] }}"
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
                                                                        <label class="required">Sub Title</label>
                                                                        <input type="text" name="sub_title[]"
                                                                            value="{{ is_object($row) ? $row->title : $row['title']}}"
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
                                                                            rows="2">{{ is_object($row) ? $row->description : $row['description'] }}</textarea>

                                                                        @if ($errors->has('description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('description.' . $index) }}
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

                        <div class="tab-pane fade" id="blog_sections" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Blog Sections</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.feature.store') }}"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="content_heading">{{ trans('cruds.about.fields.heading') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('blog_content_section') ? 'is-invalid' : '' }}"
                                                                type="text" name="blog_content_section"
                                                                placeholder="Enter heading" id=""
                                                                value="{{ old('blog_content_section', '') }}">
                                                            @if ($errors->has('blog_content_section'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('blog_content_section') }}
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
                                                                for="content_heading">{{ trans('cruds.about.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('blog_section_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="mid_title" placeholder="Enter Title"
                                                                id="blog_section_title"
                                                                value="{{ old('blog_section_title', '') }}">
                                                            @if ($errors->has('blog_section_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('blog_section_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapperss">

                                                    @php
                                                        $heading = is_array(old('heading')) ? old('heading') : [''];
                                                        $designation = is_array(old('designation'))
                                                            ? old('designation')
                                                            : [''];
                                                    @endphp

                                                    @foreach ($heading as $index => $icon)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Heading</label>
                                                                        <input type="text" name="sub_section_heading[]"
                                                                            value="{{ $icon }}"
                                                                            class="form-control {{ $errors->has('sub_section_heading.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('sub_section_heading.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('sub_section_heading.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Designation</label>
                                                                        <input type="text" name="designation[]"
                                                                            value="{{ $designation[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('designation.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('designation.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('designation.' . $index) }}
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
                                                                            <div class="triangle-placeholder"></div>
                                                                            <img class="image-preview"
                                                                                style="display:none; width:100px;">
                                                                        </div>

                                                                        <input type="file" name="blogs_image[]"
                                                                            accept="image/*"
                                                                            class="d-none image-input {{ $errors->has('blogs_image.' . $index) ? 'is-invalid' : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach

                                                </div>

                                                <button type="button" id="blog_addRow" class="btn btn-primary mb-3">
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
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

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


        document.getElementById('addRow').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrapper');

            let html = `
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
                    <label class="required">Name</label>
                    <input type="text" name="title[]" class="form-control">
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

            <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                Remove
            </button>
        </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });
        document.querySelector('.image-box').addEventListener('click', function(e) {
            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });

        function logopreviewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('logo_imagePreview');
                    const triangle = document.getElementById('logo_trianglePlaceholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        document.getElementById('mid_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('feature-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Icon</label>
                <input type="text" name="icons[]" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="sub_titles[]" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                  <div class="form-group">
                <label>Description</label>
                <textarea name="descriptions[]" class="form-control" rows="2"></textarea>
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
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });
        document.querySelector('.image-box').addEventListener('click', function(e) {
            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }
        });

        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('image-input')) {

                let input = e.target;
                let row = input.closest('.feature-row');
                let preview = row.querySelector('.image-preview');

                let reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }

        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });

        //section js
        document.getElementById('section_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('feature-wrapperss');

            let html = `
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

        <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
            Remove
        </button>
    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });



        //blog section js
        document.getElementById('blog_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('feature-wrapperss');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Heading</label>
                <input type="text" name="sub_section_heading[]" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">designation</label>
                <input type="text" name="designation[]" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                <label class="required">Image</label>

                <div class="image-box image-trigger" style="cursor:pointer;">
                    <div class="triangle-placeholder"></div>
                    <img class="image-preview" style="display:none; width:100px;">
                </div>

                <input type="file" name="logo_image[]" accept="image/*" class="d-none image-input">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
            Remove
        </button>
    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });
        document.addEventListener('click', function(e) {

            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }

        });

        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('image-input')) {

                let input = e.target;
                let row = input.closest('.feature-row');
                let preview = row.querySelector('.image-preview');

                let reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }

        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
