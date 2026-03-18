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
                {{ trans('global.create') }} Medical Turism </p>
        </div>

        <div class="card-body">
            {{-- <div class="container-fluid"> --}}
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-md-3">
                    <div class="list-group" id="aboutMenu" role="tablist">

                        <a class="list-group-item list-group-item-action {{ old('active_tab','bannerSection') == 'bannerSection' ? 'active' : '' }}" data-bs-toggle="tab" href="#bannerSection"
                            role="tab">
                            Medical banner
                        </a>

                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'contentSection' ? 'active' : '' }}" data-bs-toggle="tab" href="#contentSection"
                            role="tab">
                            Medical content
                        </a>
                        <a class="list-group-item list-group-item-action {{ old('active_tab') == 'blogSection' ? 'active' : '' }}" data-bs-toggle="tab" href="#blogSection"
                            role="tab">
                            Medical Trip
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- ================= Banner Section ================= -->
                        <div class="tab-pane fade {{ old('active_tab','bannerSection') == 'bannerSection' ? 'show active' : '' }}" id="bannerSection" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h1 class="mb-3">Banner Section</h1>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.medical-turism.banner.store') }}"
                                        enctype="multipart/form-data">
                                         <input type="hidden" name="active_tab" value="bannerSection">
                                        <input type="hidden" name="pages_id" value="{{ $id }}">
                                        <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">
                                        @csrf

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="title">{{ trans('cruds.spaciality.fields.title') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                        type="text" name="title" placeholder="Enter title"
                                                        id="title" value="{{ old('title', $banner->title ?? '') }}">
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('title') }}
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="help-block">{{ trans('cruds.spaciality.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="button_text">{{ trans('cruds.spaciality.fields.button_text') }}</label>
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
                                                    <span
                                                        class="help-block">{{ trans('cruds.spaciality.fields.name_helper') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- LEFT -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="required" for="banner_description">
                                                        {{ trans('cruds.spaciality.fields.description') }}
                                                    </label>

                                                    <textarea class="form-control {{ $errors->has('banner_description') ? 'is-invalid' : '' }}" name="banner_description"
                                                        id="banner_description" rows="2">{{ old('banner_description', $banner->description ?? '') }}</textarea>

                                                    @if ($errors->has('banner_description'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('banner_description') }}
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
                                                                style="width:100%; display:block;">
                                                        @else
                                                            <div class="triangle-placeholder" id="trianglePlaceholder">
                                                            </div>
                                                            <img id="imagePreview" style="display:none;">
                                                        @endif
                                                    </div>
                                                    <input type="file" name="image" id="image" accept="image/*"
                                                        class="d-none {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                        onchange="previewImage(this)">

                                                    @if ($errors->has('image'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('image') }}
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
                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'contentSection' ? 'show active' : '' }}" id="contentSection" role="tabpanel">
                            <h1 class="mb-3">content Section</h1>
                            <hr>
                            <form method="POST" action="{{ route('admin.medical-turism.content.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                  <input type="hidden" name="active_tab" value="contentSection">
                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                <input type="hidden" name="content_id" value="{{ $content->id ?? '' }}">
                                <!-- Title -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Title</label>
                                            <input type="text" name="title"
                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                value="{{ old('title', $content->title ?? '') }}"
                                                placeholder="Enter title">

                                            @if ($errors->has('title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Sub Title -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Sub Title</label>
                                            <input type="text" name="sub_title"
                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                value="{{ old('sub_title', $content->sub_title ?? '') }}"
                                                placeholder="Enter sub title">

                                            @if ($errors->has('sub_title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('sub_title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Dynamic Content Rows -->
                                <div id="content-wrapper">
                                    @php
                                        $oldHeadings = old('heading');
                                        $oldDescriptions = old('description');
                                        $oldIds = old('sub_content_id');
                                        $oldIcon = old('icon');
                                        $dbContents =
                                            isset($content) && $content->subContents
                                                ? $content->subContents
                                                : collect();
                                    @endphp
                                    @if (is_array($oldHeadings))
                                        @foreach ($oldHeadings as $index => $value)
                                            <div class="feature-row border p-3 mb-3 position-relative">

                                                <input type="hidden" name="sub_content_id[]"
                                                    value="{{ $oldIds[$index] ?? '' }}">

                                                <div class="form-group">
                                                    <label class="required">Icon</label>
                                                    <input type="text" name="icon[]"
                                                        value="{{ old('icon.' . $index) }}"
                                                        class="form-control {{ $errors->has('icon.' . $index) ? 'is-invalid' : '' }}">

                                                    @if ($errors->has('icon.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('icon.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label class="required">Heading</label>
                                                    <input type="text" name="heading[]"
                                                        value="{{ old('heading.' . $index) }}"
                                                        class="form-control {{ $errors->has('heading.' . $index) ? 'is-invalid' : '' }}">

                                                    @if ($errors->has('heading.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('heading.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="description[]" rows="3"
                                                        class="form-control {{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}">{{ old('description.' . $index) }}</textarea>

                                                    @if ($errors->has('description.' . $index))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('description.' . $index) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(isset($content) && $dbContents->count())
                                        @foreach ($dbContents as $sub)
                                            <div class="feature-row border p-3 mb-3">
                                                <input type="hidden" name="sub_content_id[]"
                                                    value="{{ $sub->id }}">

                                                <div class="form-group">
                                                    <label class="required">Icon</label>
                                                    <input type="text" name="icon[]" value="{{ $sub->icon }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Heading</label>
                                                    <input type="text" name="heading[]" value="{{ $sub->heading }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group mt-2">
                                                    <label class="required">Description</label>
                                                    <textarea name="description[]" rows="3" class="form-control">{{ $sub->description }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="feature-row border p-3 mb-3">
                                            <input type="hidden" name="sub_content_id[]" value="">

                                            <div class="form-group">
                                                <label class="required">Icon</label>
                                                <input type="text" name="icon[]" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="required">Heading</label>
                                                <input type="text" name="heading[]" class="form-control">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label class="required">Description</label>
                                                <textarea name="description[]" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <!-- Add Row Button -->
                                <button type="button" id="addContentRow" class="btn btn-primary mb-3">
                                    + Add Row
                                </button>

                                <!-- Submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade {{ old('active_tab') == 'blogSection' ? 'show active' : '' }}" id="blogSection" role="tabpanel">
                            <h1 class="mb-3">content Section</h1>
                            <hr>
                            <form method="POST" action="{{ route('admin.medical-turism.medical.store') }}">
                                @csrf
                                   <input type="hidden" name="active_tab" value="blogSection">
                                <input name="medical_id" value="{{ $medical->id ?? '' }}" type="hidden">
                                <input type="hidden" name="pages_id" value="{{ $id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Title</label>
                                            <input type="text" name="title"
                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                value="{{ old('title', $medical->title ?? '') }}"
                                                placeholder="Enter title">

                                            @if ($errors->has('title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Sub Title -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">Sub Title</label>
                                            <input type="text" name="sub_title"
                                                class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                                value="{{ old('sub_title', $medical->sub_title ?? '') }}"
                                                placeholder="Enter sub title">

                                            @if ($errors->has('sub_title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('sub_title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="blog-wrapper">

                                    @php
                                        $medicalData = old(
                                            'medical',
                                            isset($medical) ? $medical->contents->toArray() : [[]],
                                        );
                                    @endphp
                                    @foreach ($medicalData as $index => $item)
                                        <div class="blog-row border p-3 mb-3">

                                            <input type="hidden" name="medical[{{ $index }}][content_id]"
                                                value="{{ $item['id'] ?? '' }}">

                                            <!-- Title -->
                                            <div class="form-group mt-2">
                                                <label>Heading</label>
                                                <input type="text" name="medical[{{ $index }}][heading]"
                                                    value="{{ old("medical.$index.heading", $item['heading'] ?? '') }}"
                                                    class="form-control @error("medical.$index.heading") is-invalid @enderror">

                                                @error("medical.$index.heading")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group mt-2">
                                                <label>Description</label>
                                                <textarea name="medical[{{ $index }}][description]"
                                                    class="form-control @error("medical.$index.description") is-invalid @enderror">{{ old("medical.$index.description", $item['description'] ?? '') }}</textarea>

                                                @error("medical.$index.description")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Texts -->
                                            <div class="form-group mt-3">
                                                <label>Texts</label>

                                                <div class="extra-text-wrapper">

                                                    @php
                                                        $texts = old(
                                                            "medical.$index.texts",
                                                            $item['subcontents'] ?? [['id' => '', 'text' => '']],
                                                        );
                                                    @endphp

                                                    @foreach ($texts as $tIndex => $textItem)
                                                        <div class="input-group mb-2">

                                                            <input type="hidden"
                                                                name="medical[{{ $index }}][texts][{{ $tIndex }}][sub_content_id]"
                                                                value="{{ $textItem['id'] ?? '' }}">

                                                            <input type="text"
                                                                name="medical[{{ $index }}][texts][{{ $tIndex }}][text]"
                                                                value="{{ $textItem['text'] ?? '' }}"
                                                                class="form-control">

                                                            {{-- <button type="button"
                                                                class="btn btn-danger remove-text">X</button> --}}

                                                        </div>
                                                    @endforeach

                                                </div>

                                                <button type="button" class="btn btn-info btn-sm add-extra-text mt-2">
                                                    + Add Text
                                                </button>
                                            </div>

                                        </div>
                                    @endforeach


                                </div>
                                <!-- Add Row Button -->
                                <button type="button" id="add-BlogRow" class="btn btn-primary mb-3">
                                    + Add Row
                                </button>

                                <!-- Submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
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
            <label>Heading</label>
            <input type="text" name="heading[]" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label>Description</label>
            <textarea class="form-control" name="description[]" rows="3"></textarea>
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


        //     document.getElementById('addBlogRow').addEventListener('click', function() {

        //         let wrapper = document.getElementById('blog-wrapper');

        //         let html = `
    // <div class="feature-row border p-3 mb-3">
    //     <div class="form-group">
    //                        <label class="required">Icon</label>
    //             <input type="text" name="icon[]" class="form-control" placeholder="Enter icon class">
    //     </div>
    //     <div class="form-group mt-2">
    //           <label class="required">Title</label>
    //             <input type="text" name="blog_title[]" class="form-control">
    //     </div>
    //     <div class="form-group mt-2">
    //                       <label class="required">Description</label>
    //             <textarea name="blog_description[]" rows="3" class="form-control"></textarea>
    //     </div>
    //     <button type="button"
    //             class="btn btn-danger btn-sm remove-row">
    //         Remove
    //     </button>
    // </div>
    // `;
        //         wrapper.insertAdjacentHTML('beforeend', html);
        //     });


        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.feature-row').remove();
            }
        });


        document.addEventListener("DOMContentLoaded", function() {

            let blogIndex = document.querySelectorAll('.blog-row').length;

            document.getElementById("add-BlogRow").addEventListener("click", function() {

                let wrapper = document.getElementById("blog-wrapper");

                let row = `
        <div class="blog-row border p-3 mb-3">
            <input type="hidden" name="medical[${blogIndex}][content_id]" value="">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="medical[${blogIndex}][title]" class="form-control">
            </div>

            <div class="form-group mt-2">
                <label>Description</label>
                <textarea name="medical[${blogIndex}][description]" class="form-control"></textarea>
            </div>

            <div class="form-group mt-3">
                <div class="extra-text-wrapper">
                     <input type="hidden" name="medical[${blogIndex}][texts][0][sub_content_id]" value="">
                    <div class="input-group mb-2">
                        <label>Text</label>
                        <input type="text" name="medical[${blogIndex}][texts][0][text]" class="form-control">
                        <button type="button" class="btn btn-danger remove-text">X</button>
                    </div>
                </div>
                <button type="button"
                        class="btn btn-info btn-sm add-extra-text mt-2">
                    + Add Text
                </button>
            </div>
        </div>`;

                wrapper.insertAdjacentHTML("beforeend", row);
                blogIndex++;
            });

            // Add text
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("add-extra-text")) {
                    let wrapper = e.target.closest(".blog-row")
                        .querySelector(".extra-text-wrapper");

                    let name = e.target.closest(".blog-row")
                        .querySelector("input").name;

                    let index = name.match(/medical\[(\d+)\]/)[1];

                    let textIndex = wrapper.querySelectorAll(".input-group").length;

                    wrapper.insertAdjacentHTML("beforeend", `
                <div class="input-group mb-2">
                      <input type="hidden"
                name="medical[${index}][texts][${textIndex}][sub_content_id]"
                value="">
                    <label>Text</label>
                    <input type="text"
                        name="medical[${index}][texts][${textIndex}][text]"
                        class="form-control">
                    <button type="button"
                        class="btn btn-danger remove-text">X</button>
                </div>
            `);
                }

                if (e.target.classList.contains("remove-text")) {
                    e.target.closest(".input-group").remove();
                }
            });

        });
    </script>
@endsection
