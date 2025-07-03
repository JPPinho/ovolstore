<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductLogicTest extends TestCase
{
    public function product_is_out_of_stock(): void
    {
        $product = new Product(['stock' => 0]);
        $result = $product->isOutOfStock();
        $this->assertTrue($result, 'A product with 0 stock should be identified as out of stock.');
    }

    /**
     * @test
     */
    public function product_is_in_stock(): void
    {
        $productWithStock = new Product(['stock' => 10]);
        $result = $productWithStock->isOutOfStock();
        $this->assertFalse($result, 'A product with 10 stock should not be identified as out of stock.');
    }

    /**
     * @test
     * This test checks the edge case of negative stock, which should also be out of stock.
     */
    public function it_handles_negative_stock_as_out_of_stock(): void
    {
        $product = new Product(['stock' => -5]);
        $result = $product->isOutOfStock();
        $this->assertTrue($result, 'Negative stock is also out of stock.');
    }
}
