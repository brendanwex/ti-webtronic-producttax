<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax;

use Igniter\System\Classes\BaseExtension;
use Igniter\Cart\Models\Menu as Menus_model;
use Igniter\Cart\Http\Controllers\Menus;
class Extension extends BaseExtension
{


public function boot()
{
    /*
     |---------------------------------------------
     | Extend Model
     |---------------------------------------------
     */

    Menus_model::extend(function ($model) {

        $model->mergeFillable(['vat_rate']);

        $model->mergeCasts([
            'vat_rate' => 'float',
        ]);

        $model->saving(function ($model) {
            logger('Saving VAT: '.$model->vat_rate);
        });
    });


    /*
     |---------------------------------------------
     | Extend Controller Form
     |---------------------------------------------
     */

    Menus::extendFormFields(function ($form, $model, $context) {

        $form->addTabFields([
            'vat_rate' => [
                'label' => 'VAT Rate',
                'type'  => 'float',
                'span'  => 'full',
                'tab'   => 'VAT',
            ],
        ]);
    });
}
}