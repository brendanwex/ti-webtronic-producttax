<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax\ClassesOld;

use Igniter\Cart\Models\Order;
use Igniter\Cart\Models\Menu;
use Igniter\Cart\Models\OrderMenu;
use Illuminate\Support\Facades\Log;


class ProductTax
{


    public function updateOrderItems(Order $order): void
    {


        foreach ($order->getOrderMenus() as $item) {

            $menuItem = Menu::find($item->menu_id);


            $vat_rate = null;
            $reporting_category = null;
            $epos_sku = null;
            if ($menuItem->vat_rate) {
                $vat_rate = $menuItem->vat_rate;
            }
            if ($menuItem->reporting_catgeory) {
                $reporting_category = $menuItem->reporting_catgeory;
            }
            if ($menuItem->epos_sku) {
                $epos_sku = $menuItem->epos_sku;
            }


            OrderMenu::where('order_menu_id', '=', $item->order_menu_id)->update(['vat_rate' => $vat_rate, 'reporting_category' => $reporting_category, 'epos_sku' => $epos_sku]);

        }


    }
}