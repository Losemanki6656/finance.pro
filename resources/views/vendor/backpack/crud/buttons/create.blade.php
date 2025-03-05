@if ($crud->hasAccess('create'))
    <a href="{{ url($crud->route . '/create') }}" class="btn btn-primary" data-style="zoom-in"><span
            class="ladda-label"><i
                class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}</span></a>
@endif
@if ($crud->route === 'admin/organization')
    <a href="{{ backpack_url('import') }}" class="btn btn-xs btn-success"><i class="la la-file-excel"></i> Импорт </a>
@endif

@if ($crud->route === 'admin/consolidated')
    <a href="{{ backpack_url('vgo-import') }}" class="btn btn-xs btn-success"><i class="la la-file-excel"></i> Импорт
    </a>
    <a href="{{ route('update_balance') }}" class="btn btn-xs btn-danger"><i class="las la-clone"></i> Сформировать </a>
@endif

@if ($crud->route === 'admin/consolidateoboroti')
    <a href="{{ backpack_url('oborot-import') }}" class="btn btn-xs btn-success"><i class="la la-file-excel"></i> Импорт
        Обороты</a>
    <a href="{{ route('update_oboroti') }}" class="btn btn-xs btn-danger"><i class="las la-clone"></i> Сформировать </a>
@endif

