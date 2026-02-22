<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax;

use Igniter\System\Classes\BaseExtension;
use Igniter\Cart\Models\Menu;
class Extension extends BaseExtension
{



    public function boot()
    {
        // Extend model (this part is correct already)
        Menu::extend(function ($model) {

            $model->mergeFillable(['vat_rate']);

            $model->mergeCasts([
                'vat_rate' => 'float',
            ]);

            $model->saving(function ($model) {
                logger('Saving VAT: '.$model->vat_rate);
            });
        });

        // Extend backend form config
        \Event::listen('admin.form.extendConfig', function ($config, $form) {

            if (!$form->model instanceof Menu) {
                return;
            }

            $config->tabs['fields']['vat_rate'] = [
                'label' => 'VAT Rate',
                'type'  => 'number',
                'span'  => 'full',
                'tab'   => 'tab_general',
            ];
        });
    }
}