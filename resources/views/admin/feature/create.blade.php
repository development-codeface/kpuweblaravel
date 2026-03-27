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
                {{ trans('global.create') }} {{ trans('cruds.feature.title_singular') }} </p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.feature.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.feature.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" placeholder="Enter title" id="title" value="{{ old('title', '') }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="sub_title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                            <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text"
                                name="sub_title" id="sub_title" value="{{ old('sub_title') }}"
                                placeholder="Enter Sub title">
                            @if ($errors->has('sub_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div id="feature-wrapper">

                    @php
                        $names = old('name', ['']);
                        $descs = old('description', ['']);
                        $existingIcons = old('existing_icon', array_fill(0, count($names), ''));
                    @endphp

                    @foreach ($names as $index => $name)
                        <div class="feature-row border p-3 mb-3">
                            <input type="hidden" name="existing_icon[]"
                                value="{{ $existingIcons[$index] ?? '' }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Icon</label>
                                        <div class="image-box image-trigger" style="cursor:pointer;">
                                            @if (!empty($existingIcons[$index]))
                                                <img src="{{ asset($existingIcons[$index]) }}" class="image-preview"
                                                    style="display:block;">
                                            @else
                                                <div class="triangle-placeholder"></div>
                                                <img class="image-preview" style="display:none;">
                                            @endif
                                        </div>
                                        <input type="file" name="icon[]" accept="image/*"
                                            class="d-none image-input {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                        @if ($errors->has('icon.' . $index))
                                            <div class="text-danger mt-1">
                                                {{ $errors->first('icon.' . $index) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input type="text" name="name[]" value="{{ $name }}"
                                            class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                        @if ($errors->has('name.' . $index))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name.' . $index) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description[]" class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}"
                                            rows="2">{{ $descs[$index] ?? '' }}</textarea>

                                        @if ($errors->has('description.' . $index))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('description.' . $index) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                                Remove
                            </button>
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
    <script>
        document.getElementById('addRow').addEventListener('click', function() {

            let wrapper = document.getElementById('feature-wrapper');

            let html = `
        <div class="feature-row border p-3 mb-3">
            <input type="hidden" name="existing_icon[]" value="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="required">Icon</label>
                    <div class="image-box image-trigger" style="cursor:pointer;">
                        <div class="triangle-placeholder"></div>
                        <img class="image-preview" style="display:none;">
                    </div>
                    <input type="file" name="icon[]" accept="image/*" class="d-none image-input">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="required">Name</label>
                    <input type="text" name="name[]" class="form-control">
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

        document.addEventListener('click', function(e) {
            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }

            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('image-input')) {
                let file = e.target.files[0];
                let row = e.target.closest('.feature-row');
                let preview = row.querySelector('.image-preview');
                let placeholder = row.querySelector('.triangle-placeholder');

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                        if (placeholder) {
                            placeholder.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
@endsection
