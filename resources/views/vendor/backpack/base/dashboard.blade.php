@extends(backpack_view('blank'))


@php
    $defaultBreadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        'Статистика' => url(config('backpack.base.route_prefix'), 'dashboard'),
    ];

    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('content')
    <div id="loader">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="container-xl">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col flex-shrink-0 mb-5 mb-md-0">
                <h1>Статистика</h1>
                <div class="text-muted">барча корхоналар бўйича</div>
            </div>
            <div class="col-12 col-md-auto">

            </div>
        </div>
        <div class="row align-items-center">

            <div class="col-sm-6 col-lg-6">
                <div class="card border-0">
                    <form id="shaxmatka" action="{{ route('export_shaxmatka') }}" method="get">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="text-value" id="result">
                                    <span>Шахматка Балансы </span>
                                </div>
                                <h6>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="year_exam"
                                                    onchange="myFilter()">
                                                <option value="2019"
                                                        @if (request('year_consolidate') == 2019) selected @endif>
                                                    2019
                                                </option>
                                                <option value="2020"
                                                        @if (request('year_consolidate') == 2020) selected @endif>
                                                    2020
                                                </option>
                                                <option value="2021"
                                                        @if (request('year_consolidate') == 2021) selected @endif>
                                                    2021
                                                </option>
                                                <option value="2022"
                                                        @if (request('year_consolidate') == 2022) selected @endif>
                                                    2022
                                                </option>
                                                <option value="2023"
                                                        @if (request('year_consolidate') == 2023) selected @endif>
                                                    2023
                                                </option>
                                                <option value="2024"
                                                        @if (request('year_consolidate') == 2024) selected @endif>
                                                    2024
                                                </option>
                                                <option value="2025"
                                                        @if (request('year_consolidate') == 2025) selected @endif>
                                                    2025
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </h6>
                            </div>

                            <div class="mb-4">
                                <div><span class="text-danger" style="font-size: 17pt">{{ $organizations }} - </span>
                                    <span>пользователи не ввели никакой информации.</span>
                                    <span>
                                        <a href="{{ route('not_info_users', [
                                                'year_consolidate' => request('year_consolidate')
                                            ]) }}"
                                           class="btn btn-outline-danger btn-sm"> <i
                                                class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div><span class="text-warning" style="font-size: 17pt">{{ $falseCount }} - </span>
                                    <span>пользователи ввели неправильные информации.</span>
                                    <span>
                                        <a href="{{ route('error_info_users') }}"
                                           class="btn btn-outline-warning btn-sm"> <i
                                                class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div><span class="text-dark" style="font-size: 17pt">{{ $sumCount }} - </span>
                                    <span> Итог Шахматка.</span>
                                </div>
                            </div>

                            <div> Выбирайте год и нажмите Скачать</div>
                            <a type="button"
                               href="{{ route('all_update_balance', ['year_consolidate' => request('year_consolidate')]) }}"
                               class="btn btn-sm btn-danger"><i
                                    class="la la-clone"></i>
                                Сформировать</a>
                            <button type="submit" class="btn btn-sm btn-success"><i class="la la-download"></i>
                                Скачать
                            </button>
                            {{--                            <a href="{{ route('export_shaxmatka_view') }}" class="btn btn-sm btn-primary"><i--}}
                            {{--                                    class="la la-eye"></i> Просмотр</a>--}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6 col-lg-6">
                <div class="card border-0">
                    <form id="shaxmatka_oboroti" action="{{ route('export_oboroti_shaxmatka') }}" method="get">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="text-value" id="result">
                                    <span>Шахматка Обороты </span>
                                </div>
                                <h6>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="year_rev"
                                                    onchange="myFilterRev()">
                                                <option value="2020" @if (request('year_rev') == 2020) selected @endif>
                                                    2020
                                                </option>
                                                <option value="2021" @if (request('year_rev') == 2021) selected @endif>
                                                    2021
                                                </option>
                                                <option value="2022" @if (request('year_rev') == 2022) selected @endif>
                                                    2022
                                                </option>
                                                <option value="2023" @if (request('year_rev') == 2023) selected @endif>
                                                    2023
                                                </option>
                                                <option value="2024" @if (request('year_rev') == 2024) selected @endif>
                                                    2024
                                                </option>
                                                <option value="2025" @if (request('year_rev') == 2025) selected @endif>
                                                    2025
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </h6>
                            </div>

                            <div class="mb-4">
                                <div><span class="text-danger"
                                           style="font-size: 17pt">{{ $organizationsRev }} - </span>
                                    <span>пользователи не ввели никакой информации.</span>
                                    <span>
                                        <a href="{{ route('not_info_oborot_users', [
                                                'year_rev' => request('year_rev')
                                            ]) }}"
                                           class="btn btn-outline-danger btn-sm"> <i
                                                class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div><span class="text-warning"
                                           style="font-size: 17pt">{{ $falseCountRev }} - </span>
                                    <span>пользователи ввели неправильные информации.</span>
                                    <span>
                                        <a href="{{ route('error_info_oborot_users') }}"
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div><span class="text-dark" style="font-size: 17pt">{{ $sumCountRev }} - </span>
                                    <span> Итог Шахматка.</span>
                                </div>
                            </div>

                            <div> Выбирайте год и нажмите Скачать</div>

                            <a type="button"
                               href="{{ route('all_update_oboroti', ['year_rev' => request('year_rev')]) }}"
                               class="btn btn-sm btn-danger"><i
                                    class="la la-clone"></i>
                                Сформировать</a>
                            <button type="submit" class="btn btn-sm btn-success"><i class="la la-download"></i>
                                Скачать
                            </button>
                            {{--                            <a href="{{ route('export_shaxmatka_oborot_view') }}" class="btn btn-sm btn-primary"><i--}}
                            {{--                                    class="la la-eye"></i> Просмотр</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

@section('after_scripts')
    <script>
        function myFilter() {
            let year = $('#year_exam').val();
            location.href = 'dashboard?year_consolidate=' + year;
        }

        function myFilterRev() {
            let year = $('#year_rev').val();
            location.href = 'dashboard?year_rev=' + year;
        }
    </script>
    <script>
        $(document).ready(function (e) {

            let status = '{{ isset($status) ? $status : '' }}';
            let message = '{{ isset($message) ? $message : '' }}';

            if (status === 'success') {
                swal({
                    'icon': 'success',
                    'title': '{{ __('Success') }}',
                    'text': message
                });
            }

            if (status === 'error') {
                swal({
                    'icon': 'error',
                    'title': '{{ __('Error') }}',
                    'text': message
                });
            }

            $('#shaxmatka').submit(function (e) {

                $("#loader").fadeIn(300);
                setTimeout(function () {
                    $("#loader").fadeOut(300);
                    swal({
                        'icon': 'success',
                        'title': '{{ __('Success') }}',
                        'text': message
                    });
                }, 20000)


            });

            $('#shaxmatka_oboroti').submit(function (e) {

                $("#loader").fadeIn(300);
                setTimeout(function () {
                    $("#loader").fadeOut(300);
                    swal({
                        'icon': 'success',
                        'title': '{{ __('Success') }}',
                        'text': message
                    });
                }, 20000)


            });
        })
    </script>
@endsection
