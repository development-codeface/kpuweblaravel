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
                {{ __('Edit') }} {{ trans('cruds.ambulance.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            Ambulance 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            Ambulance 2
                        </a>

                        {{-- <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            Pharmacy 3
                        </a> --}}
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
                                    <form method="POST" action="{{ route('admin.ambulance.update', $id) }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.ambulance.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title" value="{{ old('title', $banner->title) }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.ambulance.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.ambulance.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text', $banner->button_text) }}"
                                                        placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.ambulance.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="description">
                                                        {{ trans('cruds.ambulance.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="6">{{ old('description', $banner->description) }}</textarea>

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
                                                        @if (!empty($banner->image))
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
                                            <form method="POST" action="{{ route('admin.ambulance.content.update',$id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                 <input type="hidden" name="content_id" value="{{ $contents->id }}">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.ambulance.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $contents->title) }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.Pharmacy.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- LEFT -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required" for="description">
                                                                    {{ trans('cruds.ambulance.fields.description') }}
                                                                </label>

                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="editor" rows="6">{{ old('description', $contents->description) }}</textarea>

                                                                @if ($errors->has('description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.Pharmacy.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title" id="sub_title"
                                                                value="{{ old('sub_title', $contents->sub_title) }}"
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
                                                    <div class="row">
                                                        <!-- LEFT -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required" for="sub_description">
                                                                    {{ trans('cruds.ambulance.fields.sub_description') }}
                                                                </label>

                                                                <textarea class="form-control {{ $errors->has('sub_description') ? 'is-invalid' : '' }}" name="sub_description"
                                                                    id="" rows="6">{{ old('sub_description', $contents->sub_description) }}</textarea>

                                                                @if ($errors->has('sub_description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('sub_description') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required">Image</label>
                                                            <div class="image-box"
                                                                onclick="document.getElementById('content_image').click();">

                                                                @if (!empty($contents->image))
                                                                    <img src="{{ asset($contents->image) }}"
                                                                        id="content_imagePreview"
                                                                        style="width:100%; display:block;">
                                                                @else
                                                                    <div class="triangle-placeholder"
                                                                        id="content_trianglePlaceholder"></div>

                                                                    <img id="content_imagePreview" style="display:none;">
                                                                @endif

                                                            </div>

                                                            <input type="file" name="content_image" id="content_image"
                                                                accept="image/*"
                                                                class="d-none {{ $errors->has('content_image') ? 'is-invalid' : '' }}"
                                                                onchange="conetentpreviewImage(this)">

                                                            @if ($errors->has('content_image'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('content_image') }}
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
                                                                for="number">{{ trans('cruds.ambulance.fields.number') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}"
                                                                type="text" name="number" placeholder="Enter number"
                                                                id="number"
                                                                value="{{ old('number', $contents->number) }}">
                                                            @if ($errors->has('number'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('number') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.ambulance.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapper">
                                                    @php
                                                        $items = old('heading')
                                                            ? collect(old('heading'))->map(function ($heading, $index) {
                                                                return [
                                                                    'title' => $heading,
                                                                    'description' =>
                                                                        old('content_descriptions')[$index] ?? '',
                                                                ];
                                                            })
                                                            : $contents->sub_content ?? collect();

                                                        // Ensure at least one row
                                                        if ($items->isEmpty()) {
                                                            $items = collect([['title' => '', 'description' => '']]);
                                                        }
                                                    @endphp
                                                    @foreach ($items as $index => $item)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_content_id[]"
                                                                value="{{ is_array($item) ? '' : $item->id }}">
                                                            {{-- Heading --}}
                                                            <div class="form-group">
                                                                <label class="required">Heading</label>

                                                                <input type="text" name="heading[]"
                                                                    value="{{ is_array($item) ? $item['title'] : $item->title }}"
                                                                    class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('heading.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('heading.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            {{-- Description --}}
                                                            <div class="form-group mt-2">
                                                                <label class="required">Description</label>

                                                                <textarea name="content_descriptions[]" rows="6"
                                                                    class="form-control {{ $errors->has('content_descriptions.' . $index) ? 'is-invalid' : '' }}">{{ is_array($item) ? $item['description'] : $item->description }}</textarea>

                                                                @if ($errors->has('content_descriptions.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('content_descriptions.' . $index) }}
                                                                    </div>
                                                                @endif
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
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="required">Heading</label>
                    <input type="text" name="heading[]" class="form-control">
                    </div>
                </div>
                </div>
             <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <label>Descriptions</label>
                    <textarea name="content_descriptions[]" class="form-control" rows="2"></textarea>
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

        function conetentpreviewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('content_imagePreview');
                    const triangle = document.getElementById('content_trianglePlaceholder');

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
