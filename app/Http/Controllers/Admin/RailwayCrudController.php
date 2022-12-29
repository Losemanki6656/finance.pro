<?php

namespace App\Http\Controllers\Admin;

use App\Models\Management;

use App\Http\Requests\RailwayRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RailwayCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RailwayCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    

    public function setup()
    {
        $this->crud->setModel('App\Models\Railway');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/railway');
        $this->crud->setEntityNameStrings('railway', 'railways');

        $this->crud->addFilter([
            'name'  => 'management_id',
            'type'  => 'select2',
            'label' => 'Management'
          ], function() {
              return \App\Models\Management::all()->pluck('name', 'id')->toArray();
          }, function($value) { // if the filter is active
              $this->crud->addClause('where', 'management_id', $value);
          });
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'label' => '№'
        ]);

        $this->crud->addColumn([
            'name' => 'management_id',
            'label' => 'Management'
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
        $this->crud->setValidation(RailwayRequest::class);

        // TODO: remove setFromDb() and manually define Fields
       // $this->crud->setFromDb();

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
