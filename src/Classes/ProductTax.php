<?php
declare(strict_types=1);

namespace WebtronicIE\ProductTax\Classes;

use Igniter\Cart\Models\Order;
use Igniter\Cart\Models\Menu;
use Igniter\Cart\Models\OrderMenu;


class ProductTax
{


    public function updateOrderItems(Order $order): void
    {


        foreach ($order->getOrderMenus() as $item) {

            $menuItem = Menu::find($item->menu_id);

            $orderMenuItem = OrderMenu::find($item->order_menu_id);

            $orderMenuItem->vat_rate = $menuItem->vat_rate;

            $orderMenuItem->reporting_category = $menuItem->reporting_category;

            $orderMenuItem->epos_sku = $menuItem->epos_sku;

            $orderMenuItem->save();


        }


    }
}