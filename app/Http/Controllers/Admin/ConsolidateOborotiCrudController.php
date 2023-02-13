<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsolidateOborotiRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ConsolidateOborotiCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ConsolidateOborotiCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ConsolidateOboroti');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/consolidateoboroti');
        $this->crud->setEntityNameStrings('обороты', 'Обороты');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ConsolidateOborotiRequest::class);
        
                $this->crud->addField([
                    'name' => 'postup_os',
                    'label' => 'Поступление ОС',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'postup_os_ot_lizing',
                    'label' => 'Поступление ОС от лизинга',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'postup_tms',
                    'label' => 'Поступление ТМЦ',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'postup_zatrat',
                    'label' => 'Поступление затрат',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pered_os_v_lizing',
                    'label' => 'Передача ОС в лизинг',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pered_os_cher_shet',
                    'label' => 'Передача ОС через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'postup_os_cher_shet',
                    'label' => 'Получение ОС через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'bez_pered',
                    'label' => 'Безвозмездная передача ОС',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'bez_pol',
                    'label' => 'Безвозмездное получение ОС 85/92',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pered_tms',
                    'label' => 'Передача ТМЦ через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'poluch_tms',
                    'label' => 'Получение ТМЦ через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pered_saldo_nalog',
                    'label' => 'Передача сальдо налогов через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pol_saldo_nalog',
                    'label' => 'Получение сальдо налогов через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'pered_prochix',
                    'label' => 'Передача прочих активов / обязательств через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                
                $this->crud->addField([
                    'name' => 'postup_prochix',
                    'label' => 'Поступление прочих активов / обязательств через 41/61 счет',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'viruchka_ot_real',
                    'label' => 'Выручка от реализации',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'vtch_sob_real',
                    'label' => 'в т.ч. себестоимость реализации',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'doxod_ot_vib_os',
                    'label' => 'Доходы от выбытия ОС',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'vtch_ost_stoim',
                    'label' => 'в т.ч. Остаточная стоимость ОС',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'doxod_ot_vib_prochix',
                    'label' => 'Доходы от выбытия прочих активов',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'vtch_sob_proch',
                    'label' => 'в т.ч. себестоимость прочих активов',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

                $this->crud->addField([
                    'name' => 'proch_oper_doxod',
                    'label' => 'Прочие операционные доходы',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'rasxodi_perioda',
                    'label' => 'Расходы периода',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'doxodi_vide_divid',
                    'label' => 'Доходы в виде дивидендов',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'divid_obyav',
                    'label' => 'Дивиденды объявленные',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'doxodi_vide_prosent',
                    'label' => 'Доходы в виде процентов',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'rasxodi_vide_prosent',
                    'label' => 'Расходы в виде процентов',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'doxodi_ot_finar',
                    'label' => 'Доходы от финаренды',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'rasxodi_vide_prosent_po_finar',
                    'label' => 'Расходы в виде процентов по финаренде',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'doxodi_po_kurs',
                    'label' => 'Доходы по курсовым разницам',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'rasxodi_po_kurs',
                    'label' => 'Расходы по курсовым разницам',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'prochi_daxodi_ot_fin',
                    'label' => 'Прочие доходы от финансовой деятельности',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'prochi_rasxodi_ot_fin',
                    'label' => 'Прочие расходы по финансовой деятельности',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'nds_oplate',
                    'label' => 'НДС к оплате',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'nds_zashet',
                    'label' => 'НДС к зачету',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'poluch_deneg',
                    'label' => 'Получено денег',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'uplach_deneg',
                    'label' => 'Уплачено денег',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'vzaimozashet',
                    'label' => 'Взаимозачеты внутри Группы',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'rashet_tret_litsam',
                    'label' => 'Рачеты с третьими лицами от имени Группы',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);
                $this->crud->addField([
                    'name' => 'prochie',
                    'label' => 'Прочее',
                    'wrapper' => [
                        'class' => 'form-group col-lg-4'
                    ]
                ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
