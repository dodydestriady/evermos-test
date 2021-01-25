<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_products_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('products', [
                'id', 'name', 'price', 'stock', 'created_at', 'updated_at'
            ])
        );
    }

    public function test_create()
    {
        $data = [
            'name' => 'Test',
            'price' => 10000,
            'stock' => 100,
        ];
        
        Product::create($data);

        $this->assertDatabaseHas('products', $data);
    }

    public function test_update()
    {
        
    }
}
