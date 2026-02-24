@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} {{ trans('cruds.cms.pages') }} </p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.cms.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" placeholder="Enter title" id="title" value="{{ old('title', '') }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.cms.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="slug">{{ trans('cruds.cms.fields.slug') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="slug" placeholder="Enter slug" id="slug" value="{{ old('slug', '') }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.cms.fields.name_helper') }}</span>
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
@endsection
