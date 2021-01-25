<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepsitory implements ProductRepositoryInterface
{
    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function get($params){}

    public function detail($id){}

    public function create($params){}

    public function check_stock($params){}
}
