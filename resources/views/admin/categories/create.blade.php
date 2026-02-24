@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-plus mr_15_icc"></i> Create Category</p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="category_name" class="form-label required">Category Name</label>
                            <input type="text" id="category_name" name="category_name"
                                class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}">
                            @if ($errors->has('category_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label required">Description</label>
                            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                rows="4"></textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category_subtitle" class="form-label required">Category Subtitle</label>
                            <textarea id="category_subtitle" name="category_subtitle"
                                class="form-control {{ $errors->has('category_subtitle') ? 'is-invalid' : '' }}" rows="2"></textarea>
                            @if ($errors->has('category_subtitle'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category_subtitle') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="subtitle_description" class="form-label required">Description</label>
                            <textarea id="subtitle_description" name="subtitle_description"
                                class="form-control {{ $errors->has('subtitle_description') ? 'is-invalid' : '' }}" rows="4"></textarea>
                            @if ($errors->has('subtitle_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subtitle_description') }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="form-label fw-bold required">Banner Image</label>

                            <input type="file" name="banner_image" id="bannerImageInput"
                                class="d-none" accept="image/*"
                                onchange="showBannerPreview(this)">
                            <div class="border rounded p-3 text-center bg-light" style="cursor:pointer"
                                onclick="document.getElementById('bannerImageInput').click()">

                                <p id="bannerPlaceholder" class="text-muted mb-2">
                                    No image selected
                                </p>

                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    Add Image
                                </button>
                            </div>

                            <img id="bannerPreview" class="img-fluid mt-2 d-none"
                                style="max-height:200px;border:1px solid #ddd;">
                        </div>

                    </div>
                </div>

                <hr>
                <h5>Banner Slider</h5>

                <table class="table table-bordered" id="sliderTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="file" name="slider_image[]" class="d-none" accept="image/*"
                                    onchange="previewRowImage(this)">

                                <div class="border p-2 text-center" style="cursor:pointer"
                                    onclick="this.previousElementSibling.click()">
                                    <small class="text-muted">Add Image</small>
                                </div>

                                <img class="img-fluid mt-2 d-none" style="max-height:100px;">
                            </td>

                            <td>
                                <input type="text" name="slider_link[]" class="form-control"
                                    placeholder="https://example.com">
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="removeRow(this)">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-primary mb-3" onclick="addSliderRow()">
                    + Add Row
                </button>

                <br>

                <button class="btn btn-success min-w-200">
                    Save Category
                </button>

            </form>
        </div>


    </div>
    <script>
        function showBannerPreview(input) {
            const preview = document.getElementById('bannerPreview');
            const placeholder = document.getElementById('bannerPlaceholder');

            if (input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('d-none');
                placeholder.innerText = input.files[0].name;
            }
        }

        function previewRowImage(input) {
            const img = input.nextElementSibling.nextElementSibling;
            img.src = URL.createObjectURL(input.files[0]);
            img.classList.remove('d-none');
        }


        function addSliderRow() {
            const table = document.querySelector('#sliderTable tbody');

            table.insertAdjacentHTML('beforeend', `
        <tr>
            <td>
                <input type="file" name="slider_image[]" class="d-none"
                    accept="image/*" onchange="previewRowImage(this)">
                <div class="border p-2 text-center"
                     style="cursor:pointer"
                     onclick="this.previousElementSibling.click()">
                    <small class="text-muted">Add Image</small>
                </div>
                <img class="img-fluid mt-2 d-none" style="max-height:100px;">
            </td>
            <td>
                <input type="text" name="slider_link[]" class="form-control"
                       placeholder="https://example.com">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm"
                        onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
    `);
        }

        function removeRow(btn) {
            btn.closest('tr').remove();
        }
    </script>
@endsection
