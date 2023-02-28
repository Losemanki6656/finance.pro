{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);
    $id = $entry->id;
    if (is_array($value)) {
        $value = json_encode($value);
    }
@endphp

@if ($value == 3)
    <div class="circle bg-success" style="float: left">
        <span class="circle__content"><i class='nav-icon la la-check'></i></span>
    </div>
@elseif($value == 1)
    <div class="circle bg-danger" style="float: left">
        <span class="circle__content" data-toggle="tooltip" data-placement="top" title="Данные не были сформированы">
            <i class='nav-icon la la-ban'></i></span>
    </div>
@elseif($value == 4)
    <span class="badge badge-secondary text-dark" data-toggle="tooltip" data-placement="top"
        title="Произошла ошибка расчета"><i class='nav-icon la la-ban'></i>102</span>
@elseif($value == 5)
    <span class="badge badge-warning text-white" data-toggle="tooltip" data-placement="top"
        title="Пользователь не ввел никакой информации"><i class='nav-icon la la-ban'></i>101</span>
@elseif($value == 6)
    <span class="badge badge-dark text-white" data-toggle="tooltip" data-placement="top"
        title="Неправильное сальдо"><i class='nav-icon la la-ban'></i>103</span>
@else
    <span class="badge badge-danger text-white" data-toggle="tooltip" data-placement="top"
        title="Пользователь не найден"><i class='nav-icon la la-ban'></i>100</span>
@endif

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

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
