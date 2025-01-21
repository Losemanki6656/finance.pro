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
            <span class="text-capitalize"> пользователи которые ввели неправильные информации </span>
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
                <th>1-Организация</th>
                <th>2-Организация</th>
                <th>1-итог</th>
                <th>2-итог</th>
                <th class="text-center">Ошибка</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->send_name }}</td>
                    <td>{{ $item->rec_name }}</td>
                    <td style="font-weight: bold">{{ number_format($item->result_a, '0',' ', ' ') }}</td>
                    <td style="font-weight: bold">
                        @if (!$item->result_b)
                            <span class="badge badge-primary">Не найден</span>
                        @else
                            {{  number_format($item->result_b,'0',' ',' ') }}
                        @endif
                    </td>
                    <td style="font-weight: bold" class="text-danger text-center">
                        {{ number_format($item->result_a + $item->result_b,'0',' ',' ') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>1-Организация</th>
                <th>2-Организация</th>
                <th>1-итог</th>
                <th>2-итог</th>
                <th>Ошибка</th>
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
