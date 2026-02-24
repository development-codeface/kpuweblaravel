@extends('layouts.admin')

@section('content')
<div class="card w_80">
    <div class="card-header">
        <p>
            <i class="fi fi-br-edit mr_15_icc"></i>
            Edit Article
        </p>
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.articles.update', $article->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="form-group">
                <label class="required">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title', $article->title) }}"
                       required>
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label class="required">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}"
                            {{ $article->category_id == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author --}}
            <div class="form-group">
                <label class="required">Author</label>
                <select name="author_id" class="form-control" required>
                    @foreach($authors as $id => $name)
                        <option value="{{ $id }}"
                            {{ $article->author_id == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Magazine Issue --}}
            <div class="form-group">
                <label>Magazine Issue</label>
                <select name="issue_id" class="form-control">
                    <option value="">No Issue</option>
                    @foreach($issues as $id => $title)
                        <option value="{{ $id }}"
                            {{ $article->issue_id == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Existing Cover Image --}}
            @if($article->featured_image_url)
                <div class="form-group">
                    <label>Current Cover Image</label><br>
                    <img src="{{ asset($article->featured_image_url) }}"
                         style="max-width: 300px; border-radius: 5px;">
                </div>
            @endif

            {{-- Change Cover Image --}}
            <div class="form-group">
                <label>Change Cover Image</label>
                <input type="file"
                       name="featured_image"
                       class="form-control"
                       accept="image/*">
            </div>

            {{-- Summary --}}
            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary"
                          class="form-control"
                          rows="3">{{ old('summary', $article->summary) }}</textarea>
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label class="required">Content</label>
                <textarea name="content"
                          id="editor"
                          class="form-control"
                          rows="10">{{ old('content', $article->content) }}</textarea>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>
                        Published
                    </option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="form-group">
                <button class="btn btn-success min-w-200">
                    Update Article
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
