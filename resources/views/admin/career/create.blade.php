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
                {{ trans('global.create') }} {{ trans('cruds.career.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            Career 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#content_Section"
                            role="tab">
                            Career 2
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
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.career.banner.store') }}"
                                                enctype="multipart/form-data">
                                                <input type="hidden" name="banner_id" value="{{ $banner_edit->id }}">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                @csrf

                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.career.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $banner_edit->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.career.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="button_text">{{ trans('cruds.career.fields.button_text') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                                type="text" name="button_text" id="button_text"
                                                                value="{{ old('button_text', $banner_edit->button_text ?? '') }}"
                                                                placeholder="Enter button text">
                                                            @if ($errors->has('button_text'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('button_text') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.career.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- LEFT -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required" for="description">
                                                                    {{ trans('cruds.career.fields.description') }}
                                                                </label>

                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" rows="5" placeholder="Enter description">{{ old('description', $banner_edit->description ?? '') }}</textarea>

                                                                @if ($errors->has('description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif

                                                                <span class="help-block">
                                                                    {{ trans('cruds.career.fields.name_helper') }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required">Image</label>

                                                                <div class="image-box"
                                                                    onclick="document.getElementById('image').click();">
                                                                    @if (isset($banner_edit) && $banner_edit->image)
                                                                        <img src="{{ asset($banner_edit->image) }}"
                                                                            id="imagePreview"
                                                                            style="width:100%; display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"
                                                                            id="trianglePlaceholder">
                                                                        </div>
                                                                        <img id="imagePreview" style="display:none;">
                                                                    @endif
                                                                </div>

                                                                <input type="file" name="image" id="image"
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

                        <div class="tab-pane fade" id="content_Section" role="tabpanel">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Mid Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.career.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="pages_id" value="{{ $id }}">

                                                <div id="feature-wrappers">

                                                    @php
                                                        if (old('mid_title')) {
                                                            $rows = collect(old('mid_title'))->map(function (
                                                                $value,
                                                                $index,
                                                            ) {
                                                                return [
                                                                    'id' => old('content_id')[$index] ?? '',
                                                                    'icon' => old('icon')[$index] ?? '',
                                                                    'mid_title' => $value,
                                                                    'job_type' => old('job_type')[$index] ?? '',
                                                                    'work_mode' => old('work_mode')[$index] ?? '',
                                                                    'location' => old('location')[$index] ?? '',
                                                                    'salary_min' => old('salary_min')[$index] ?? '',
                                                                    'salary_max' => old('salary_max')[$index] ?? '',
                                                                    'salary_type' => old('salary_type')[$index] ?? '',
                                                                ];
                                                            });
                                                        } elseif (isset($content_edit) && $content_edit->count()) {
                                                            $rows = $content_edit->map(function ($row) {
                                                                return [
                                                                    'id' => $row->id,
                                                                    'icon' => $row->icon,
                                                                    'mid_title' => $row->title,
                                                                    'job_type' => $row->job_type,
                                                                    'work_mode' => $row->work_mode,
                                                                    'location' => $row->location,
                                                                    'salary_min' => $row->salary_min,
                                                                    'salary_max' => $row->salary_max,
                                                                    'salary_type' => $row->salary_type,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows = collect([
                                                                [
                                                                    'id' => '',
                                                                    'icon' => '',
                                                                    'mid_title' => '',
                                                                    'job_type' => '',
                                                                    'work_mode' => '',
                                                                    'location' => '',
                                                                    'salary_min' => '',
                                                                    'salary_max' => '',
                                                                    'salary_type' => '',
                                                                ],
                                                            ]);
                                                        }
                                                    @endphp

                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="content_id[]"
                                                                value="{{ $row['id'] }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="icon[]"
                                                                            value="{{ $row['icon'] }}"
                                                                            class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('icon.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Title</label>
                                                                        <input type="text" name="mid_title[]"
                                                                            value="{{ $row['mid_title'] }}"
                                                                            class="form-control {{ $errors->has('mid_title.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('mid_title.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Job Type</label>
                                                                        <input type="text" name="job_type[]"
                                                                            value="{{ $row['job_type'] }}"
                                                                            class="form-control {{ $errors->has('job_type.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('job_type.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Work Mode</label>
                                                                        <input type="text" name="work_mode[]"
                                                                            value="{{ $row['work_mode'] }}"
                                                                            class="form-control {{ $errors->has('work_mode.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('work_mode.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Location</label>
                                                                        <input type="text" name="location[]"
                                                                            value="{{ $row['location'] }}"
                                                                            class="form-control {{ $errors->has('location.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('location.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Salary Min</label>
                                                                        <input type="text" name="salary_min[]"
                                                                            value="{{ $row['salary_min'] }}"
                                                                            class="form-control {{ $errors->has('salary_min.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('salary_min.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Salary Max</label>
                                                                        <input type="text" name="salary_max[]"
                                                                            value="{{ $row['salary_max'] }}"
                                                                            class="form-control {{ $errors->has('salary_max.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('salary_max.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Salary Type</label>
                                                                        <input type="text" name="salary_type[]"
                                                                            value="{{ $row['salary_type'] }}"
                                                                            class="form-control {{ $errors->has('salary_type.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('salary_type.' . $index)
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

        document.getElementById('addRow').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
  <input type="hidden" name="content_id[]" value="">
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
                    <input type="text" name="mid_title[]" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="required">Job Type</label>
                    <input type="text" name="job_type[]" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Work Mode</label>
                    <input type="text" name="work_mode[]" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location[]" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                  <div class="form-group">
                <input type="text" name="salary_min[]" placeholder="Salary Min" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                   <div class="form-group">
                <input type="text" name="salary_max[]" placeholder="Salary Max" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                   <div class="form-group">
                <input type="text" name="salary_type[]" placeholder="week / month / year" class="form-control">
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

        // CLICK IMAGE BOX
        document.addEventListener('click', function(e) {

            let imageBox = e.target.closest('.image-box');

            if (imageBox) {
                let row = imageBox.closest('.feature-row');
                let input = row.querySelector('.image-input');

                if (input) {
                    input.click();
                }
            }

        });


        // IMAGE PREVIEW
        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('image-input')) {

                let input = e.target;
                let row = input.closest('.feature-row');
                let preview = row.querySelector('.image-preview');
                let placeholder = row.querySelector('.triangle-placeholder');

                if (input.files && input.files[0]) {

                    let reader = new FileReader();

                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';

                        if (placeholder) {
                            placeholder.style.display = 'none';
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
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
