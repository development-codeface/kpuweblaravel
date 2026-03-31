@extends('layouts.admin')
@section('content')
    <style>
        .image-box {
            width: 180px;
            height: 220px;
            border: 1px dashed #c7c7c7;
            cursor: pointer;
            position: relative;
            overflow: hidden;
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

        #icuMenu {
            position: sticky;
            top: 20px;
        }

        .feature-row {
            border: 1px solid #d9d9d9;
            border-radius: 8px;
            background: #fbfbfb;
        }

        .feature-row .image-box {
            width: 100%;
            max-width: 220px;
            height: 200px;
        }

        .icu-tab-pane .section-title {
            margin-bottom: 0.35rem;
        }

        .icu-tab-pane .section-copy {
            margin-bottom: 1.5rem;
            color: #6c757d;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i> ICU Page CMS Builder</p>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group" id="icuMenu" role="tablist">
                        <a class="list-group-item list-group-item-action {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'active' : '' }}"
                            href="#bannerSection" role="tab">
                            ICU Banner
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'featureSection' ? 'active' : '' }}"
                            href="#featureSection" role="tab">
                            Core Values
                        </a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="tab-content" id="icuTabContent">
                        <div class="tab-pane fade icu-tab-pane {{ old('active_tab', 'bannerSection') == 'bannerSection' ? 'show active' : '' }}"
                            id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="section-title">Banner Section</h1>
                                    <p class="section-copy">Update the ICU page hero title, short copy, button text, and banner image.</p>

                                    <form method="POST" action="{{ route('admin.icu.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.icu.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" id="title"
                                                        value="{{ old('title', $banner->title ?? '') }}"
                                                        placeholder="Enter title">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.icu.fields.button_text') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}"
                                                        type="text" name="button_text" id="button_text"
                                                        value="{{ old('button_text', $banner->button_text ?? '') }}"
                                                        placeholder="Enter button text">
                                                    @if ($errors->has('button_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('button_text') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="description">{{ trans('cruds.icu.fields.description') }}</label>
                                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                        id="description" rows="3">{{ old('description', $banner->description ?? '') }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('description') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required">Image</label>
                                                    <div class="image-box"
                                                        onclick="document.getElementById('image').click();">
                                                        @if (isset($banner) && $banner->image)
                                                            <img src="{{ asset($banner->image) }}" id="imagePreview"
                                                                style="display:block;">
                                                        @else
                                                            <div class="triangle-placeholder" id="trianglePlaceholder"></div>
                                                            <img id="imagePreview" style="display:none;">
                                                        @endif
                                                    </div>

                                                    <input type="file" name="image" id="image" accept="image/*"
                                                        class="d-none {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                        onchange="previewImage(this)">

                                                    @if ($errors->has('image'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $errors->first('image') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-success min-w-200" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade icu-tab-pane {{ old('active_tab') == 'featureSection' ? 'show active' : '' }}"
                            id="featureSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="section-title">Core Values</h1>
                                    <p class="section-copy">This matches the About page feature form with repeatable icon, name, and description rows.</p>

                                    <form method="POST" action="{{ route('admin.icu.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="featureSection">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="feature_id" value="{{ $feature->id ?? '' }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="feature_title">{{ trans('cruds.feature.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('feature_title') ? 'is-invalid' : '' }}"
                                                        type="text" name="feature_title" id="feature_title"
                                                        value="{{ old('feature_title', $feature->title ?? '') }}"
                                                        placeholder="Enter title">
                                                    @if ($errors->has('feature_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('feature_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="feature_sub_title">{{ trans('cruds.feature.fields.sub_title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('feature_sub_title') ? 'is-invalid' : '' }}"
                                                        type="text" name="feature_sub_title" id="feature_sub_title"
                                                        value="{{ old('feature_sub_title', $feature->sub_title ?? '') }}"
                                                        placeholder="Enter sub title">
                                                    @if ($errors->has('feature_sub_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('feature_sub_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div id="feature-wrapper">
                                            @php
                                                if (old('name')) {
                                                    $existingIcons = old('existing_feature_icon', []);
                                                    $rows = collect(old('name'))->map(function ($name, $index) use ($existingIcons) {
                                                        return (object) [
                                                            'id' => old('content_id')[$index] ?? null,
                                                            'icon' => $existingIcons[$index] ?? '',
                                                            'name' => $name ?? '',
                                                            'description' => old('feature_description')[$index] ?? '',
                                                        ];
                                                    });
                                                } else {
                                                    $rows =
                                                        isset($feature) && $feature->featureContents->count()
                                                            ? $feature->featureContents
                                                            : collect([
                                                                (object) [
                                                                    'id' => null,
                                                                    'icon' => '',
                                                                    'name' => '',
                                                                    'description' => '',
                                                                ],
                                                            ]);
                                                }
                                            @endphp

                                            @foreach ($rows as $index => $row)
                                                <div class="feature-row p-3 mb-3">
                                                    <input type="hidden" name="content_id[]"
                                                        value="{{ $row->id }}">
                                                    <input type="hidden" name="existing_feature_icon[]"
                                                        value="{{ $row->icon }}">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required">Icon</label>
                                                                <div class="image-box image-trigger">
                                                                    @if (!empty($row->icon))
                                                                        <img src="{{ asset($row->icon) }}"
                                                                            class="image-preview"
                                                                            style="display:block;">
                                                                    @else
                                                                        <div class="triangle-placeholder"></div>
                                                                        <img class="image-preview"
                                                                            style="display:none;">
                                                                    @endif
                                                                </div>

                                                                <input type="file" name="feature_icon[]"
                                                                    accept="image/*"
                                                                    class="d-none image-input {{ $errors->has('feature_icon.' . $index) ? 'is-invalid' : '' }}">
                                                                @if ($errors->has('feature_icon.' . $index))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('feature_icon.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required">Name</label>
                                                                <input type="text" name="name[]"
                                                                    value="{{ $row->name }}"
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
                                                                <textarea name="feature_description[]"
                                                                    class="form-control {{ $errors->has('feature_description.' . $index) ? 'is-invalid' : '' }}"
                                                                    rows="2">{{ $row->description }}</textarea>
                                                                @if ($errors->has('feature_description.' . $index))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('feature_description.' . $index) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-danger btn-sm remove-row">
                                                        Remove
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <button type="button" id="addRow" class="btn btn-primary mb-3">
                                            + Add Row
                                        </button>

                                        <div class="form-group">
                                            <button class="btn btn-success min-w-200" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (!input.files || !input.files[0]) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                const image = document.getElementById('imagePreview');
                const triangle = document.getElementById('trianglePlaceholder');

                if (image) {
                    image.src = event.target.result;
                    image.style.display = 'block';
                }

                if (triangle) {
                    triangle.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        function previewDynamicRowImage(input) {
            if (!input.files || !input.files[0]) {
                return;
            }

            const row = input.closest('.feature-row');
            const preview = row ? row.querySelector('.image-preview') : null;
            const placeholder = row ? row.querySelector('.triangle-placeholder') : null;

            if (!preview) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block';

                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(input.files[0]);
        }

        function bindAddRow(buttonId, wrapperId, html) {
            const button = document.getElementById(buttonId);
            const wrapper = document.getElementById(wrapperId);

            if (!button || !wrapper) {
                return;
            }

            button.addEventListener('click', function() {
                wrapper.insertAdjacentHTML('beforeend', html);
            });
        }

        function initIcuTabs() {
            const menu = document.getElementById('icuMenu');
            const content = document.getElementById('icuTabContent');

            if (!menu || !content) {
                return;
            }

            const links = Array.from(menu.querySelectorAll('a[href^="#"]'));
            const panes = Array.from(content.querySelectorAll('.tab-pane'));
            const activeTabInputs = Array.from(document.querySelectorAll('input[name="active_tab"]'));
            const storageKey = 'icuCmsActiveTab';

            const setTabState = function(tabKey, persistState = true) {
                const pane = document.getElementById(tabKey);
                const link = menu.querySelector(`a[href="#${tabKey}"]`);

                if (!pane || !link) {
                    return;
                }

                links.forEach(function(item) {
                    item.classList.toggle('active', item === link);
                });

                panes.forEach(function(item) {
                    const isActive = item === pane;
                    item.classList.toggle('show', isActive);
                    item.classList.toggle('active', isActive);
                });

                activeTabInputs.forEach(function(input) {
                    input.value = tabKey;
                });

                if (!persistState) {
                    return;
                }

                try {
                    window.localStorage.setItem(storageKey, tabKey);
                } catch (error) {
                    console.warn('Unable to store active ICU tab.', error);
                }

                const nextUrl = `${window.location.pathname}${window.location.search}#${tabKey}`;

                if (window.history && window.history.replaceState) {
                    window.history.replaceState(null, '', nextUrl);
                } else {
                    window.location.hash = tabKey;
                }
            };

            links.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    setTabState(this.getAttribute('href').replace('#', ''));
                });
            });

            let initialTab = window.location.hash ? window.location.hash.replace('#', '') : '';

            if (!initialTab) {
                try {
                    initialTab = window.localStorage.getItem(storageKey) || '';
                } catch (error) {
                    initialTab = '';
                }
            }

            if (!initialTab) {
                const serverActiveLink = menu.querySelector('.list-group-item.active');
                initialTab = serverActiveLink ? serverActiveLink.getAttribute('href').replace('#', '') : '';
            }

            if (!initialTab && links.length) {
                initialTab = links[0].getAttribute('href').replace('#', '');
            }

            if (initialTab) {
                setTabState(initialTab, false);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initIcuTabs();

            bindAddRow('addRow', 'feature-wrapper', `
                <div class="feature-row p-3 mb-3">
                    <input type="hidden" name="content_id[]" value="">
                    <input type="hidden" name="existing_feature_icon[]" value="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">Icon</label>
                                <div class="image-box image-trigger">
                                    <div class="triangle-placeholder"></div>
                                    <img class="image-preview" style="display:none;">
                                </div>
                                <input type="file" name="feature_icon[]" accept="image/*" class="d-none image-input">
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
                                <textarea name="feature_description[]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        Remove
                    </button>
                </div>
            `);

            document.addEventListener('click', function(event) {
                const imageTrigger = event.target.closest('.image-trigger');

                if (imageTrigger) {
                    const row = imageTrigger.closest('.feature-row');
                    const input = row ? row.querySelector('.image-input') : null;

                    if (input) {
                        input.click();
                    }
                }

                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('.feature-row');

                    if (row) {
                        row.remove();
                    }
                }
            });

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('image-input')) {
                    previewDynamicRowImage(event.target);
                }
            });
        });
    </script>
@endsection
