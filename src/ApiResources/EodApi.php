<?php

namespace WebtronicIE\ProductTax\ApiResources;


use Igniter\Api\Classes\ApiController;
use Igniter\Api\Http\Actions\RestController;
use WebtronicIE\ProductTax\ApiResources\Requests\EodRequest;
use WebtronicIE\ProductTax\ApiResources\Transformers\EodTransformer;
use WebtronicIE\ProductTax\ApiResources\Repositories\EodRepository;

class EodApi extends ApiController
{
    public array $implement = [RestController::class];

    public array $restConfig = [
        'actions' => [
            'index' => [
                'pageLimit' => 20,
            ],
            'store' => [],
            'show' => [],
            'update' => [],
            'destroy' => [],
        ],
        'request' => EodRequest::class,
        'repository' => EodRepository::class,
        'transformer' => EodTransformer::class,
    ];

    protected string|array $requiredAbilities = ['orders:*'];
}