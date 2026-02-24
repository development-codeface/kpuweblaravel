@extends('layouts.admin')
@section('content')
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
                        $icons = old('icon', ['']);
                        $names = old('name', ['']);
                        $descs = old('description', ['']);
                    @endphp

                    @foreach ($icons as $index => $icon)
                        <div class="feature-row border p-3 mb-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Icon</label>
                                        <input type="text" name="icon[]" value="{{ $icon }}"
                                            class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                        @if ($errors->has('icon.' . $index))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('icon.' . $index) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input type="text" name="name[]" value="{{ $names[$index] ?? '' }}"
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="required">Icon</label>
                    <input type="text" name="icon[]" class="form-control">
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
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>
@endsection
