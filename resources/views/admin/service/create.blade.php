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

        #aboutMenu {
            position: sticky;
            top: 20px;
            /* distance from top */
        }
        .col-md-3 {
            align-self: flex-start;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} {{ trans('cruds.icu.title_singular') }} </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action show active" data-bs-toggle="tab"
                            href="#contentSection" role="tab">
                            menu
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#mid_content_Section"
                            role="tab">
                            content
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="contentSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Menu</h1>
                                    <hr>
                                    <div id="section-wrappers">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.service.menu.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="pages_id" value="{{ $id }}">

                                                <div id="content-wrapper">

                                                    @php
                                                        $oldNames = old(
                                                            'name',
                                                            isset($menu) && $menu->count()
                                                                ? $menu->pluck('name')->toArray()
                                                                : [''],
                                                        );

                                                        $oldIds = old(
                                                            'menu_id',
                                                            isset($menu) && $menu->count()
                                                                ? $menu->pluck('id')->toArray()
                                                                : [''],
                                                        );
                                                    @endphp

                                                    @foreach ($oldNames as $index => $name)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <!-- Hidden ID -->
                                                            <input type="hidden" name="menu_id[]"
                                                                value="{{ $oldIds[$index] ?? '' }}">

                                                            <!-- Name Field -->
                                                            <div class="form-group mt-2">
                                                                <label class="required">Name</label>

                                                                <input type="text" name="name[]"
                                                                    value="{{ $name }}"
                                                                    class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}">

                                                                @error('name.' . $index)
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <!-- Remove Button -->
                                                            {{-- <button type="button"
                                                                class="btn btn-danger btn-sm mt-2 removeRow">
                                                                Remove
                                                            </button> --}}

                                                        </div>
                                                    @endforeach

                                                </div>

                                                <!-- Add Row Button -->
                                                <button type="button" id="addContentRow" class="btn btn-primary mb-3">
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
                        <div class="tab-pane fade" id="mid_content_Section" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">content</h1>
                                    <hr>
                                    <div id="section-wrapper">
                                        <div class="section-item border p-3 mb-3">
                                            <form method="POST" action="{{ route('admin.service.content.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pages_id" value="{{ $id }}">

                                                <div id="feature-wrappers">
                                                    @php
                                                        $oldTitles = old('title');

                                                        if (!$oldTitles) {
                                                            if (isset($content) && $content->count()) {
                                                                $oldTitles = $content->pluck('title')->toArray();
                                                            } else {
                                                                $oldTitles = [''];
                                                            }
                                                        }

                                                        $oldDescriptions = old('description');

                                                        if (!$oldDescriptions) {
                                                            if (isset($content) && $content->count()) {
                                                                $oldDescriptions = $content
                                                                    ->pluck('description')
                                                                    ->toArray();
                                                            } else {
                                                                $oldDescriptions = [''];
                                                            }
                                                        }

                                                        $oldIds = old('content_id');

                                                        if (!$oldIds) {
                                                            if (isset($content) && $content->count()) {
                                                                $oldIds = $content->pluck('id')->toArray();
                                                            } else {
                                                                $oldIds = [''];
                                                            }
                                                        }

                                                        $oldMenus = old('menu');

                                                        if (!$oldMenus) {
                                                            if (isset($content) && $content->count()) {
                                                                $oldMenus = $content->pluck('menus_id')->toArray();
                                                            } else {
                                                                $oldMenus = [''];
                                                            }
                                                        }
                                                    @endphp

                                                    @foreach ($oldTitles as $index => $value)
                                                        <div class="feature-row border p-3 mb-3">

                                                            <!-- Hidden ID -->
                                                            <input type="hidden" name="content_id[]"
                                                                value="{{ $oldIds[$index] ?? '' }}">

                                                            <div class="form-group">
                                                                <label class="required">Menu</label>
                                                                <select name="menu[]"
                                                                    class="form-control {{ $errors->has('menu.' . $index) ? 'is-invalid' : '' }}">

                                                                    <option value="">Select Menu</option>

                                                                    @foreach ($menu as $m)
                                                                        <option value="{{ $m->id }}"
                                                                            {{ old('menu.' . $index, $oldMenus[$index] ?? '') == $m->id ? 'selected' : '' }}>
                                                                            {{ $m->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>

                                                                @error('menu.' . $index)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mt-2">
                                                                <label class="required">Title</label>
                                                                <input type="text" name="title[]"
                                                                    value="{{ $value }}"
                                                                    class="form-control {{ $errors->has('title.' . $index) ? 'is-invalid' : '' }}">

                                                                @error('title.' . $index)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mt-2">
                                                                <label class="required">Description</label>
                                                                <textarea name="description[]" class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}"
                                                                    rows="2">{{ $oldDescriptions[$index] ?? '' }}</textarea>

                                                                @error('description.' . $index)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            {{-- <button type="button"
                                                                class="btn btn-danger btn-sm mt-2 remove-row">
                                                                Remove
                                                            </button> --}}

                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" id="mid_addRow" class="btn btn-primary mb-3">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('imagePreview');
                    const triangle = document.getElementById('trianglePlaceholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewcontentImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('image-Preview');
                    const triangle = document.getElementById('triangle-Placeholder');

                    img.src = e.target.result;
                    img.style.display = 'block';
                    triangle.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        document.getElementById('addContentRow').addEventListener('click', function() {

            let wrapper = document.getElementById('content-wrapper');

            let html = `
    <div class="feature-row border p-3 mb-3">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name[]" class="form-control">
        </div>
        <button type="button"
                class="btn btn-danger btn-sm remove-row">
            Remove
        </button>
    </div>
    `;

            wrapper.insertAdjacentHTML('beforeend', html);
        });
        // ✅ Open file picker (works for dynamic rows)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.image-trigger')) {
                let row = e.target.closest('.feature-row');
                row.querySelector('.image-input').click();
            }
        });



        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });


        document.addEventListener('DOMContentLoaded', function() {

            let rowIndex = {{ count($oldContents ?? []) }};

            const addBtn = document.getElementById('mid_addRow');
            const wrapper = document.getElementById('feature-wrappers');

            if (!addBtn || !wrapper) {
                console.log('Button or wrapper not found');
                return;
            }

            addBtn.addEventListener('click', function() {

                let html = `
        <div class="feature-row border p-3 mb-3">
            <div class="form-group">
                <label class="required">Menu</label>
                <select name="menu[]" class="form-control">
                    <option value="">Select Menu</option>
                    @foreach ($menu as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label class="required">Title</label>
                <input type="text" name="title[]" class="form-control">
            </div>

            <div class="form-group mt-2">
                <label class="required">Description</label>
                <textarea name="description[]" class="form-control" rows="2"></textarea>
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-2 remove-row">
                Remove
            </button>

        </div>`;

                wrapper.insertAdjacentHTML('beforeend', html);
                rowIndex++;
            });
        });
    </script>
@endsection
