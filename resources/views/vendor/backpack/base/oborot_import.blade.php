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
            <span class="text-capitalize"> Импорт файл Обороты   </span>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Excel</strong> Form</div>

                <form id="excel-form" class="form-horizontal" action="{{ route('oborot_import.post') }}" method="post"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="file">Файл</label>
                            <div class="col-md-9">
                                <input class="form-control" id="hf-email" type="file" name="file"
                                    placeholder="select  file ..." required>
                                <span class="help-block">Please select your file</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="file">{{ __('Год') }}</label>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="year"
                                       value="{{$year ?? now()->format('Y')}}" placeholder="Год ..." required>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-danger" type="reset"><i class="la la-ban"></i> Отмена</button>
                        <button class="btn btn-success" type="submit"><i class="la la-check-circle"></i>
                            Старт </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
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

            $('#excel-form').submit(function(e) {

                $("#loader").fadeIn(300);
                setTimeout(function() {
                    $("#loader").fadeOut(300);
                }, 5000)
            });
        })
    </script>
@endsection
