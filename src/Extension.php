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

            $model->mergeCasts([
                'vat_rate' => 'float',
            ]);

            // Make visible in API
            //$model->addVisible(['vat_rate']);
            //$model->makeVisible(['vat_rate']);

            //$model->save();

            $model->saving(function ($model) {
                logger('Saving: '.$model->vat_rate);
            });
        });


        Menus_model::extendFormFields(function ($form, $model, $context) {


            $form->addTabFields([
                'vat_rate' => [
                    'label' => 'VAT Rate',
                    'type'  => 'number',
                    'span'  => 'full',
                    'tab'   => 'VAT',
                    'context' => ['create', 'edit'],
                ],
            ]);


        });
    }

}