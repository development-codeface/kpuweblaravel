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
                {{ trans('global.create') }} {{ trans('cruds.about.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#bannerSection" role="tab">
                            Pharmacy 1
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'featureSection' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#featureSection" role="tab">
                            Pharmacy 2
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'mid_content_Section' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#mid_content_Section" role="tab">
                            Pharmacy 3
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
                                    <form method="POST" action="{{ route('admin.pharmacy.banner.store') }}"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="banner_id" value="{{ $edit_banner->id }}">
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
                                                        id="title"
                                                        value="{{ old('title', $edit_banner->title ?? '') }}">
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
                                                        value="{{ old('button_text', $edit_banner->button_text ?? '') }}"
                                                        placeholder="Enter button text">
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

                            <!-- KEEP YOUR EXISTING BANNER INPUTS HERE -->
                            <!-- DO NOT CHANGE ANYTHING INSIDE -->
                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'featureSection' ? 'show active' : '' }}"
                            id="featureSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.pharmacy.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="featureSection">
                                                <input type="hidden" name="content_id" value="{{ $edit_content->id }}">
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
                                                                id="title"
                                                                value="{{ old('title', $edit_content->title ?? '') }}">
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
                                                                value="{{ old('sub_title', $edit_content->sub_title ?? '') }}"
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
                                                                for="button_text">{{ trans('cruds.Pharmacy.fields.button_text') }}</label>
                                                            <input
                                                                class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                                type="text" name="button_text" id="button_text"
                                                                value="{{ old('button_text', $edit_content->button_text ?? '') }}"
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
                                                                id="editor" rows="6">{{ old('description', $edit_content->description ?? '') }}</textarea>

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
                                                        if (old('icon')) {
                                                            $rows = collect(old('icon'))->map(function ($icon, $i) {
                                                                return [
                                                                    'id' => old('sub_id')[$i] ?? '',
                                                                    'icon' => $icon,
                                                                    'heading' => old('heading')[$i] ?? '',
                                                                    'description' => old('sub_description')[$i] ?? '',
                                                                ];
                                                            });
                                                        } elseif (
                                                            isset($edit_sub_content) &&
                                                            $edit_sub_content->count()
                                                        ) {
                                                            $rows = $edit_sub_content->map(function ($row) {
                                                                return [
                                                                    'id' => $row->id,
                                                                    'icon' => $row->icon,
                                                                    'heading' => $row->heading,
                                                                    'description' => $row->description,
                                                                ];
                                                            });
                                                        } else {
                                                            $rows = collect([
                                                                [
                                                                    'id' => '',
                                                                    'icon' => '',
                                                                    'heading' => '',
                                                                    'description' => '',
                                                                ],
                                                            ]);
                                                        }
                                                    @endphp
                                                    @foreach ($rows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="sub_id[]"
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
                                                                        <label class="required">Heading</label>
                                                                        <input type="text" name="heading[]"
                                                                            value="{{ $row['heading'] }}"
                                                                            class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('heading.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Sub description</label>
                                                                        <textarea name="sub_description[]" rows="2"
                                                                            class="form-control {{ $errors->has('sub_description.' . $index) ? 'is-invalid' : '' }}">{{ $row['description'] }}</textarea>
                                                                        @error('sub_description.' . $index)
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
                        <div class="tab-pane fade {{ old('active_tab') == 'mid_content_Section' ? 'show active' : '' }}"
                            id="mid_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Mid Content</h1>
                                    <hr>
                                    <div id="section-wrapper">

                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.pharmacy.plans.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="active_tab" value="mid_content_Section">
                                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                                <div id="content-wrappers">

                                                    @php
                                                        if (old('basic_plan')) {
                                                            $textRows = collect(old('basic_plan'))->map(function (
                                                                $value,
                                                                $i,
                                                            ) {
                                                                return [
                                                                    'id' => old('plan_content_id')[$i] ?? '',
                                                                    'basic_plan' => $value,
                                                                    'standard_plan' => old('standard_plan')[$i] ?? '',
                                                                ];
                                                            });
                                                        } elseif (
                                                            isset($edit_plans_content) &&
                                                            $edit_plans_content->count()
                                                        ) {
                                                            $textRows = $edit_plans_content->map(function ($row) {
                                                                return [
                                                                    'id' => $row->id,
                                                                    'basic_plan' => $row->basic_plan,
                                                                    'standard_plan' => $row->standard_plan,
                                                                ];
                                                            });
                                                        } else {
                                                            $textRows = collect([
                                                                [
                                                                    'id' => '',
                                                                    'basic_plan' => '',
                                                                    'standard_plan' => '',
                                                                ],
                                                            ]);
                                                        }
                                                    @endphp

                                                    @foreach ($textRows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="plan_content_id[]"
                                                                value="{{ $row['id'] }}">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Basic Plan</label>
                                                                        <input type="text" name="basic_plan[]"
                                                                            value="{{ $row['basic_plan'] }}"
                                                                            class="form-control {{ $errors->has('basic_plan.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('basic_plan.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="required">Standard Plan</label>
                                                                        <input type="text" name="standard_plan[]"
                                                                            value="{{ $row['standard_plan'] }}"
                                                                            class="form-control {{ $errors->has('standard_plan.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('standard_plan.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
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
                                                        if (old('title')) {
                                                            $planRows = collect(old('title'))->map(function (
                                                                $value,
                                                                $i,
                                                            ) {
                                                                return [
                                                                    'id' => old('plan_id')[$i] ?? '',
                                                                    'plan_title' => $value,
                                                                    'plan_sub_title' => old('plan_sub_title')[$i] ?? '',
                                                                    'from_time' => old('from_time')[$i] ?? '',
                                                                    'to_time' => old('to_time')[$i] ?? '',
                                                                ];
                                                            });
                                                        } elseif (isset($edit_plans) && $edit_plans->count()) {
                                                            $planRows = $edit_plans->map(function ($row) {
                                                                return [
                                                                    'id' => $row->id,
                                                                    'plan_title' => $row->title,
                                                                    'plan_sub_title' => $row->sub_title,
                                                                    'from_time' => $row->from_time,
                                                                    'to_time' => $row->to_time,
                                                                ];
                                                            });
                                                        } else {
                                                            $planRows = collect([
                                                                [
                                                                    'id' => '',
                                                                    'plan_title' => '',
                                                                    'plan_sub_title' => '',
                                                                    'from_time' => '',
                                                                    'to_time' => '',
                                                                ],
                                                            ]);
                                                        }
                                                    @endphp

                                                    @foreach ($planRows as $index => $row)
                                                        <div class="feature-row border p-3 mb-3">
                                                            <input type="hidden" name="plan_id[]"
                                                                value="{{ $row['id'] }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">title</label>
                                                                        <input type="text" name="plan_title[]"
                                                                            value="{{ $row['plan_title'] }}"
                                                                            class="form-control {{ $errors->has('plan_title.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('plan_title.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">Sub Title</label>
                                                                        <input type="text" name="plan_sub_title[]"
                                                                            value="{{ $row['plan_sub_title'] }}"
                                                                            class="form-control {{ $errors->has('plan_sub_title.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('plan_sub_title.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">From Time</label>
                                                                        <input type="text" name="from_time[]"
                                                                            value="{{ $row['from_time'] }}"
                                                                            class="form-control {{ $errors->has('from_time.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('from_time.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="required">To Time</label>
                                                                        <input type="text" name="to_time[]"
                                                                            value="{{ $row['to_time'] }}"
                                                                            class="form-control {{ $errors->has('to_time.' . $index) ? 'is-invalid' : '' }}">
                                                                        @error('to_time.' . $index)
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
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
