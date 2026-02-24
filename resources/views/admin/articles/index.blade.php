@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <p><i class="fi fi-br-list"></i> Articles</p>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success">
            <i class="fi fi-br-plus"></i> Add Article
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->category_name ?? '-' }}</td>
                    <td>{{ $article->author->name ?? '-' }}</td>
                    <td>
                        <span class="badge badge-info">{{ $article->status }}</span>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-info"
                           href="{{ route('admin.articles.edit', $article->id) }}">
                            <i class="fi fi-br-edit"></i>
                        </a>

                        <form method="POST"
                              action="{{ route('admin.articles.destroy', $article->id) }}"
                              style="display:inline"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                <i class="fi fi-br-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
