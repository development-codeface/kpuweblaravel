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
                {{ __('Edit') }}{{ trans('cruds.opinion.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            opinion banner 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            opinion content 2
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
                                    <form method="POST" action="{{ route('admin.second-opinion.update', $banner->id) }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.opinion.fields.title') }}</label>
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
                                                        class="help-block">{{ trans('cruds.opinion.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.opinion.fields.button_text') }}</label>
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
                                                        class="help-block">{{ trans('cruds.opinion.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="banner_description">
                                                        {{ trans('cruds.opinion.fields.description') }}
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
                                    <h1 class="mb-3">Content</h1>
                                    <hr>
                                    <div id="section-wrappers">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST"
                                                action="{{ route('admin.second-opinion.content.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="content-wrapper">
                                                    @php
                                                        $contentsData = old('heading')
                                                            ? collect(old('heading'))->map(function ($heading, $index) {
                                                                return (object) [
                                                                    'heading' => $heading,
                                                                    'description' => old('description')[$index] ?? '',
                                                                ];
                                                            })
                                                            : $contents ??
                                                                collect([
                                                                    (object) ['heading' => '', 'description' => ''],
                                                                ]);
                                                    @endphp
                                                    @foreach ($contentsData as $index => $content)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="content_id[]"
                                                                value="{{ $content->id ?? '' }}">
                                                            <div class="form-group mt-2">
                                                                <label class="required">Heading</label>
                                                                <input type="text" name="heading[]"
                                                                    value="{{ $content->heading }}"
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
                                                                    class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}">{{ $content->description }}</textarea>

                                                                @if ($errors->has('description.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('description.' . $index) }}
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



        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
