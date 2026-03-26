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
                {{ trans('global.create') }} {{ trans('cruds.insurance.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#bannerSection" role="tab">
                            Vision 1
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#Section" role="tab">
                            Vision 2
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'contentSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#contentSection" role="tab">
                            Vision 3
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
                        <div class="tab-pane fade {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'show active' : '' }}"
                            id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Banner Section</h1>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.our-vision.store') }}"
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
                                                        for="title">{{ trans('cruds.insurance.fields.title') }}</label>
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
                                                        class="help-block">{{ trans('cruds.insurance.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.insurance.fields.button_text') }}</label>
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
                                                        class="help-block">{{ trans('cruds.insurance.fields.name_helper') }}</span>
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

                        <div class="tab-pane fade {{ old('active_tab') == 'Section' ? 'show active' : '' }}" id="Section"
                            role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Section</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.our-vision.section.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="Section">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="feature-wrappers">
                                                    @php
                                                        if (old('section_icons')) {
                                                            $rows = collect(old('section_icons'))->map(function (
                                                                $item,
                                                                $index,
                                                            ) {
                                                                return (object) [
                                                                    'icon' => old('section_icons')[$index],
                                                                    'heading' => old('section_headings')[$index],
                                                                    'description' => old('section_descriptions')[
                                                                        $index
                                                                    ],
                                                                    'id' => old('section_id')[$index] ?? null,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($edit_section) && $edit_section->count()
                                                                    ? $edit_section
                                                                    : collect([null]);
                                                        }
                                                    @endphp

                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <input type="hidden" name="section_id[]"
                                                                value="{{ $row->id ?? '' }}">

                                                            <!-- ICON -->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Icon</label>
                                                                        <input type="text" name="section_icons[]"
                                                                            class="form-control {{ $errors->has('section_icons.' . $index) ? 'is-invalid' : '' }}"
                                                                            value="{{ old('section_icons.' . $index, $row->icon ?? '') }}"
                                                                            placeholder="Enter icon class (e.g. fa fa-user)">

                                                                        @if ($errors->has('section_icons.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_icons.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- HEADING -->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Heading</label>
                                                                        <input type="text" name="section_headings[]"
                                                                            class="form-control {{ $errors->has('section_headings.' . $index) ? 'is-invalid' : '' }}"
                                                                            value="{{ old('section_headings.' . $index, $row->heading ?? '') }}"
                                                                            placeholder="Enter heading">

                                                                        @if ($errors->has('section_headings.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_headings.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- DESCRIPTION -->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Description</label>
                                                                        <textarea name="section_descriptions[]"
                                                                            class="form-control {{ $errors->has('section_descriptions.' . $index) ? 'is-invalid' : '' }}" rows="2">{{ old('section_descriptions.' . $index, $row->description ?? '') }}</textarea>

                                                                        @if ($errors->has('section_descriptions.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('section_descriptions.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" id="add-Row" class="btn btn-primary mb-3">
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

                        <div class="tab-pane fade {{ old('active_tab') == 'contentSection' ? 'show active' : '' }}"
                            id="contentSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.our-vision.content.store') }}"
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
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.insurance.fields.title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                                type="text" name="title" placeholder="Enter title"
                                                                id="title"
                                                                value="{{ old('title', $edit_content->title ?? '') }}">
                                                            @if ($errors->has('title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.insurance.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="sub_title">{{ trans('cruds.insurance.fields.sub_title') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                                type="text" name="sub_title" id="sub_title"
                                                                value="{{ old('sub_title', $edit_content->sub_title ?? '') }}"
                                                                placeholder="Enter Sub title">
                                                            @if ($errors->has('sub_title'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('sub_title') }}
                                                                </div>
                                                            @endif
                                                            <span
                                                                class="help-block">{{ trans('cruds.insurance.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapper">
                                                    @php
                                                        if (old('content_descriptions')) {
                                                            $oldDescriptions = old('content_descriptions', []);
                                                            $oldIds = old('sub_content_id', []);

                                                            $rows = collect($oldDescriptions)->map(function (
                                                                $item,
                                                                $index,
                                                            ) use ($oldIds) {
                                                                return (object) [
                                                                    'image' => null, // file cannot be restored
                                                                    'description' => $item,
                                                                    'id' => $oldIds[$index] ?? null,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows =
                                                                isset($edit_content) &&
                                                                $edit_content->subContent->count()
                                                                    ? $edit_content->subContent
                                                                    : collect([null]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_content_id[]"
                                                                value="{{ $row->id ?? '' }}">
                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Image</label>
                                                                        <div class="image-box image-trigger">
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

                                                                        <input type="file" name="images[]"
                                                                            accept="image/*"
                                                                            class="d-none image-input {{ $errors->has('images.' . $index) ? 'is-invalid' : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- LEFT -->
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required"
                                                                            for="content_descriptions">
                                                                            {{ trans('cruds.insurance.fields.description') }}
                                                                        </label>
                                                                        <textarea class="form-control {{ $errors->has('content_descriptions.' . $index) ? 'is-invalid' : '' }}"
                                                                            name="content_descriptions[]" rows="2">{{ old('content_descriptions.' . $index, $row->description ?? '') }}</textarea>

                                                                        @if ($errors->has('content_descriptions.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('content_descriptions.' . $index) }}
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

        document.getElementById('add-Row').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">

        <input type="hidden" name="section_id[]" value="">

        <!-- ICON -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required">Icon</label>
                    <input type="text" name="section_icons[]" class="form-control"
                        placeholder="Enter icon class (e.g. fa fa-user)">
                </div>
            </div>
        </div>

        <!-- HEADING -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required">Heading</label>
                    <input type="text" name="section_headings[]" class="form-control"
                        placeholder="Enter heading">
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required">Description</label>
                    <textarea name="section_descriptions[]" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <!-- REMOVE BUTTON -->
        <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
            Remove
        </button>

    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });


        document.getElementById('addRow').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrapper');

            let html = `
        <div class="feature-row border p-3 mb-3">
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

        document.addEventListener('click', function(e) {

            if (e.target.closest('.image-trigger')) {

                let box = e.target.closest('.image-trigger');
                let row = box.closest('.feature-row');
                let input = row.querySelector('.image-input');

                if (input) {
                    input.click();
                }
            }

        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });

        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('image-input')) {

                let input = e.target;

                if (!input.files || !input.files[0]) return;

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
    </script>
@endsection
