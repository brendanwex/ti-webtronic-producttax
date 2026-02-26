<?php

namespace WebtronicIE\ProductTax\Models;


use Igniter\Flame\Database\Model;

class EodModel extends Model
{


    protected $table = 'orders';
    protected $primaryKey = 'order_id';


    public function eod(){

       return Model::all()->where(['order_date' => date('Y-m-d')]);
    }



}