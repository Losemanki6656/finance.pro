{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);
    $id = $entry->id;
    if (is_array($value)) {
        $value = json_encode($value);
    }
@endphp

@if ($value)
    <div class="circle bg-success" style="float: left">
        <span class="circle__content"><i class='nav-icon la la-check'></i></span>
    </div>
@else
    <span class="badge badge-warning text-white"><i class='nav-icon la la-redo-alt'></i> в процессе ... </span>
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
