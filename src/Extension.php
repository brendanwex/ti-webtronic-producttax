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

            // Force attribute persistence on save
            $model->saving(function ($model) {

                if (request()->has('Menu')) {
                    $data = request()->input('Menu');

                    if (isset($data['vat_rate'])) {
                        $model->vat_rate = $data['vat_rate'];
                    }
                }

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
                    'type'  => 'number',
                    'span'  => 'full',
                    'tab'   => 'VAT',
                ],
            ]);
        });
    }
}