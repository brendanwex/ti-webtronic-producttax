<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax;

use Igniter\System\Classes\BaseExtension;
use Igniter\Admin\Controllers\Menus;
use Igniter\Cart\Models\Menu as Menus_model;

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

        if (!$model instanceof Menus_model) {
            return;
        }

        $form->addTabFields([
            'vat_rate' => [
                'label' => 'VAT Rate',
                'type'  => 'number',
                'span'  => 'full',
                'tab'   => 'tab_general',
            ],
        ]);
    });
}
}