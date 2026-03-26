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

            <p> <i class="fi fi-br-list mr_15_icc"></i> {{ trans('cruds.slider.title') }} {{ trans('global.list') }}
                {{-- @can('user_create') --}}
            </p>
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success " href="{{ route('admin.slider.create') }}">
                        <i class="fi fi-br-plus-small mr_5"></i>
                        {{ trans('global.add') }} Slider
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
                                {{ trans('cruds.slider.fields.image') }}
                            </th>
                            <th>
                                <i class="fi fi-br-apps-add ictabl"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slider as $key => $slid)
                            <tr>
                                <td><img src="{{ asset($slid->image) }}"
                                        style="width:80px;height:50px;object-fit:cover;"></td>
                                <td>
                                    <div class="action-buttons">

                                        {{-- @can('user_edit') --}}
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.slider.edit',$slid->id) }}">
                                            <!-- {{ trans('global.edit') }}  -->
                                            <i class="fi fi-br-list"></i>
                                        </a>
                                        {{-- @endcan --}}

                                        {{-- @can('user_delete') --}}
                                        <form action="{{ route('admin.slider.delete',$slid->id)}}" method="POST"
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
