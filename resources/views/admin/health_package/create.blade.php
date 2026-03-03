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
                {{ trans('global.create') }} {{ trans('cruds.health_package.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            package 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            package 2
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            Pharmacy 3
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
                                    <form method="POST" action="{{ route('admin.health_packages.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.health_package.fields.title') }}</label>
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
                                                        class="help-block">{{ trans('cruds.health_package.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.health_package.fields.button_text') }}</label>
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
                                                        class="help-block">{{ trans('cruds.health_package.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="description">
                                                        {{ trans('cruds.health_package.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="2">{{ old('description', $banner->description ?? '') }}</textarea>

                                                    @if ($errors->has('description'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('description') }}
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
                        <div class="tab-pane fade" id="contentSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST"
                                                action="{{ route('admin.health_packages.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="content_id" value="{{ $content->id ?? ''}}">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.health_package.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $content->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.health_package.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.health_package.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title" id="sub_title"
                                                                value="{{ old('sub_title', $content->sub_title ?? '') }}"
                                                                placeholder="Enter Sub title">
                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.health_package.fields.name_helper') }}</span>
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
                        <div class="tab-pane fade" id="mid_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Blog</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.health_packages.blog.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="content-wrapper">
                                                    @php
                                                        if (old('blog_title')) {
                                                            $rows = collect(old('blog_title'))->map(function (
                                                                $item,
                                                                $index,
                                                            ) {
                                                                return (object) [
                                                                    'id' => old('blog_id')[$index] ?? null,
                                                                    'category_id' => old('category_id')[$index] ?? null, // ✅ added
                                                                    'title' => old('blog_title')[$index] ?? '',
                                                                    'sub_title' => old('sub_titles')[$index] ?? '',
                                                                    'name' => old('name')[$index] ?? '',
                                                                    'designation' => old('designation')[$index] ?? '',
                                                                    'image' => null,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($blog) && $blog->count()
                                                                    ? $blog
                                                                    : collect([
                                                                        (object) [
                                                                            'id' => null,
                                                                            'category_id' => null,
                                                                            'title' => '',
                                                                            'sub_title' => '',
                                                                            'name' => '',
                                                                            'designation' => '',
                                                                            'image' => null,
                                                                        ],
                                                                    ]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="blog_id[]"
                                                                value="{{ $row->id ?? '' }}">
                                                            {{-- TITLE --}}
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required" for="category">
                                                                            {{ trans('cruds.health_package.fields.category') }}
                                                                        </label>

                                                                        <select name="category_id[]"
                                                                            class="form-control {{ $errors->has('category_id.' . $index) ? 'is-invalid' : '' }}">

                                                                            <option value="">Select Category</option>

                                                                            @foreach ($category as $cat)
                                                                                <option value="{{ $cat->id }}"
                                                                                    {{ old('category_id.' . $index, $row->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                                                                    {{ $cat->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('category_id.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('category_id.' . $index) }}
                                                                            </div>
                                                                        @endif

                                                                        <span class="help-block">
                                                                            {{ trans('cruds.health_package.fields.name_helper') }}
                                                                        </span>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="form-group">
                                                                <label class="required">Title</label>
                                                                <input type="text" name="blog_title[]"
                                                                    value="{{ old('blog_title.' . $index, $row->title ?? '') }}"
                                                                    class="form-control {{ $errors->has('blog_title.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('blog_title.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('blog_title.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            {{-- SUB TITLE --}}
                                                            <div class="form-group mt-2">
                                                                <label class="required">Sub Title</label>
                                                                <input type="text" name="sub_titles[]"
                                                                    value="{{ old('sub_titles.' . $index, $row->sub_title ?? '') }}"
                                                                    class="form-control {{ $errors->has('sub_titles.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('sub_titles.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('sub_titles.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            {{-- NAME --}}
                                                            <div class="form-group mt-2">
                                                                <label class="required">Name</label>
                                                                <input type="text" name="name[]"
                                                                    value="{{ old('name.' . $index, $row->name ?? '') }}"
                                                                    class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('name.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('name.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            {{-- DESIGNATION --}}
                                                            <div class="form-group mt-2">
                                                                <label class="required">Designation</label>
                                                                <input type="text" name="designation[]"
                                                                    value="{{ old('designation.' . $index, $row->designation ?? '') }}"
                                                                    class="form-control {{ $errors->has('designation.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('designation.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('designation.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Image</label>

                                                                        <div class="image-box image-trigger"
                                                                            style="cursor:pointer;">

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

                                                                        <input type="file" name="image[]"
                                                                            accept="image/*"
                                                                            class="d-none image-input {{ $errors->has('image.' . $index) ? 'is-invalid' : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" id="addContentRow" class="btn btn-primary mb-3">
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

        const categories = @json($category);
        document.getElementById('addContentRow').addEventListener('click', function() {

            let wrapper = document.getElementById('content-wrapper');

            let categoryOptions = `<option value="">Select Category</option>`;

            categories.forEach(function(cat) {
                categoryOptions += `<option value="${cat.id}">${cat.name}</option>`;
            });

            let html = `
    <div class="feature-row border p-3 mb-3">
        <input type="hidden" name="blog_id[]" value="">

        <div class="form-group">
            <label class="required">Category</label>
            <select name="category_id[]" class="form-control">
                ${categoryOptions}
            </select>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title[]" class="form-control">
        </div>

        <div class="form-group">
            <label>Sub Title</label>
            <input type="text" name="sub_title[]" class="form-control">
        </div>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name[]" class="form-control">
        </div>
           <div class="form-group">
            <label>Designation</label>
            <input type="text" name="designation[]" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Image</label>
            <div class="image-box image-trigger" style="cursor:pointer;">
                <div class="triangle-placeholder"></div>
                <img class="image-preview" style="display:none; width:200px;">
            </div>
            <input type="file" name="image[]"
                   accept="image/*"
                   class="d-none image-input">
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


        // ✅ Image preview (works for all rows)
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('image-input')) {

                let file = e.target.files[0];
                let row = e.target.closest('.feature-row');
                let preview = row.querySelector('.image-preview');

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
