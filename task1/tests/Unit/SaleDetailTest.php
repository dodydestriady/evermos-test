<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SaleDetailTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_sale_details_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('sale_details', [
                'id', 'sale_id', 'product_id', 'quantity', 'price', 'created_at', 'updated_at'
            ])
        );
    }
}
