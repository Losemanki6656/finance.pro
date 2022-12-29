<?php

namespace App\Http\Controllers\Admin;

use App\Models\Management;
use App\Models\Railway;

use App\Http\Requests\OrganizationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrganizationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrganizationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Organization');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/organization');
        $this->crud->setEntityNameStrings('organization', 'organizations');

          $this->crud->addFilter([
            'name'  => 'railway_id',
            'type'  => 'select2',
            'label' => 'Railway'
          ], function() {
              return \App\Models\Railway::all()->pluck('name', 'id')->toArray();
          }, function($value) { // if the filter is active
              $this->crud->addClause('where', 'railway_id', $value);
          });
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'label' => '№'
        ]);

        $this->crud->addColumn([
            'name' => 'railway_id',
            'label' => 'Railway'
        ]);


        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Name'
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);
        
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(OrganizationRequest::class);

        $this->crud->addField(
            [
                'label' => 'Management',
                'type' => 'select2',
                'name' => 'management_id',
                'entity' => 'management',
                'model' => Management::class,
                'attribute' => 'name',
                'default'   => 1
            ]);

            $this->crud->addField(
                [
                    'label' => 'Railway',
                    'type' => 'select2',
                    'name' => 'railway_id',
                    'entity' => 'railway',
                    'model' => Railway::class,
                    'attribute' => 'name',
                    'default'   => 1
                ]);

        $this->crud->addField(
            [
                'label' => 'Name',
                'type' => 'text',
                'name' => 'name'
            ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
