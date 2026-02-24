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
                {{ __('Edit') }} {{ trans('cruds.blood_bank.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            Blood bank 1
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            Blood bank 2
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            Blood bank 3
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
                                    <form method="POST" action="{{ route('admin.blood_bank.update', $id) }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="banner_id" value="{{ $edit_bannner->id }}">
                                        @csrf
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.blood_bank.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title" value="{{ old('title', $edit_bannner->title) }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.blood_bank.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.blood_bank.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text', $edit_bannner->button_text) }}"
                                                        placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.blood_bank.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="description">
                                                        {{ trans('cruds.blood_bank.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="6">{{ old('description', $edit_bannner->description) }}</textarea>

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
                                                        @if (!empty($edit_bannner->image))
                                                            <img src="{{ asset($edit_bannner->image) }}" id="imagePreview"
                                                                style="width:100%; display:block;">
                                                        @else
                                                            <div class="triangle-placeholder" id="trianglePlaceholder">
                                                            </div>

                                                            <img id="imagePreview" style="display:none; width:100%;">
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
                                                action="{{ route('admin.blood_bank.content.update', $id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <input type="hidden" name="blood_content_id"
                                                    value="{{ $edit_content->id }}">
                                                <div class="row">
                                                    <!-- LEFT -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="title">{{ trans('cruds.blood_bank.fields.title') }}</label>
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
                                                                class="help-block">{{ trans('cruds.blood_bank.fields.name_helper') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- LEFT -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required" for="description">
                                                                    {{ trans('cruds.blood_bank.fields.description') }}
                                                                </label>

                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    rows="6">{{ old('description', $edit_content->description ?? '') }}</textarea>

                                                                @if ($errors->has('description'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="feature-wrapper">
                                                    @php
                                                        $oldHeading = old('heading');
                                                        $oldText = old('text');

                                                        if ($oldHeading) {
                                                            $headings = $oldHeading;
                                                            $texts = $oldText;
                                                        } else {
                                                            $headings = $edit_content->sub_content
                                                                ->pluck('heading')
                                                                ->toArray() ?? [''];
                                                            $texts = $edit_content->sub_content
                                                                ->pluck('text')
                                                                ->toArray() ?? [''];
                                                        }
                                                    @endphp

                                                    @foreach ($headings as $index => $headingValue)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_content_id[]"
                                                                value="{{ $edit_content->sub_content[$index]->id ?? '' }}">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Heading</label>
                                                                        <input type="text" name="heading[]"
                                                                            value="{{ $headingValue }}"
                                                                            class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('heading.' . $index))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('heading.' . $index) }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Text</label>
                                                                        <input type="text" name="text[]"
                                                                            value="{{ $texts[$index] ?? '' }}"
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
                        <div class="tab-pane fade show" id="mid_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Blood Group</h1>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.blood_bank.blood_group.update',$id) }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        @csrf
                                        <div id="feature-wrappers">
                                            @php
                                                $oldBloodGroup = old('blood_group');
                                                $oldStatus = old('status');

                                                if ($oldBloodGroup) {
                                                    $bloodGroups = $oldBloodGroup;
                                                    $statuses = $oldStatus;
                                                    $ids = old('blood_group_id') ?? [];
                                                } else {
                                                    $bloodGroups = $blood_groups->pluck('blood_group')->toArray();
                                                    $statuses = $blood_groups->pluck('status')->toArray();
                                                    $ids = $blood_groups->pluck('id')->toArray();
                                                }

                                                if (empty($bloodGroups)) {
                                                    $bloodGroups = [''];
                                                    $statuses = [''];
                                                    $ids = [''];
                                                }
                                            @endphp

                                            @foreach ($bloodGroups as $index => $blood_grp)
                                                <div class="feature-row border p-3 mb-3">

                                                    <input type="hidden" name="blood_group_id[]"
                                                        value="{{ $ids[$index] ?? '' }}">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="required">Blood Group</label>
                                                                <input type="text" name="blood_group[]"
                                                                    value="{{ $blood_grp }}"
                                                                    class="form-control {{ $errors->has('blood_group.' . $index) ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('blood_group.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('blood_group.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group mt-2">
                                                            <label class="required">Status</label>
                                                            <select name="status[]"
                                                                class="form-control {{ $errors->has('status.' . $index) ? 'is-invalid' : '' }}">
                                                                <option value="">-- Select Status --</option>
                                                                <option value="1"
                                                                    {{ ($statuses[$index] ?? '') == '1' ? 'selected' : '' }}>
                                                                    Available
                                                                </option>
                                                                <option value="0"
                                                                    {{ ($statuses[$index] ?? '') == '0' ? 'selected' : '' }}>
                                                                    Not Available
                                                                </option>
                                                            </select>

                                                            @if ($errors->has('status.' . $index))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('status.' . $index) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach

                                        </div>
                                        <button type="button" id="add_blod_Row" class="btn btn-primary mb-3">
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


        document.getElementById('add_blod_Row').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrappers');

            let html = `
        <div class="feature-row border p-3 mb-3">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">Blood Group</label>
                        <input type="text" name="blood_group[]" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-2">
                        <label class="required">Status</label>
                        <select name="status[]" class="form-control">
                            <option value="">-- Select Status --</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
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


        // ✅ Remove Row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
