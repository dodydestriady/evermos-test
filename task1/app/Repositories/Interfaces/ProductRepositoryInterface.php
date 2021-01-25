<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface 
{
    public function get($params);
    
    public function detail($id);

    public function create($params);

    public function check_stock($params);

}