@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }} </p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.department.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.department.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" placeholder="Enter name" id="name" value="{{ old('name', '') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="description">
                                {{ trans('cruds.department.fields.description') }}
                            </label>

                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description"
                                rows="4" placeholder="Enter description">{{ old('description', '') }}</textarea>

                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                            <span class="help-block">
                                {{ trans('cruds.department.fields.name_helper') }}
                            </span>
                        </div>
                    </div>
                </div>
                <button class=" btn btn-success min-w-200 " type="submit">
                    {{ trans('global.save') }}
                </button>
        </div>
    </div>
@endsection
