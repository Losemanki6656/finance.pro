<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsolidatedRequest;
use App\Models\Consolidated;
use App\Models\Organization;
use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Models\User;
use App\Models\ConsolYear;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;


class ConsolidatedCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Consolidated');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/consolidated');
        $this->crud->setEntityNameStrings('баланс', 'Балансы');
        $this->crud->enableDetailsRow();
        // $this->crud->enableExportButtons();

        $this->crud->addFilter(
            [
                'type'  => 'dropdown',
                'name'  => 'status',
                'label' => 'Фильтр по статусам'
            ],
            [
                3 => "Успешные",
                2 => "100",
                5 => "101",
                4 => "102",
            ],
            function ($value) {
                $this->crud->addClause('where', 'status', $value);
            }
        );

        $this->crud->addFilter(
            [
                'type'  => 'dropdown',
                'name'  => 'year',
                'label' => 'Фильтр по годам'
            ],
            [
                2019 => 2019,
                2020 => 2020,
                2021 => 2021,
                2022 => 2022,
                2023 => 2023,
                2024 => 2024,
                2025 => 2025,
            ],
            function ($value) {
                $this->crud->addClause('where', 'ex_year', $value);
            }
        );
    }

    protected function setupListOperation()
    {
        if (backpack_auth()->check()) {
            $this->crud->query->where('send_id', backpack_user()->id);
        }

        $this->crud->addColumn([
            'name'  => 'send_name',
            'label' => 'Отправитель'
        ]);

        $this->crud->addColumn([
            'name'  => 'send_inn',
            'label' => 'ИНН отправителя'
        ]);

        $this->crud->addColumn([
            'name'  => 'rec_name',
            'label' => 'Получатель'
        ]);


        $this->crud->addColumn([
            'name'  => 'rec_inn',
            'label' => 'ИНН получателя'
        ]);

        $this->crud->addColumn([
            'name'  => 'ex_year',
            'label' => 'Год'
        ]);


        $this->crud->addColumn([
            'name'          => 'resultFormat',
            'label'         => 'Итого',
            'type'          => 'model_function',
            'function_name' => 'resultFormatted'
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Статус',
            'type'  => 'view',
            'view'  => 'backpack::crud.status',
        ]);
    }

    public function showDetailsRow($id)
    {
        $item = Consolidated::query()->find($id);
        return '<span style="font-weight: bold">Отправитель - </span>' . $item->send_name . '<br>' .
            '<span style="font-weight: bold">Получатель - </span>' . $item->rec_name;
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => '#',
        ]);


        $this->crud->addColumn([
            'name'   => 'rec_id',
            'label'  => 'Получатель',
            'entity' => 'rec'
        ]);

        $this->crud->addColumn([
            'name'  => 'rec_name',
            'label' => 'Получатель'
        ]);

        $this->crud->addColumn([
            'name'  => 'rec_inn',
            'label' => 'ИНН получателя'
        ]);


        $this->crud->addColumn([
            'name'  => 'ex_06',
            'label' => '06**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_09',
            'label' => '09**'
        ]);

        $this->crud->addColumn([
            'name'  => 'ex_40',
            'label' => '40**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_41',
            'label' => '41**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_43',
            'label' => '43**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_46',
            'label' => '46**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_48',
            'label' => '48**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_58',
            'label' => '58**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_60',
            'label' => '60**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_61',
            'label' => '61**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_63',
            'label' => '63**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_66*',
            'label' => '66**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_68*',
            'label' => '68**'
        ]);

        $this->crud->addColumn([
            'name'  => 'ex_69',
            'label' => '69**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_78',
            'label' => '78**'
        ]);
        $this->crud->addColumn([
            'name'  => 'ex_79',
            'label' => '79**'
        ]);

        $this->crud->addColumn([
            'name'  => 'ex_83',
            'label' => '83**'
        ]);

        $this->crud->addColumn([
            'name'  => 'result',
            'label' => 'Итого'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ConsolidatedRequest::class);

        $organization = Organization::query()->where('user_id', backpack_user()->id)->first();

        $this->crud->addField(
            [
                'label' => 'Ползователь',
                'type'  => 'hidden',
                'name'  => 'send_id',
                'value' => backpack_user()->id,
            ]
        );
        $this->crud->addField(
            [
                'label'      => 'Отправитель',
                'type'       => 'text',
                'name'       => 'send_name',
                'value'      => $organization->name,
                'attributes' => [
                    'readonly' => 'readonly'
                ],
                'wrapper'    => [
                    'class' => 'form-group col-lg-6'
                ]
            ]
        );
        $this->crud->addField(
            [
                'label' => 'Отправитель ИНН',
                'type'  => 'hidden',
                'name'  => 'send_inn',
                'value' => $organization->inn
            ]
        );
        $this->crud->addField([
            'label'     => 'Получатель',
            'type'      => 'select2',
            'name'      => 'rec_id',
            'entity'    => 'rec',
            'model'     => User::class,
            'options'   => function ($query) {
                return $query->where('users.id', '!=', 1)
                    ->leftJoin('organizations', 'organizations.user_id', '=', 'users.id')
                    ->selectRaw("users.id, CONCAT(users.name, ' (', COALESCE(organizations.inn, 'N/A'), ')') as name")
                    ->get();
            },
            'attribute' => 'name',
            'default'   => 1,
            'wrapper'   => [
                'class' => 'form-group col-lg-6'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_year',
            'label'   => 'Год',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField(
            [
                'label' => 'Имя Получателя',
                'type'  => 'hidden',
                'name'  => 'rec_name'
            ]
        );
        $this->crud->addField(
            [
                'label' => 'ИНН Получателя',
                'type'  => 'hidden',
                'name'  => 'rec_inn'
            ]
        );
        $this->crud->addField([
            'name'    => 'ex_06',
            'label'   => '06**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_09',
            'label'   => '09**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_40',
            'label'   => '40**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_41',
            'label'   => '41**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_43',
            'label'   => '43**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_46',
            'label'   => '46**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_48',
            'label'   => '48**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_58',
            'label'   => '58**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_60',
            'label'   => '60**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_61',
            'label'   => '61**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_63',
            'label'   => '63**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_66',
            'label'   => '66**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_68',
            'label'   => '68**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_69',
            'label'   => '69**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_78',
            'label'   => '78**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_79',
            'label'   => '79**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'    => 'ex_83',
            'label'   => '83**',
            'type'    => 'number',
            'wrapper' => [
                'class' => 'form-group col-lg-2'
            ]
        ]);
        $this->crud->addField([
            'name'   => 'file',
            'label'  => 'АКТ сверка',
            'type'   => 'upload',
            'upload' => true,
            'disk'   => 'public'
        ]);

        $sum = abs(request('ex_06')) + abs(request('ex_09')) + abs(request('ex_40')) + abs(request('ex_41')) +
            abs(request('ex_43')) + abs(request('ex_46')) + abs(request('ex_48')) + abs(request('ex_58')) -
            abs(request('ex_60')) - abs(request('ex_61')) - abs(request('ex_63')) - abs(request('ex_66')) -
            abs(request('ex_68')) - abs(request('ex_69')) - abs(request('ex_78')) -
            abs(request('ex_79')) - abs(request('ex_83'));

        $rec = Organization::query()->where('user_id', request('rec_id'))->first();
        $this->crud->getRequest()->request->add(['rec_name' => $rec->name ?? '']);
        $this->crud->getRequest()->request->add(['rec_inn' => $rec->inn ?? '']);
        $this->crud->getRequest()->request->add(['result' => $sum]);
        $this->crud->setOperationSetting(
            'saveAllInputsExcept',
            ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']
        );
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
