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
                {{ __('Edit') }}{{ trans('cruds.doctor.title_singular') }} </p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.doctor.update', $edit->id) }}" enctype="multipart/form-data">
                @csrf
                 @method('PUT')
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" value="{{ old('name', $edit->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="description">
                                {{ trans('cruds.doctor.fields.description') }}
                            </label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="4">{{ old('description', $edit->description) }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                            <span class="help-block">
                                {{ trans('cruds.doctor.fields.name_helper') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.doctor.fields.designation') }}</label>
                            <input class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                type="text" name="designation" value="{{ old('designation', $edit->designation) }}">

                            @if ($errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('designation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="required" for="departments">
                        {{ trans('cruds.doctor.fields.departments') }}
                    </label>

                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs btn-primary select-all" style="border-radius:0">
                            {{ trans('global.select_all') }}
                        </span>
                        <span class="btn btn-info btn-xs btn-primary deselect-all" style="border-radius:0">
                            {{ trans('global.deselect_all') }}
                        </span>
                    </div>

                    <select class="form-control select2 {{ $errors->has('departments') ? 'is-invalid' : '' }}"
                        name="departments[]" id="departments" multiple>
                        @foreach ($departments as $id => $department)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('departments', $selectedDepartments ?? [])) ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>


                    @if ($errors->has('departments'))
                        <div class="invalid-feedback">
                            {{ $errors->first('departments') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required">Image</label>

                            <div class="image-box" onclick="document.getElementById('image').click();">

                                {{-- Existing image (edit mode) --}}
                                @if (!empty($edit->image))
                                    <img id="imagePreview" src="{{ asset($edit->image) }}"
                                        style="display:block; max-width:100%;">
                                    <div class="triangle-placeholder d-none" id="trianglePlaceholder"></div>
                                @else
                                    <div class="triangle-placeholder" id="trianglePlaceholder"></div>
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
                @include('admin.blog.partials.seo-fields', [
                    'seo' => $edit->seo,
                    'seoImageHelperText' => 'Leave empty to use the main doctor image for SEO.',
                ])

                <button class=" btn btn-success min-w-200 " type="submit">
                    {{ trans('global.save') }}
                </button>
            </form>
        </div>
    </div>
    <script>
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
    </script>
@endsection
