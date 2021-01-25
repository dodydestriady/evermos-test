<?php

namespace Tests\Unit;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Repositories\SaleRepository;

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
        $params = [
            'code' => 'P123',
            'amount' => 10000,
            'user_id' => 1
        ];

        $sale = new SaleRepository();
        $sale->create($params);

        $this->assertDatabaseHas('sales', $sale);
    }

    public function test_has_many_details()
    {

    }

    public function test_user_belongs_to_user()
    {

    }
}
