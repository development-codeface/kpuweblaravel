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

        .spaciality-feature-row {
            border: 1px solid #d9d9d9;
            border-radius: 8px;
            background: #fbfbfb;
        }

        .spaciality-feature-row .image-box {
            width: 100%;
            max-width: 220px;
            height: 200px;
        }

        .section-title {
            margin-bottom: 0.35rem;
        }

        .section-copy {
            margin-bottom: 1.5rem;
            color: #6c757d;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} {{ trans('cruds.spaciality.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#bannerSection" role="tab">
                            Specialities banner
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'contentSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#contentSection" role="tab">
                            Specialities content
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'blogSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#blogSection" role="tab">
                            Specialities Blog
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'featureSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#featureSection" role="tab">
                            Specialities Core Values
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
                                    <form method="POST" action="{{ route('admin.Specialities.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.spaciality.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title" value="{{ old('title', $banner->title ?? '') }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.spaciality.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.spaciality.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text', $banner->button_text ?? '') }}"
                                                        placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.spaciality.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="text">{{ trans('cruds.spaciality.fields.text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}"
                                                        type="text" name="text" placeholder="Enter Text"
                                                        id="text" value="{{ old('text', $banner->text ?? '') }}">
                                                    @if ($errors->has('text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.spaciality.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="banner_description">
                                                        {{ trans('cruds.spaciality.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('banner_description') ? 'is-invalid' : '' }}" name="banner_description"
                                                        id="banner_description" rows="2">{{ old('banner_description', $banner->description ?? '') }}</textarea>

                                                    @if ($errors->has('banner_description'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('banner_description') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required">Image</label>
                                                    <div class="image-box"
                                                        onclick="document.getElementById('image').click();">

                                                        @if (isset($banner) && $banner->image)
                                                            <img src="{{ asset($banner->image) }}" id="imagePreview"
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

                            <form method="POST" action="{{ route('admin.Specialities.content.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="active_tab" value="contentSection">
                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                <input type="hidden" name="content_id" value="{{ $content->id ?? '' }}">

                                <!-- Title -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Title</label>
                                            <input type="text" name="title"
                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                value="{{ old('title', $content->title ?? '') }}"
                                                placeholder="Enter title">

                                            @if ($errors->has('title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Sub Title -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Sub Title</label>
                                            <input type="text" name="sub_title"
                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                value="{{ old('sub_title', $content->sub_title ?? '') }}"
                                                placeholder="Enter sub title">

                                            @if ($errors->has('sub_title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('sub_title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Image</label>

                                            <div class="image-box text-center p-3 border" style="cursor:pointer;"
                                                onclick="document.getElementById('imageInput').click();">

                                                @if (isset($content) && $content->image)
                                                    <img src="{{ asset($content->image) }}" id="imagePreview"
                                                        style="max-width:100%;">
                                                @else
                                                    <div id="placeholder">
                                                        <i class="fas fa-image fa-3x text-muted"></i>
                                                        <p class="text-muted">Click to upload image</p>
                                                    </div>
                                                    <img id="imagePreview" style="display:none; max-width:100%;">
                                                @endif
                                            </div>

                                            <input type="file" name="images" id="imageInput"
                                                class="d-none {{ $errors->has('images') ? 'is-invalid' : '' }}"
                                                accept="image/*" onchange="previewImage(this)">

                                            @if ($errors->has('images'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('images') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Content Rows -->
                                <div id="content-wrapper">

                                    @php
                                        $oldHeadings = old('heading');
                                        $oldDescriptions = old('description');
                                        $oldIds = old('sub_content_id');
                                        $dbContents =
                                            isset($content) && $content->subContents
                                                ? $content->subContents
                                                : collect();
                                    @endphp

                                    @if (is_array($oldHeadings))
                                        @foreach ($oldHeadings as $index => $value)
                                            <div class="feature-row border p-3 mb-3 position-relative">

                                                <input type="hidden" name="sub_content_id[]"
                                                    value="{{ $oldIds[$index] ?? '' }}">

                                                <div class="form-group">
                                                    <label class="required">Heading</label>
                                                    <input type="text" name="heading[]"
                                                        value="{{ old('heading.' . $index) }}"
                                                        class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                                    @if ($errors->has('heading.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('heading.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="description[]" rows="3"
                                                        class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}">{{ old('description.' . $index) }}</textarea>

                                                    @if ($errors->has('description.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('description.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        @endforeach
                                    @elseif(isset($content) && $dbContents->count())
                                        @foreach ($dbContents as $sub)
                                            <div class="feature-row border p-3 mb-3">
                                                <input type="hidden" name="sub_content_id[]"
                                                    value="{{ $sub->id }}">

                                                <div class="form-group">
                                                    <label class="required">Heading</label>
                                                    <input type="text" name="heading[]" value="{{ $sub->heading }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="description[]" rows="3" class="form-control">{{ $sub->description }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="feature-row border p-3 mb-3">
                                            <input type="hidden" name="sub_content_id[]" value="">

                                            <div class="form-group">
                                                <label class="required">Heading</label>
                                                <input type="text" name="heading[]" class="form-control">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label class="required">Description</label>
                                                <textarea name="description[]" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <!-- Add Row Button -->
                                <button type="button" id="addContentRow" class="btn btn-primary mb-3">
                                    + Add Row
                                </button>

                                <!-- Submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'blogSection' ? 'show active' : '' }}"
                            id="blogSection" role="tabpanel">

                            <form method="POST" action="{{ route('admin.Specialities.blog.store') }}">
                                @csrf
                                <input type="hidden" name="active_tab" value="blogSection">
                                <input type="hidden" name="pages_id" value="{{ $id }}">

                                <div id="blog-wrapper">

                                    @php
                                        $oldIcons = old('icon');
                                        $oldTitles = old('blog_title');
                                        $oldDescriptions = old('blog_description');
                                        $oldIds = old('blog_id');
                                        $dbBlogs = isset($blog) ? $blog : collect();
                                    @endphp


                                    {{-- 1️⃣ Validation Error Case --}}
                                    @if (is_array($oldTitles))
                                        @foreach ($oldTitles as $index => $value)
                                            <div class="blog-row border p-3 mb-3 position-relative">

                                                <input type="hidden" name="blog_id[]"
                                                    value="{{ $oldIds[$index] ?? '' }}">

                                                <!-- Icon -->
                                                <div class="form-group">
                                                    <label class="required">Icon</label>
                                                    <input type="text" name="icon[]"
                                                        value="{{ old('icon.' . $index) }}"
                                                        placeholder="Enter icon class (example: fa fa-user)"
                                                        class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                                    @if ($errors->has('icon.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('icon.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Title -->
                                                <div class="form-group mt-2">
                                                    <label class="required">Title</label>
                                                    <input type="text" name="blog_title[]"
                                                        value="{{ old('blog_title.' . $index) }}"
                                                        class="form-control {{ $errors->has('blog_title.' . $index) ? 'is-invalid' : '' }}">

                                                    @if ($errors->has('blog_title.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('blog_title.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Description -->
                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="blog_description[]" rows="3"
                                                        class="form-control {{ $errors->has('blog_description.' . $index) ? 'is-invalid' : '' }}">{{ old('blog_description.' . $index) }}</textarea>

                                                    @if ($errors->has('blog_description.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('blog_description.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        @endforeach


                                        {{-- 2️⃣ Edit Mode --}}
                                    @elseif(isset($blog) && $dbBlogs->count())
                                        @foreach ($dbBlogs as $item)
                                            <div class="blog-row border p-3 mb-3">

                                                <input type="hidden" name="blog_id[]" value="{{ $item->id }}">

                                                <!-- Icon -->
                                                <div class="form-group">
                                                    <label class="required">Icon</label>
                                                    <input type="text" name="icon[]" value="{{ $item->icon }}"
                                                        placeholder="Enter icon class" class="form-control">
                                                </div>

                                                <!-- Title -->
                                                <div class="form-group mt-2">
                                                    <label class="required">Title</label>
                                                    <input type="text" name="blog_title[]"
                                                        value="{{ $item->title }}" class="form-control">
                                                </div>

                                                <!-- Description -->
                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="blog_description[]" rows="3" class="form-control">{{ $item->description }}</textarea>
                                                </div>

                                            </div>
                                        @endforeach


                                        {{-- 3️⃣ First Create --}}
                                    @else
                                        <div class="blog-row border p-3 mb-3">

                                            <input type="hidden" name="blog_id[]" value="">

                                            <div class="form-group">
                                                <label class="required">Icon</label>
                                                <input type="text" name="icon[]" placeholder="Enter icon class"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label class="required">Title</label>
                                                <input type="text" name="blog_title[]" class="form-control">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label class="required">Description</label>
                                                <textarea name="blog_description[]" rows="3" class="form-control"></textarea>
                                            </div>

                                        </div>
                                    @endif

                                </div>


                                <!-- Add Row Button -->
                                <button type="button" id="addBlogRow" class="btn btn-primary mb-3">
                                    + Add Row
                                </button>

                                <!-- Submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'featureSection' ? 'show active' : '' }}"
                            id="featureSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="section-title">Core Values</h1>
                                    <p class="section-copy">This matches the Home core values form with repeatable icon,
                                        name, and description rows.</p>

                                    <form method="POST" action="{{ route('admin.Specialities.feature.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="featureSection">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="feature_id" value="{{ $feature->id ?? '' }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required">Title</label>
                                                    <input type="text" name="feature_title"
                                                        value="{{ old('feature_title', $feature->title ?? '') }}"
                                                        class="form-control {{ $errors->has('feature_title') ? 'is-invalid' : '' }}"
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
                                                    <label class="required">Sub Title</label>
                                                    <input type="text" name="feature_sub_title"
                                                        value="{{ old('feature_sub_title', $feature->sub_title ?? '') }}"
                                                        class="form-control {{ $errors->has('feature_sub_title') ? 'is-invalid' : '' }}"
                                                        placeholder="Enter sub title">
                                                    @if ($errors->has('feature_sub_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('feature_sub_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div id="spaciality-feature-wrapper">
                                            @php
                                                $oldNames = old('names', []);
                                                $oldContentIds = old('content_id', []);
                                                $oldDescriptions = old('feature_description', []);
                                                $existingIcons = old('existing_feature_icon', []);

                                                if (is_array($oldNames) && count($oldNames)) {
                                                    $featureRows = collect($oldNames)->map(function ($name, $index) use ($existingIcons, $oldContentIds, $oldDescriptions) {
                                                        return (object) [
                                                            'id' => $oldContentIds[$index] ?? null,
                                                            'icon' => $existingIcons[$index] ?? '',
                                                            'name' => $name ?? '',
                                                            'description' => $oldDescriptions[$index] ?? '',
                                                        ];
                                                    });
                                                } else {
                                                    $featureRows =
                                                        isset($feature) && $feature->featureContents->count()
                                                            ? $feature->featureContents
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

                                            @foreach ($featureRows as $index => $row)
                                                <div class="spaciality-feature-row p-3 mb-3">
                                                    <input type="hidden" name="content_id[]"
                                                        value="{{ $row->id ?? '' }}">
                                                    <input type="hidden" name="existing_feature_icon[]"
                                                        value="{{ $row->icon ?? '' }}">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required">Icon</label>
                                                                <div class="image-box spaciality-feature-image-trigger">
                                                                    @if (!empty($row->icon))
                                                                        <img src="{{ asset($row->icon) }}"
                                                                            class="image-preview"
                                                                            style="display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"></div>
                                                                        <img class="image-preview"
                                                                            style="display:none;">
                                                                    @endif
                                                                </div>
                                                                <input type="file" name="feature_icon[]"
                                                                    accept="image/*"
                                                                    class="d-none spaciality-feature-image-input {{ $errors->has('feature_icon.' . $index) ? 'is-invalid' : '' }}">
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
                                                                    class="form-control {{ $errors->has('feature_description.' . $index) ? 'is-invalid' : '' }}"
                                                                    rows="2">{{ $row->description ?? '' }}</textarea>
                                                                @if ($errors->has('feature_description.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('feature_description.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm spaciality-feature-remove-row">
                                                        Remove
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <button type="button" id="addSpacialityFeatureRow"
                                            class="btn btn-primary mb-3">
                                            + Add Row
                                        </button>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success min-w-200">
                                                Save
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

        function previewcontentImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('image-Preview');
                    const triangle = document.getElementById('triangle-Placeholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewSpacialityFeatureImage(input) {
            if (!input.files || !input.files[0]) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                const row = input.closest('.spaciality-feature-row');

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


        document.getElementById('addContentRow').addEventListener('click', function() {

            let wrapper = document.getElementById('content-wrapper');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="form-group">
            <label>Heading</label>
            <input type="text" name="heading[]" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label>Description</label>
            <textarea class="form-control" name="description[]" rows="3"></textarea>
        </div>
        <button type="button"
                class="btn btn-danger btn-sm remove-row">
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


        document.getElementById('addBlogRow').addEventListener('click', function() {

            let wrapper = document.getElementById('blog-wrapper');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="form-group">
                           <label class="required">Icon</label>
                <input type="text" name="icon[]" class="form-control" placeholder="Enter icon class">
        </div>
        <div class="form-group mt-2">
              <label class="required">Title</label>
                <input type="text" name="blog_title[]" class="form-control">
        </div>
        <div class="form-group mt-2">
                          <label class="required">Description</label>
                <textarea name="blog_description[]" rows="3" class="form-control"></textarea>
        </div>
        <button type="button"
                class="btn btn-danger btn-sm remove-row">
            Remove
        </button>
    </div>
    `;
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        document.getElementById('addSpacialityFeatureRow').addEventListener('click', function() {
            let wrapper = document.getElementById('spaciality-feature-wrapper');

            let html = `
    <div class="spaciality-feature-row p-3 mb-3">
        <input type="hidden" name="content_id[]" value="">
        <input type="hidden" name="existing_feature_icon[]" value="">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required">Icon</label>
                    <div class="image-box spaciality-feature-image-trigger">
                        <div class="triangle-placeholder"></div>
                        <img class="image-preview" style="display:none;">
                    </div>
                    <input type="file" name="feature_icon[]" accept="image/*"
                        class="d-none spaciality-feature-image-input">
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
                    <textarea name="feature_description[]" rows="2" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger btn-sm spaciality-feature-remove-row">
            Remove
        </button>
    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });


        document.addEventListener('click', function(e) {
            if (e.target.closest('.spaciality-feature-image-trigger')) {
                let row = e.target.closest('.spaciality-feature-row');
                let input = row ? row.querySelector('.spaciality-feature-image-input') : null;

                if (input) {
                    input.click();
                }

                return;
            }

            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }

            if (e.target.classList.contains('spaciality-feature-remove-row')) {
                e.target.closest('.spaciality-feature-row').remove();
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('spaciality-feature-image-input')) {
                previewSpacialityFeatureImage(e.target);
            }
        });
    </script>
@endsection
