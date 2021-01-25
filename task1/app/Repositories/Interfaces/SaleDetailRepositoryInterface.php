<?php

namespace App\Repositories;

interface SaleDetailRepositoryInterface 
{
    public function create($saleId, $params);
}