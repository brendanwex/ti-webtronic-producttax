<?php

namespace WebtronicIE\ProductTax\classes;
use Igniter\Cart\Models\Order;
use Igniter\Cart\Models\Menu;
use Igniter\Cart\Models\OrderMenu;

class ProductTax
{


    static function updateOrderItems(Order $order)
    {



        $orderMenu = $order::menus()->get();



            foreach($orderMenu as $item){

                $menuItem = Menu::find($item->menu_id);

                if($menuItem->vat_rate){


                    OrderMenu::where('order_menu_id', '=', $item->order_menu_id)->update([ 'vat_rate' => $menuItem->vat_rate ]);
                }

            }




    }
}