<?php

namespace App\Repositories;

use App\Models\SaleDetail;
use App\Repositories\Interfaces\SaleDetailRepositoryInterface;

class SaleDetailRepsitory implements SaleDetailRepositoryInterface
{

    private $model;

    public function __construct(SaleDetail $model)
    {
        $this->model = $model;
    }

    public function create($saleId, $params){}
}
