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
                {{ trans('global.create') }} {{ trans('cruds.icu.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            icu 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            icu 2
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            icu 3
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
                                    <form method="POST" action="{{ route('admin.icu.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.icu.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title" value="{{ old('title', '') }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.icu.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.icu.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text') }}" placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.icu.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="description">
                                                        {{ trans('cruds.icu.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="6">{{ old('description') }}</textarea>

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
                                                        <div class="triangle-placeholder" id="trianglePlaceholder">
                                                        </div>
                                                        <img id="imagePreview" style="display:none;">
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
                                    <h1 class="mb-3">Menu</h1>
                                    <hr>
                                    <div id="section-wrappers">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.icu.menu.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="content-wrapper">

                                                    @php
                                                        $name = is_array(old('name')) ? old('name') : [''];

                                                    @endphp

                                                    @foreach ($name as $index => $value)
                                                        <div class="feature-row border p-3 mb-3">

                                                            {{-- NAME --}}
                                                            <div class="form-group mt-2">
                                                                <label class="required">Name</label>
                                                                <input type="text" name="name[]"
                                                                    value="{{ old($name[$index] ?? '') }}"
                                                                    class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('name.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('name.' . $index) }}
                                                                    </div>
                                                                @endif
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
                        <div class="tab-pane fade" id="mid_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.icu.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="menu">
                                                                Menu
                                                            </label>

                                                            <select name="menu" id="menu"
                                                                class="form-control {{ $errors->has('menu') ? 'is-invalid' : '' }}">

                                                                <option value="">Select Menu</option>

                                                                @foreach ($menu as $cat)
                                                                    <option value="{{ $cat->id }}"
                                                                        {{ old('menu') == $cat->id ? 'selected' : '' }}>
                                                                        {{ $cat->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>

                                                            @if ($errors->has('menu'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('menu') }}
                                                                </div>
                                                            @endif

                                                            <span class="help-block">
                                                                {{ trans('cruds.health_package.fields.name_helper') }}
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.icu.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title" value="{{ old('title', '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.icu.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="description">
                                                                {{ trans('cruds.icu.fields.description') }}
                                                            </label>

                                                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                id="editor" rows="6">{{ old('description') }}</textarea>

                                                            @if ($errors->has('description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('description') }}
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required">Sub Title</label>
                                                            <input type="text" name="sub_title"
                                                                value="{{ old('sub_title') }}"
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}">

                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
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
                                                                Sub content description
                                                            </label>

                                                            <textarea class="form-control {{ $errors->has('sub_description') ? 'is-invalid' : '' }}" name="sub_description"
                                                                id="sub_description" rows="3">{{ old('sub_description') }}</textarea>

                                                            @if ($errors->has('sub_description'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_description') }}
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
                                                                onclick="document.getElementById('images').click();">
                                                                <div class="triangle-placeholder"
                                                                    id="triangle-Placeholder">
                                                                </div>
                                                                <img id="image-Preview" style="display:none;">
                                                            </div>
                                                            <input type="file" name="images" id="images"
                                                                accept="image/*"
                                                                class="d-none {{ $errors->has('images') ? 'is-invalid' : '' }}"
                                                                onchange="previewcontentImage(this)">

                                                            @if ($errors->has('images'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('images') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="content-wrappers">

                                                    @php
                                                        $text = is_array(old('text')) ? old('text') : [''];
                                                    @endphp

                                                    @foreach ($text as $index => $txt)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Text</label>
                                                                        <input type="text" name="text[]"
                                                                            value="{{ $text[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('text.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('text.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('text.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <button type="button" id="content_mid_addRow"
                                                    class="btn btn-primary mb-3">
                                                    + Add Row
                                                </button>
                                                <div id="feature-wrappers">

                                                    @php
                                                        $content_title = is_array(old('feature_title')) ? old('feature_title') : [''];
                                                        $feature_description = is_array(old('feature_description'))
                                                            ? old('feature_description')
                                                            : [''];

                                                    @endphp

                                                    @foreach ($content_title as $index => $titles)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">title</label>
                                                                        <input type="text" name="feature_title[]"
                                                                            value="{{ $content_title[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('feature_title.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('feature_title.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('feature_title.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group
">
                                                                        <label class="required">Feature Description</label>
                                                                        <textarea class="form-control {{ $errors->has('feature_description') ? 'is-invalid' : '' }}" name="feature_description[]"
                                                                            id="feature_description_{{ $index }}" rows="2">{{ $feature_description[$index] ?? '' }}</textarea>

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


        document.getElementById('addContentRow').addEventListener('click', function() {

            let wrapper = document.getElementById('content-wrapper');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name[]" class="form-control">
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



        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });

        document.getElementById('content_mid_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('content-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                  <div class="form-group">
                <label class="required">Text</label>
                <input type="text" name="text[]" class="form-control">
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


        document.getElementById('mid_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('feature-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                  <div class="form-group">
                <label class="required">Feature Title</label>
                <input type="text" name="feature_title[]" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                  <div class="form-group">
                <label class="required">Description</label>
                <textarea class="form-control" name="feature_description[]" rows="2"></textarea>
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
    </script>
@endsection
