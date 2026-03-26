@php
    $seoImageHelperText = $seoImageHelperText ?? 'Leave empty if you do not need a separate SEO image.';
@endphp

<div class="row mt-4">
    <div class="col-md-12">
        <h5 class="mb-3">SEO Details</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="seo_title">SEO Title</label>
            <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text"
                name="seo_title" id="seo_title" value="{{ old('seo_title', $seo?->title) }}">
            @if ($errors->has('seo_title'))
                <div class="invalid-feedback">
                    {{ $errors->first('seo_title') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="seo_author">SEO Author</label>
            <input class="form-control {{ $errors->has('seo_author') ? 'is-invalid' : '' }}" type="text"
                name="seo_author" id="seo_author" value="{{ old('seo_author', $seo?->author) }}">
            @if ($errors->has('seo_author'))
                <div class="invalid-feedback">
                    {{ $errors->first('seo_author') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="seo_description">SEO Description</label>
            <textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}" name="seo_description"
                id="seo_description" rows="4">{{ old('seo_description', $seo?->description) }}</textarea>
            @if ($errors->has('seo_description'))
                <div class="invalid-feedback">
                    {{ $errors->first('seo_description') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="seo_robots">SEO Robots</label>
            <input class="form-control {{ $errors->has('seo_robots') ? 'is-invalid' : '' }}" type="text"
                name="seo_robots" id="seo_robots" value="{{ old('seo_robots', $seo?->robots) }}"
                placeholder="index,follow">
            @if ($errors->has('seo_robots'))
                <div class="invalid-feedback">
                    {{ $errors->first('seo_robots') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="seo_canonical_url">Canonical URL</label>
            <input class="form-control {{ $errors->has('seo_canonical_url') ? 'is-invalid' : '' }}" type="url"
                name="seo_canonical_url" id="seo_canonical_url"
                value="{{ old('seo_canonical_url', $seo?->canonical_url) }}">
            @if ($errors->has('seo_canonical_url'))
                <div class="invalid-feedback">
                    {{ $errors->first('seo_canonical_url') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="seo_image">SEO Image</label>
            <input class="form-control {{ $errors->has('seo_image') ? 'is-invalid' : '' }}" type="file"
                name="seo_image" id="seo_image" accept="image/*">
            @if ($errors->has('seo_image'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('seo_image') }}
                </div>
            @endif
            <small class="form-text text-muted">{{ $seoImageHelperText }}</small>
            @if (! empty($seo?->image))
                <small class="d-block mt-2">
                    Current SEO image:
                    <a href="{{ asset($seo->image) }}" target="_blank">{{ $seo->image }}</a>
                </small>
            @endif
        </div>
    </div>
</div>
