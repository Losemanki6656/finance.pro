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

            <div class="col-sm-6 col-lg-4">
                <div class="card border-0">
                    <form id="shaxmatka" action="{{ route('export_shaxmatka') }}" method="get">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="text-value" id="result">
                                    <span class="">Шахматка Балансы
                                </div>
                                <h6>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="year_exam"
                                                onchange="myFilter()">

                                                <option value="2020" @if (request('year_exam') == 2020) selected @endif>
                                                    2020
                                                </option>
                                                <option value="2021" @if (request('year_exam') == 2021) selected @endif>
                                                    2021
                                                </option>
                                                <option value="2022" @if (request('year_exam') == 2022) selected @endif>
                                                    2022
                                                </option>
                                                <option value="2023" @if (request('year_exam') == 2023) selected @endif>
                                                    2023
                                                </option>
                                                <option value="2024" @if (request('year_exam') == 2024) selected @endif>
                                                    2024
                                                </option>
                                                <option value="2025" @if (request('year_exam') == 2025) selected @endif>
                                                    2025
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </h6>
                            </div>

                            <div class="mb-4">
                                <div> <span class="text-danger" style="font-size: 17pt">{{ $organizations }} - </span>
                                    <span>пользователи не ввели никакой информации.</span> 
                                    <span>
                                        <a href="{{route('not_info_users')}}" class="btn btn-outline-danger btn-sm"> <i class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div> <span class="text-success" style="font-size: 17pt">{{ $trueCount }} - </span>
                                    <span>пользователи ввели правильные информации.</span>
                                </div>
                                <div> <span class="text-warning" style="font-size: 17pt">{{ $falseCount }} - </span>
                                    <span>пользователи ввели неправильные информации.</span>
                                    <span>
                                        <a href="{{ route('error_info_users') }}" class="btn btn-outline-warning btn-sm"> <i class="la la-eye"></i> Просмотр </a>
                                    </span>
                                </div>
                                <div> <span class="text-dark" style="font-size: 17pt">{{ $summCount }} - </span>
                                    <span> Итог Шахматка.</span>
                                </div>
                            </div>

                            <div> Выбирайте год и нажмите Скачать</div>
                            <button type="submit" class="btn btn-sm btn-success"><i class="la la-download"></i>
                                Скачать</button>
                            <a href="{{ route('export_shaxmatka_view') }}" class="btn btn-sm btn-primary"><i
                                    class="la la-eye"></i> Просмотр</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card border-0">
                    <form id="shaxmatka" action="{{ route('export_shaxmatka') }}" method="get">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="text-value" id="result">
                                    <span class="">Шахматка Обороты
                                </div>
                                <h6>
                                    <div class="row">
                                        <div class="col">
                                            <select class="form-control form-control-sm" id="year_exam"
                                                onchange="myFilter()">

                                                <option value="2020" @if (request('year_exam') == 2020) selected @endif>
                                                    2020
                                                </option>
                                                <option value="2021" @if (request('year_exam') == 2021) selected @endif>
                                                    2021
                                                </option>
                                                <option value="2022" @if (request('year_exam') == 2022) selected @endif>
                                                    2022
                                                </option>
                                                <option value="2023" @if (request('year_exam') == 2023) selected @endif>
                                                    2023
                                                </option>
                                                <option value="2024" @if (request('year_exam') == 2024) selected @endif>
                                                    2024
                                                </option>
                                                <option value="2025" @if (request('year_exam') == 2025) selected @endif>
                                                    2025
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </h6>
                            </div>

                            <div class="mb-4">
                                <div> <span class="text-danger" style="font-size: 17pt">{{ $organizations }} - </span>
                                    <span>пользователи не ввели никакой информации.</span>
                                </div>
                                <div> <span class="text-success" style="font-size: 17pt">{{ $trueCount }} - </span>
                                    <span>пользователи ввели правильные информации.</span>
                                </div>
                                <div> <span class="text-warning" style="font-size: 17pt">{{ $falseCount }} - </span>
                                    <span>пользователи ввели неправильные информации.</span>
                                </div>
                                <div> <span class="text-dark" style="font-size: 17pt">{{ $summCount }} - </span>
                                    <span> Итог Шахматка.</span>
                                </div>
                            </div>

                            <div> Выбирайте год и нажмите Скачать</div>

                            <button type="submit" class="btn btn-sm btn-danger"><i class="la la-download"></i>
                                Скачать</button>
                            <a href="{{ route('export_shaxmatka_view') }}" class="btn btn-sm btn-info"><i
                                    class="la la-eye"></i> Просмотр</a>
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
        $(document).ready(function(e) {

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

            $('#shaxmatka').submit(function(e) {

                $("#loader").fadeIn(300);
                setTimeout(function() {
                    $("#loader").fadeOut(300);
                    swal({
                        'icon': 'success',
                        'title': '{{ __('Success') }}',
                        'text': message
                    });
                }, 10000)


            });
        })
    </script>
@endsection
