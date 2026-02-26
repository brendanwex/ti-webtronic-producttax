<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax;

use Igniter\System\Classes\BaseExtension;
use Igniter\Cart\Models\Menu as Menus_model;
use Igniter\Cart\Models\Order;
use Igniter\Cart\Http\Controllers\Menus;
use WebtronicIE\ProductTax\ApiResources\EodApi;
use WebtronicIE\ProductTax\Classes\ProductTax;
use Event;
use Override;


class Extension extends BaseExtension
{

    #[Override]
    public function register(): void
    {
        $this->app->singleton(ProductTax::class);
    }
    #[Override]
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
                    if (isset($data['epos_sku'])) {
                        $model->epos_sku = $data['epos_sku'];
                    }
                    if (isset($data['reporting_category'])) {
                        $model->reporting_category = $data['reporting_category'];
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
                'epos_sku' => [
                    'label' => 'EPOS SKU',
                    'type'  => 'text',
                    'span'  => 'full',
                    'tab'   => 'EPOS',
                ],
                'vat_rate' => [
                    'label' => 'VAT Rate',
                    'type'  => 'number',
                    'span'  => 'full',
                    'tab'   => 'EPOS',
                ],
                'reporting_category' => [
                    'label' => 'Reporting Category',
                    'type'  => 'text',
                    'span'  => 'full',
                    'tab'   => 'EPOS',
                ],
            ]);

        });


        Event::listen('igniter.checkout.beforePayment', function(Order $order, $data): void {
            resolve(ProductTax::class)->updateOrderItems($order);
        });
    }


    public function registerApiResources(): array
    {
        return [
            'eod' => [
                'name' => 'End Of Day',
                'description' => 'Creates an endpoint to run an end of day.',
                'controller' => EodApi::class,
                'actions' => ['destroy:admin']
            ],
        ];
    }
}