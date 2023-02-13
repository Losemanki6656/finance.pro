@extends(backpack_view('layouts.top_left'))

@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        __('Import') => url(config('backpack.base.route_prefix'), 'import'),
    ];
    
    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize"> Tasks </span>
            {{--<small id="datatable_info_stack"> {{ __('select your excel file') }} </small> --}}
        </h2>
    </div>
@endsection

@section('after_styles')
    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div id="loader">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="row">
        <div class="container-fluid">
            <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2"
                cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Row Count</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->file_name }}</td>
                            <td>{{ $item->row_count }} rows</td>
                            <td>{{ $item->date_vgo }}</td>
                            <td>
                                @if ($item->status == true)
                                    <span class="badge badge-success"> Successfully </span>
                                @else
                                    <span class="badge badge-primary"> Proceccing ... </span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status == true)
                                    <a type="button" href="{{ route('delete_task', ['id' => $item->id]) }}"
                                        class="btn btn-outline-danger btn-sm"> <i class="la la-trash"></i> Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Row Count</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
            var msg = '{{ Session::get('msg') }}';
            var exist = '{{ Session::has('msg') }}';
            if (exist) {
                if (msg == 1) {
                    swal({
                        'icon': 'success',
                        'title': '{{ __('Success') }}',
                        'text': 'Successfully deleted!'
                    });
                }
            }

        });
    </script>
@endsection
