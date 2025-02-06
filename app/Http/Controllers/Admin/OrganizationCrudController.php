<?php

namespace App\Http\Controllers\Admin;

use App\Models\Management;
use App\Models\Organization;
use App\Models\Railway;
use App\Models\User;

use App\Http\Requests\OrganizationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Http\Request;

class OrganizationCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;


    public function setup()
    {
        $this->crud->setModel('App\Models\Organization');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/organization');
        $this->crud->setEntityNameStrings('организация', 'Организацие');

        $this->crud->enableExportButtons();

        $this->crud->addFilter([
            'name' => 'railway_id',
            'type' => 'select2',
            'label' => 'Railway'
        ], function () {
            return Railway::all()->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'railway_id', $value);
        });

        $this->crud->addFilter([
            'name' => 'user_id',
            'type' => 'select2',
            'label' => 'User'
        ], function () {
            return User::all()->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'user_id', $value);
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

        $this->crud->addColumn([
            'name' => 'inn',
            'label' => 'INN'
        ]);

        $this->crud->addColumn([
            'label' => 'User',
            'name' => 'user.email'
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

        $this->crud->addColumn([
            'name' => 'inn',
            'label' => 'INN',
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'user_id',
            'label' => 'User',
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
                'default' => 1
            ]);

        $this->crud->addField(
            [
                'label' => 'Railway',
                'type' => 'select2',
                'name' => 'railway_id',
                'entity' => 'railway',
                'model' => Railway::class,
                'attribute' => 'name',
                'default' => 1
            ]);
        $this->crud->addField(
            [
                'label' => 'User',
                'type' => 'select2',
                'name' => 'user_id',
                'entity' => 'user',
                'model' => User::class,
                'attribute' => 'name',
                'default' => 1
            ]);

        $this->crud->addField(
            [
                'label' => 'Name',
                'type' => 'text',
                'name' => 'name'
            ]);

        $this->crud->addField(
            [
                'label' => 'INN',
                'type' => 'text',
                'name' => 'inn'
            ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    public function organizations(Request $request)
    {
        $search_term = $request->input('q');

        if ($search_term) {
            $results = Organization::query()
                ->where('id', '!=', 1)
                ->where(function ($query) use ($search_term) {
                    $query->where('inn', 'LIKE', '%' . $search_term . '%')
                        ->orWhere('name', 'LIKE', '%' . $search_term . '%');
                })
                ->paginate(300);
        } else {
            $results = Organization::query()->where('id', '!=', 1)->paginate(300);
        }

        return $results;
    }
}
