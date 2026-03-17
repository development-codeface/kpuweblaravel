@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} {{ trans('cruds.cms.pages') }} </p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="name">Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" placeholder="Enter Name" id="name" value="{{ old('name', '') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.cms.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="required" for="status">Status</label>

                            <select name="status" id="status"
                                class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                <option value="">Select Status</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                </option>
                            </select>

                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
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
@endsection
