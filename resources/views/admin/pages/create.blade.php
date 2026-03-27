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

                <hr>
                <h4 class="mb-3">SEO Setup</h4>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="seo_title">SEO Title</label>
                            <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}"
                                type="text" name="seo_title" id="seo_title" value="{{ old('seo_title') }}"
                                placeholder="Enter SEO title">
                            @if ($errors->has('seo_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_title') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="seo_author">SEO Author</label>
                            <input class="form-control {{ $errors->has('seo_author') ? 'is-invalid' : '' }}"
                                type="text" name="seo_author" id="seo_author" value="{{ old('seo_author') }}"
                                placeholder="Enter author">
                            @if ($errors->has('seo_author'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_author') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="seo_description">SEO Description</label>
                            <textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}" name="seo_description"
                                id="seo_description" rows="4" placeholder="Enter SEO description">{{ old('seo_description') }}</textarea>
                            @if ($errors->has('seo_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_description') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="seo_robots">SEO Robots</label>
                            <select class="form-control {{ $errors->has('seo_robots') ? 'is-invalid' : '' }}"
                                name="seo_robots" id="seo_robots">
                                <option value="">Select robots</option>
                                <option value="index,follow" {{ old('seo_robots') == 'index,follow' ? 'selected' : '' }}>
                                    index,follow
                                </option>
                                <option value="index,nofollow" {{ old('seo_robots') == 'index,nofollow' ? 'selected' : '' }}>
                                    index,nofollow
                                </option>
                                <option value="noindex,follow" {{ old('seo_robots') == 'noindex,follow' ? 'selected' : '' }}>
                                    noindex,follow
                                </option>
                                <option value="noindex,nofollow" {{ old('seo_robots') == 'noindex,nofollow' ? 'selected' : '' }}>
                                    noindex,nofollow
                                </option>
                            </select>
                            @if ($errors->has('seo_robots'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_robots') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="seo_canonical_url">Canonical URL</label>
                            <input class="form-control {{ $errors->has('seo_canonical_url') ? 'is-invalid' : '' }}"
                                type="url" name="seo_canonical_url" id="seo_canonical_url"
                                value="{{ old('seo_canonical_url') }}" placeholder="https://example.com/page">
                            @if ($errors->has('seo_canonical_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_canonical_url') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="seo_image">SEO Image</label>
                            <input class="form-control {{ $errors->has('seo_image') ? 'is-invalid' : '' }}"
                                type="file" name="seo_image" id="seo_image" accept="image/*">
                            @if ($errors->has('seo_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_image') }}
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
