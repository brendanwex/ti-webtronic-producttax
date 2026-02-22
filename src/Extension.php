<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax;

use Igniter\System\Classes\BaseExtension;
use Igniter\Cart\Http\Controllers\Menus;
use Igniter\Cart\Models\Menu as Menus_model;

class Extension extends BaseExtension
{
    public function boot()
    {


        /*
         |---------------------------------------------
         | Extend Menu Model
         |---------------------------------------------
         */


        Menus_model::extend(function ($model) {

            $model->mergeFillable([
                'vat_rate'
            ]);

            // Make visible in API
            //$model->addVisible(['vat_rate']);
            //$model->makeVisible(['vat_rate']);

            $model->saving(function ($model) {
                logger('Saving: '.$model->vat_rate);
            });
        });


        Menus::extendFormFields(function ($form, $model, $context) {

            if (!$model instanceof Menus_model)
                return;

            if (!$form->getController() instanceof Menus)
                return;

            $form->addFields([
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