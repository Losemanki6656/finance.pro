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
            <span class="text-capitalize"> пользователи которые не ввели никакой информации </span>
            {{-- <small id="datatable_info_stack"> {{ __('select your excel file') }} </small> --}}
        </h2>
    </div>
@endsection

@section('content')
    <div id="loader">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2"
        cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Организация</th>
                <th>ИНН</th>
                <th>Пользователъ</th>
                <th>Э-почта</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->inn }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td><a href="">{{ $item->user->email }}</a></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Организация</th>
                <th>ИНН</th>
                <th>Пользователъ</th>
                <th>Э-почта</th>
            </tr>
        </tfoot>
    </table>
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
