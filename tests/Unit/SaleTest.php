<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_sale_product()
    {
        $product = Product::factory()->create();
        $sale = Sale::factory()->create([
            'product_id' => $product->id
        ]);

        $this->assertEquals($product->id, $sale->product->id);
    }
}
