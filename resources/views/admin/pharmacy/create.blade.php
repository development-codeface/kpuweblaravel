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
                {{ trans('global.create') }} {{ trans('cruds.about.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            Pharmacy 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#featureSection"
                            role="tab">
                            Pharmacy 2
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
                                    <form method="POST" action="{{ route('admin.pharmacy.banner.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.Pharmacy.fields.title') }}</label>
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
                                                        class="help-block">{{ trans('cruds.Pharmacy.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.Pharmacy.fields.button_text') }}</label>
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
                                                        class="help-block">{{ trans('cruds.about.fields.name_helper') }}</span>
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

                            <!-- KEEP YOUR EXISTING BANNER INPUTS HERE -->
                            <!-- DO NOT CHANGE ANYTHING INSIDE -->
                        </div>



                        <div class="tab-pane fade" id="featureSection" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.pharmacy.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.Pharmacy.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title" value="{{ old('title') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.Pharmacy.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.Pharmacy.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title" id="sub_title"
                                                                value="{{ old('sub_title') }}"
                                                                placeholder="Enter Sub title">
                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.Pharmacy.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.Pharmacy.fields.button_text') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                                type="text" name="button_text" id="button_text"
                                                                value="{{ old('button_text') }}"
                                                                placeholder="Enter button text">
                                                            @if ($errors->has('button_text'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('button_text') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.Pharmacy.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="description">
                                                                {{ trans('cruds.Pharmacy.fields.description') }}
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
                                                <div id="feature-wrapper">
                                                    @php
                                                        $icons = is_array(old('icon')) ? old('icon') : [''];
                                                        $names = is_array(old('heading')) ? old('heading') : [''];
                                                        $descs = is_array(old('sub_description'))
                                                            ? old('sub_description')
                                                            : [''];
                                                    @endphp
                                                    @foreach ($icons as $index => $icon)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icon[]"
                                                                            value="{{ $icon }}"
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
                                                                        <label class="required">Heading</label>
                                                                        <input type="text" name="heading[]"
                                                                            value="{{ $names[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('heading.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('heading.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Sub description</label>
                                                                        <textarea name="sub_description[]"
                                                                            class="form-control {{ $errors->has('sub_description.' . $index) ? 'is-invalid' : '' }}" rows="2">{{ $descs[$index] ?? '' }}</textarea>

                                                                        @if ($errors->has('sub_description.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('sub_description.' . $index) }}
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



                        <div class="tab-pane fade" id="mid_content_Section" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Mid Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.pharmacy.plans.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="content-wrappers">

                                                    @php
                                                        $basic_plan = is_array(old('basic_plan'))
                                                            ? old('basic_plan')
                                                            : [''];
                                                        $standard_plan = is_array(old('standard_plan'))                                                            ? old('standard_plan')
                                                            : [''];
                                                    @endphp

                                                    @foreach ($basic_plan as $index => $txt)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Basic Plan</label>
                                                                        <input type="text" name="basic_plan[]"
                                                                            value="{{ $txt }}"
                                                                            class="form-control {{ $errors->has('basic_plan.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('basic_plan.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('basic_plan.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Standard Plan</label>
                                                                        <input type="text" name="standard_plan[]"
                                                                            value="{{ $standard_plan[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('standard_plan.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('standard_plan.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('standard_plan.' . $index) }}
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
                                                        $title = is_array(old('title')) ? old('title') : [''];
                                                        $sub_title = is_array(old('sub_title'))
                                                            ? old('sub_title')
                                                            : [''];
                                                        $from_time = is_array(old('from_time'))
                                                            ? old('from_time')
                                                            : [''];
                                                        $to_time = is_array(old('to_time')) ? old('to_time') : [''];

                                                    @endphp

                                                    @foreach ($title as $index => $titles)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">title</label>
                                                                        <input type="text" name="title[]"
                                                                            value="{{ $title[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('title.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('title.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('title.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Sub Title</label>
                                                                        <input type="text" name="sub_title[]"
                                                                            value="{{ $title[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('sub_title.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('sub_title.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('sub_title.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">From Time</label>
                                                                        <input type="text" name="from_time[]"
                                                                            value="{{ $title[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('from_time.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('from_time.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('from_time.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">To Time</label>
                                                                        <input type="text" name="to_time[]"
                                                                            value="{{ $title[$index] ?? '' }}"
                                                                            class="form-control {{ $errors->has('to_time.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('to_time.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('to_time.' . $index) }}
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
                    <label class="required">Heading</label>
                    <input type="text" name="heading[]" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="sub_description[]" class="form-control" rows="2"></textarea>
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


        document.getElementById('content_mid_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('content-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                  <div class="form-group">
                <label class="required">Basic Plan</label>
                <input type="text" name="basic_plan[]" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                  <div class="form-group">
                <label class="required">Standard Plan</label>
                <input type="text" name="standard_plan[]" class="form-control">
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
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Title</label>
                <input type="text" name="title[]" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Sub Title</label>
                <input type="text" name="sub_title[]" class="form-control">
                </div>
            </div>
              <div class="col-md-6">
                  <div class="form-group">
                <label class="required">From Time</label>
                <input type="text" name="from_time[]" class="form-control">
                </div>
            </div>
              <div class="col-md-6">
                  <div class="form-group">
                <label class="required">To Time</label>
                <input type="text" name="to_time[]" class="form-control">
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
    </script>
@endsection
