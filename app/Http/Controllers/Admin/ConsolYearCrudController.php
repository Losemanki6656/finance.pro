<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsolYearRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ConsolYearCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ConsolYear');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/consolyear');
        $this->crud->setEntityNameStrings('год', 'Год Баланс ВГО');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'label' => '№'
        ]);

        $this->crud->addColumn([
            'name' => 'year_consol',
            'label' => 'Год'
        ]);


        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Статус',
            'type' => 'view',
            'view' => 'backpack::crud.status_year',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ConsolYearRequest::class);

        $this->crud->addField([
            'name' => 'year_consol',
            'label' => 'Год',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name' => 'status',
            'label' => 'Статус'
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
