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

            // Allow saving


            $model->addFillable(['vat_rate']);

            // Make visible in API
            $model->addVisible(['vat_rate']);
            $model->makeVisible(['vat_rate']);
        });


        Menus::extendFormFields(function ($form, $model, $context) {

            if (!$model instanceof Menus_model)
                return;

            $form->addFields([
                'custom_text' => [
                    'label' => 'VAT Rate',
                    'type'  => 'currency',
                    'span'  => 'full',
                    'tab'   => 'General',
                ],
            ]);
        });
    }

}