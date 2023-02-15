<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsolidatedRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


use App\Models\User;
use App\Models\Consolidated;

/**
 * Class ConsolidatedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ConsolidatedCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Consolidated');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/consolidated');
        $this->crud->setEntityNameStrings('баланс', 'Балансы');
        $this->crud->enableDetailsRow();
        $this->crud->enableExportButtons();

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'status',
            'label' => 'Фильтр по статусам'
        ],
            [
                3 => "Успешные",
                2 => "100",
                5 => "101",
                4 => "102",
            ],
            function ($value) {
                if ($value == 3)
                    $this->crud->query = Consolidated::where('status', 3);
                if ($value == 2)
                    $this->crud->query = Consolidated::where('status', 2);
                if ($value == 5)
                    $this->crud->query = Consolidated::where('status', 5);
                if ($value == 4)
                    $this->crud->query = Consolidated::where('status', 4);
            });
    }

    protected function setupListOperation()
    {
        if (backpack_auth()->check()) {
            $this->crud->query = $this->crud->query->where('send_id', backpack_user()->id);
        }
            
        // $this->crud->addColumn([
        //     'name' => 'id',
        //     'label' => '#',
        // ]);
        // $this->crud->addColumn([
        //     'name' => 'send_id',
        //     'label' => 'Отправитель',
        //     'entity' => 'send'
        // ]);

        // $this->crud->addColumn([
        //     'name' => 'rec_id',
        //     'label' => 'Получатель',
        //     'entity' => 'rec'
        // ]);

        $this->crud->addColumn([
            'name' => 'send_name',
            'label' => 'Отправитель'
        ]);

        $this->crud->addColumn([
            'name' => 'send_inn',
            'label' => 'ИНН отправителя'
        ]);

        $this->crud->addColumn([
            'name' => 'rec_name',
            'label' => 'Получатель'
        ]);
      

        $this->crud->addColumn([
            'name' => 'rec_inn',
            'label' => 'ИНН получателя'
        ]);

        $this->crud->addColumn([
            'name' => 'ex_year',
            'label' => 'Год'
        ]);


        $this->crud->addColumn([
            'name'  =>  'result',
            'label' =>  'Итого',
            'type'  =>  'model_function',
            'function_name' =>  'result_all'
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Статус',
            'type' => 'view',
            'view' => 'backpack::crud.status',
        ]);

    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        
        $this->crud->addColumn([
            'name' => 'id',
            'label' => '#',
        ]);
        

        $this->crud->addColumn([
            'name' => 'rec_id',
            'label' => 'Получатель',
            'entity' => 'rec'
        ]);

        $this->crud->addColumn([
            'name' => 'rec_name',
            'label' => 'Получатель'
        ]);

        $this->crud->addColumn([
            'name' => 'rec_inn',
            'label' => 'ИНН получателя'
        ]);


        $this->crud->addColumn([
            'name' => 'ex_06',
            'label' => '06**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_09',
            'label' => '09**'
        ]);

        $this->crud->addColumn([
            'name' => 'ex_40',
            'label' => '40**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_41',
            'label' => '41**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_43',
            'label' => '43**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_46',
            'label' => '46**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_48',
            'label' => '48**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_58',
            'label' => '58**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_60',
            'label' => '60**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_61',
            'label' => '61**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_63',
            'label' => '63**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_66*',
            'label' => '66**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_69',
            'label' => '69**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_78',
            'label' => '78**'
        ]);
        $this->crud->addColumn([
            'name' => 'ex_79',
            'label' => '79**'
        ]);

        $this->crud->addColumn([
            'name' => 'result',
            'label' => 'Итого'
        ]);
        
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ConsolidatedRequest::class);

        $this->crud->addField(
            [
                'label' => 'Ползователь',
                'type' => 'text',
                'name' => 'send_id',
                'value' => backpack_user()->name,
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'wrapper' => [
                    'class' => 'form-group col-lg-6'
                ]
            ]);

            $this->crud->addField(
                [
                    'label' => 'Отправитель',
                    'type' => 'text',
                    'name' => 'send_name',
                    'attributes' => [
                        'readonly'    => 'readonly',
                        'disabled'    => 'disabled',
                      ],
                    'wrapper' => [
                        'class' => 'form-group col-lg-6'
                    ]
                ]);

                $this->crud->addField(
                    [
                        'label' => 'Отправитель ИНН',
                        'type' => 'text',
                        'name' => 'send_inn',
                        'attributes' => [
                            'readonly'    => 'readonly',
                            'disabled'    => 'disabled',
                          ],
                        'wrapper' => [
                            'class' => 'form-group col-lg-6'
                        ]
                    ]);

                    $this->crud->addField(
                        [
                            'label' => 'Ползователь (Получатель)',
                            'type' => 'select2',
                            'name' => 'rec_id',
                            'entity' => 'rec',
                            'model' => User::class,
                            'attribute' => 'name',
                            'default'   => 1,
                            'wrapper' => [
                                'class' => 'form-group col-lg-6'
                            ]
                        ]);

                    $this->crud->addField(
                        [
                            'label' => 'Имя Получателя',
                            'type' => 'text',
                            'name' => 'rec_name',
                            'wrapper' => [
                                'class' => 'form-group col-lg-6'
                            ]
                        ]);

                        $this->crud->addField(
                            [
                                'label' => 'ИНН Получателя',
                                'type' => 'text',
                                'name' => 'rec_inn',
                                'wrapper' => [
                                    'class' => 'form-group col-lg-6'
                                ]
                            ]);
       
        
                $this->crud->addField([
                    'name' => 'ex_06',
                    'label' => '06**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_09',
                    'label' => '09**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_40',
                    'label' => '40**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_41',
                    'label' => '41**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_43',
                    'label' => '43**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_46',
                    'label' => '46**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_48',
                    'label' => '48**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_58',
                    'label' => '58**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_60',
                    'label' => '60**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_61',
                    'label' => '61**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_63',
                    'label' => '66**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_69',
                    'label' => '69**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_78',
                    'label' => '09**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'ex_79',
                    'label' => '79**',
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'ex_year',
                    'label' => 'Год',
                    'attributes' => [
                        'readonly'    => 'readonly',
                        'disabled'    => 'disabled',
                      ],
                    'wrapper' => [
                        'class' => 'form-group col-lg-2'
                    ]
                ]);              
        

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
