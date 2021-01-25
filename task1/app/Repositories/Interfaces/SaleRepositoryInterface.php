<?php

namespace App\Repositories\Interfaces;

interface SaleRepositoryInterface 
{
    public function get($params);
    
    public function detail($id);

    public function create($params): array;

}