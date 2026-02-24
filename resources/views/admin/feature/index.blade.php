@extends('layouts.admin')
@section('content')
    <style>
        td .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
    <div class="card">
        <div class="card-header">

            <p> <i class="fi fi-br-list mr_15_icc"></i> {{ trans('cruds.feature.title') }} {{ trans('global.list') }}
                {{-- @can('user_create') --}}
            </p>
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success " href="{{ route('admin.feature.create') }}">
                        <i class="fi fi-br-plus-small mr_5"></i>
                        {{ trans('global.add') }} {{ trans('cruds.feature.title_singular') }}
                    </a>
                </div>
            </div>
            {{-- @endcan --}}
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fi fi-br-check mr-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                             <th>
                                {{ trans('cruds.feature.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.feature.fields.sub_title') }}
                            </th>
                            <th>
                                <i class="fi fi-br-apps-add ictabl"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $key => $feature)
                            <tr>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->sub_title  }} </td>
                                <td>
                                    <div class="action-buttons">

                                        {{-- @can('user_edit') --}}
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.feature.edit',$feature->id) }}">
                                            <!-- {{ trans('global.edit') }}  -->
                                            <i class="fi fi-br-list"></i>
                                        </a>
                                        {{-- @endcan --}}

                                        {{-- @can('user_delete') --}}
                                        <form action="{{ route('admin.feature.destroy',$feature->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button input type="submit" class="btn btn-xs btn-danger" value="">
                                                <i class="fi fi-br-trash"></i> </button>
                                        </form>
                                        {{-- @endcan --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('css/vendor/global/global.min.js') }}"></script>
    <script>

        setTimeout(() => {
            let alert = document.querySelector('.alert-success');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 3000);
    </script>
@endsection
