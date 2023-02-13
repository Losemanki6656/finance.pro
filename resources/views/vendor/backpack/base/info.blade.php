@extends(backpack_view('blank'))


@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'info'),
        "Инструкция" => url(config('backpack.base.route_prefix'), 'info'),
    ];
    
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize"> Инструкция </span>
            <small id="datatable_info_stack">  по работе с программой </small>
        </h2>
    </div>
@endsection

@section('content')
    <div id="loader">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="">
        <div class="">
            <p>
                <button class="btn btn-danger" type="button" data-toggle="collapse" data-target=".multi-collapse"
                    aria-expanded="false" aria-controls="multiCollapseExample1"> <i class="la la-ban"></i> Коды ошибок</button>
            </p>
            <div class="row">
                <div class="col-6">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <label>
                                <span>
                                    <div class="circle bg-danger">
                                        <span class="circle__content"><i class='nav-icon la la-ban'></i></span>
                                    </div>
                                </span> <span> - Данные не были сформированы.</span>
                            </label>
                            <label>
                                <span class="badge badge-danger text-white">
                                    <i class='nav-icon la la-ban'></i> 100
                                </span> -  <span>Пользователь не найден</span>
                            </label>
                            <label>
                                <span class="badge badge-warning text-white">
                                    <i class='nav-icon la la-ban'></i> 101
                                </span> -  <span>Пользователь не ввел никакой информации.</span>
                            </label>
                            <label>
                                <span class="badge badge-secondary text-dark">
                                    <i class='nav-icon la la-ban'></i> 102
                                </span> -  <span>Произошла ошибка расчета.</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <p>
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target=".multi-collapse1"
                    aria-expanded="false" aria-controls="multiCollapseExample2"> <i class="la la-check-circle"></i> Успешные знаки</button>
            </p>
            <div class="row">
                <div class="col-6">
                    <div class="collapse multi-collapse1 show" id="multiCollapseExample2">
                        <div class="card card-body">
                            <label>
                                <span>
                                    <div class="circle bg-success">
                                        <span class="circle__content"><i class='nav-icon la la-check'></i></span>
                                    </div>
                                </span> <span> - Данные были успешно сформированы.
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('after_styles')
<style>
    .circle {
        display: inline-table;
        vertical-align: middle;
        width: 24px;
        height: 24px;
        border-radius: 50%;
    }

    .circle__content {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }
</style>

@endsection

@section('after_scripts')
   \
@endsection
