<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\Interfaces\SaleRepositoryInterface;

class SaleRepository implements SaleRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new Sale;
    }

    public function get($params){}

    public function detail($id){}

    public function create($params): array {

        return [];
    }
}
