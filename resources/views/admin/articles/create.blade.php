@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <p>
                <i class="fi fi-br-edit mr_15_icc"></i>
                Create Article
            </p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="form-group">
                    <label class="required">Title</label>
                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label class="required">Category</label>
                    <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                        required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Author --}}
                <div class="form-group">
                    <label class="required">Author</label>
                    <select name="author_id" class="form-control {{ $errors->has('author_id') ? 'is-invalid' : '' }}"
                        required>
                        @foreach ($authors as $id => $name)
                            <option value="{{ $id }}" {{ old('author_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Magazine Issue --}}
                <div class="form-group">
                    <label>Magazine Issue</label>
                    <select name="issue_id" class="form-control">
                        <option value="">No Issue</option>
                        @foreach ($issues as $id => $title)
                            <option value="{{ $id }}" {{ old('issue_id') == $id ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cover Image --}}
                <div class="form-group">
                    <label>Cover Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                    <small class="text-muted">
                        Recommended: 1200×600 (jpg / png)
                    </small>
                </div>

                {{-- Summary --}}
                <div class="form-group">
                    <label>Summary</label>
                    <textarea name="summary" class="form-control" rows="3">{{ old('summary') }}</textarea>
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label class="required">Content</label>
                    <textarea name="content" id="editor" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                        rows="10" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="form-group">
                    <button class="btn btn-success min-w-200">
                        Save Article
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 350,
            filebrowserUploadUrl: "{{ route('admin.article.image.upload') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
