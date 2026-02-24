@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ __('Edit') }} {{ trans('cruds.department.title_singular') }} </p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.department.update', $department->id) }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($department))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.department.fields.name') }}</label>

                            <input type="text" name="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ old('name', $department->name ?? '') }}">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required">
                                {{ trans('cruds.department.fields.description') }}
                            </label>

                            <textarea name="description" rows="4" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                placeholder="Enter description">{{ old('description', $department->description ?? '') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-success min-w-200 mt-3" type="submit">
                    {{ isset($department) ? trans('global.update') : trans('global.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
