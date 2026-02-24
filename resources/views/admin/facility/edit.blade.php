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
                {{ __('Edit') }} {{ trans('cruds.doctor.title_singular') }} </p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.facility.update',$edit->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $edit->id }}">
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.facility.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" placeholder="Enter title" id="title"
                                value="{{ old('title', $edit->title) }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="sub_title">{{ trans('cruds.facility.fields.sub_title') }}</label>
                            <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text"
                                name="sub_title" placeholder="Enter title" id="sub_title"
                                value="{{ old('sub_title', $edit->sub_title) }}">
                            @if ($errors->has('sub_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div id="feature-wrappers">

                    @php
                        $contents = old('heading')
                            ? collect(old('heading'))->map(function ($item, $key) {
                                return [
                                    'heading' => old('heading')[$key],
                                    'button_text' => old('button_text')[$key] ?? '',
                                    'image' => null,
                                ];
                            })
                            : $edit->content;
                    @endphp

                    @foreach ($contents as $index => $item)
                        <div class="feature-row border p-3 mb-3">
                            <input type="hidden" name="content_id[]" value="{{ $item['id'] ?? ''}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Heading</label>
                                        <input type="text" name="heading[]"
                                            value="{{ old('heading.' . $index, $item->heading ?? $item['heading']) }}"
                                            class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                        @error('heading.' . $index)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Button Text</label>
                                        <input type="text" name="button_text[]"
                                            value="{{ old('button_text.' . $index, $item->button_text ?? $item['button_text']) }}"
                                            class="form-control {{ $errors->has('button_text.' . $index) ? 'is-invalid' : '' }}">

                                        @error('button_text.' . $index)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>

                                        <div class="image-box image-trigger">
                                            <div class="triangle-placeholder"></div>

                                            @if (!empty($item->image))
                                                <img src="{{ asset('images/facility/' . $item->image) }}"
                                                    class="image-preview" style="width:200px;">
                                            @else
                                                <img class="image-preview" style="display:none; width:200px;">
                                            @endif
                                        </div>

                                        <input type="file" value="{{ $item['image'] }}" name="images[]" accept="image/*" class="d-none image-input">

                                        @error('images.' . $index)
                                            <div class="text-danger mt-1">{{ $message }}</div>
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
                <button class=" btn btn-success min-w-200 " type="submit">
                    {{ trans('global.save') }}
                </button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('mid_addRow').addEventListener('click', function() {
            let wrapper = document.getElementById('feature-wrappers');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Heading</label>
                <input type="text" name="heading[]" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                <label class="required">Button Text</label>
                <input type="text" name="button_text[]" class="form-control">
                </div>
            </div>
        </div>

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
