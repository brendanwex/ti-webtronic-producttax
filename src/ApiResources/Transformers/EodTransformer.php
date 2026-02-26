<?php

namespace WebtronicIE\ProductTax\ApiResources\Transformers;

use League\Fractal\TransformerAbstract;
use WebtronicIE\ProductTax\Models\EodModel;

class EodTransformer extends TransformerAbstract
{
    public function transform(EodModel $orders): array
    {
        return $orders->toArray();
    }
}