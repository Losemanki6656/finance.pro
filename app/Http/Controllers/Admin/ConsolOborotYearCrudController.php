<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsolOborotYearRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ConsolOborotYearCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ConsolOborotYearCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ConsolOborotYear');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/consoloborotyear');
        $this->crud->setEntityNameStrings('год', 'Год Оборот ВГО');
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
        $this->crud->setValidation(ConsolOborotYearRequest::class);

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
