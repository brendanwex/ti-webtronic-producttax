<?php

namespace WebtronicIE\ProductTax\ApiResources\Repositories;

use Igniter\Api\Classes\AbstractRepository;
use WebtronicIE\ProductTax\Models\EodModel;

class EodRepository extends AbstractRepository
{
    protected ?string $modelClass = EodModel::class;
}