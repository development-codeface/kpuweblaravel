@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ __('Edit') }} {{ trans('cruds.doctor.title_singular') }} </p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.cms.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" value="{{ old('title', $page->title) }}" placeholder="Enter title"
                                id="title" value="{{ old('title', '') }}">
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
                                name="slug" placeholder="Enter slug" id="slug" value="{{ old('slug',$page->slug) }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.cms.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <button class=" btn btn-success min-w-200 " type="submit">
                    {{ trans('global.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
