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
                            Room 1
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#Section" role="tab">
                            Room 2
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
                                    <form method="POST" action="{{ route('admin.rooms.store') }}"
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
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="description">
                                                        {{ trans('cruds.icu.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="2">{{ old('description', $edit_banner->description ?? '') }}</textarea>

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
                                    <h1 class="mb-3">Rooms</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.rooms.feature.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="Section">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="feature-wrapper">
                                                    @php
                                                        if (old('rooms')) {
                                                            $rows = old('rooms');
                                                        } else {
                                                            $rows =
                                                                isset($edit_rooms) && $edit_rooms->count()
                                                                    ? $edit_rooms
                                                                    : collect([null]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="rooms[{{ $index }}][id]"
                                                                value="{{ is_object($row) ? $row->id : '' }}">
                                                            <!-- IMAGE -->
                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Image</label>

                                                                        <div class="image-box image-trigger">
                                                                            @if (is_object($row) && $row->image)
                                                                                <img src="{{ asset($row->image) }}"
                                                                                    class="image-preview"
                                                                                    style="width:200px; display:block;">
                                                                            @else
                                                                                <div class="triangle-placeholder"></div>
                                                                                <img class="image-preview"
                                                                                    style="display:none; width:200px;">
                                                                            @endif
                                                                        </div>

                                                                        <input type="file"
                                                                            name="rooms[{{ $index }}][image]"
                                                                            class="d-none image-input {{ $errors->has('rooms.' . $index . '.image') ? 'is-invalid' : '' }}">

                                                                        @if ($errors->has('rooms.' . $index . '.image'))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('rooms.' . $index . '.image') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- TYPE -->
                                                            <div class="form-group">
                                                                <label class="required">Type</label>
                                                                <input type="text"
                                                                    name="rooms[{{ $index }}][type]"
                                                                    value="{{ old('rooms.' . $index . '.type', is_object($row) ? $row->type : '') }}"
                                                                    class="form-control {{ $errors->has('rooms.' . $index . '.type') ? 'is-invalid' : '' }}">

                                                                @if ($errors->has('rooms.' . $index . '.type'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('rooms.' . $index . '.type') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- HEADING -->
                                                            <div class="form-group">
                                                                <label class="required">Heading</label>
                                                                <input type="text"
                                                                    name="rooms[{{ $index }}][heading]"
                                                                    value="{{ old('rooms.' . $index . '.heading', is_object($row) ? $row->heading : '') }}"
                                                                    class="form-control {{ $errors->has('rooms.' . $index . '.heading') ? 'is-invalid' : '' }}">
                                                                @if ($errors->has('rooms.' . $index . '.heading'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('rooms.' . $index . '.heading') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- BEDS -->
                                                            <div class="form-group">
                                                                <label class="required">Beds</label>
                                                                <input type="number"
                                                                    name="rooms[{{ $index }}][bed_count]"
                                                                    value="{{ old('rooms.' . $index . '.bed_count', is_object($row) ? $row->bed_count : '') }}"
                                                                    class="form-control {{ $errors->has('rooms.' . $index . '.bed_count') ? 'is-invalid' : '' }}">
                                                                @if ($errors->has('rooms.' . $index . '.bed_count'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('rooms.' . $index . '.bed_count') }}
                                                                    </div>
                                                                @endif

                                                            </div>

                                                            <!-- FEATURES (SpecRooms) -->
                                                            <div class="form-group">

                                                                @php
                                                                    if (old('rooms.' . $index . '.features')) {
                                                                        $features = old(
                                                                            'rooms.' . $index . '.features',
                                                                        );
                                                                    } else {
                                                                        $features =
                                                                            is_object($row) && $row->specRooms->count()
                                                                                ? $row->specRooms
                                                                                : [''];
                                                                    }
                                                                @endphp

                                                                <div class="features-wrapper">
                                                                    @foreach ($features as $fIndex => $feature)
                                                                        <input type="hidden"
                                                                            name="rooms[{{ $index }}][feature_ids][]"
                                                                            value="{{ is_object($feature) ? $feature->id : '' }}">

                                                                        <div class="d-flex mb-2 feature-item">
                                                                            <label class="required">Feature</label>
                                                                            <input type="text"
                                                                                name="rooms[{{ $index }}][features][]"
                                                                                value="{{ is_object($feature) ? $feature->features : $feature }}"
                                                                                class="form-control {{ $errors->has('rooms.' . $index . '.features.' . $fIndex) ? 'is-invalid' : '' }}">
                                                                            @if ($errors->has('rooms.' . $index . '.features.' . $fIndex))
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->first('rooms.' . $index . '.features.' . $fIndex) }}
                                                                                </div>
                                                                            @endif
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm remove-feature ms-2">X</button>

                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm add-feature mt-2">
                                                                    + Add Feature
                                                                </button>
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

        let index = document.querySelectorAll('.feature-row').length;

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

                    <input type="file"
                        name="rooms[${index}][image]"
                        accept="image/*"
                        class="d-none image-input">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Type</label>
            <input type="text" name="rooms[${index}][type]" class="form-control">
        </div>

        <div class="form-group">
            <label>Heading</label>
            <input type="text" name="rooms[${index}][heading]" class="form-control">
        </div>

        <div class="form-group">
            <label>Beds</label>
            <input type="number" name="rooms[${index}][bed_count]" class="form-control">
        </div>

        <div class="features-wrapper">
            <div class="d-flex mb-2 feature-item">
                  <input type="text" name="rooms[${index}][feature_ids][]" value="">
                <label class="required">Feature</label>
                <input type="text" name="rooms[${index}][features][]" class="form-control">
                <button type="button" class="btn btn-danger btn-sm remove-feature ms-2">X</button>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-sm add-feature mt-2">+ Add Feature</button>

    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
            index++;
        });


        // add/remove feature
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('add-feature')) {

                let row = e.target.closest('.feature-row');
                let idx = Array.from(document.querySelectorAll('.feature-row')).indexOf(row);

                row.querySelector('.features-wrapper').insertAdjacentHTML('beforeend', `
            <div class="d-flex mb-2 feature-item">
                  <input type="hidden" name="rooms[${idx}][feature_ids][]" value="">
                  <label class="required">Feature</label>
                <input type="text" name="rooms[${idx}][features][]" class="form-control">
                <button type="button" class="btn btn-danger btn-sm remove-feature ms-2">X</button>
            </div>
        `);
            }

            if (e.target.classList.contains('remove-feature')) {
                e.target.parentElement.remove();
            }

        });
    </script>
@endsection
