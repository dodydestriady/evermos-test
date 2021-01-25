<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_sales_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('sales', [
                'id', 'user_id', 'code', 'amount', 'created_at', 'updated_at'
            ])
        );
    }

    public function test_create_sale()
    {
        $sale = Sale::new();
        $sale->code = $this->faker->randomNumber(1000, 9999);
        $sale->amount = 5000;
        $sale->user_id = 1;
        $sale->save();

        $this->assertDatabaseHas('sales', $sale);
    }
}
