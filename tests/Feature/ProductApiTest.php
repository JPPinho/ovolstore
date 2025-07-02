<?php


use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_products()
    {
        // Create a category
        $category = Category::create(['name' => 'Test Category']);

        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'sku' => 'TEST123',
            'description' => 'Test description',
            'price' => 99.99,
            'stock' => 10
        ]);

        // Attach the category to the product
        $product->categories()->attach($category);

        // Make a GET request to the products endpoint
        $response = $this->getJson('/api/products');

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'sku',
                    'description',
                    'price',
                    'stock',
                    'categories',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    public function test_can_get_single_product()
    {
        // Create a category
        $category = Category::create(['name' => 'Test Category']);

        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'sku' => 'TEST123',
            'description' => 'Test description',
            'price' => 99.99,
            'stock' => 10
        ]);

        // Attach the category to the product
        $product->categories()->attach($category);

        // Make a GET request to the products endpoint
        $response = $this->getJson('/api/products/1');

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'sku',
                'description',
                'price',
                'stock',
                'categories',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_can_create_product()
    {
        // Create a category
        $category = Category::create(['name' => 'Test Category']);

        // Prepare product data
        $productData = [
            'name' => 'New Product',
            'sku' => 'NEW123',
            'description' => 'New product description',
            'price' => 149.99,
            'stock' => 5,
            'categories' => [$category->id]
        ];

        // Make a POST request to create a product
        $response = $this->postJson('/api/products', $productData);

        // Assert the response is successful
        $response->assertStatus(201);

        // Assert the product was created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'New Product',
            'sku' => 'NEW123',
            'price' => 149.99,
            'stock' => 5
        ]);

        // Assert the category was attached to the product
        $product = Product::where('sku', 'NEW123')->first();
        $this->assertTrue($product->categories->contains($category->id));
    }

    public function test_validation_price_must_be_positive()
    {
        // Create a category
        $category = Category::create(['name' => 'Test Category']);

        // Prepare product data with negative price
        $productData = [
            'name' => 'Invalid Product',
            'sku' => 'INVALID123',
            'description' => 'Invalid product description',
            'price' => -10.00, // Negative price should fail validation
            'stock' => 5,
            'categories' => [$category->id]
        ];

        // Make a POST request to create a product
        $response = $this->postJson('/api/products', $productData);

        // Assert the response indicates validation error
        $response->assertStatus(422);

        // Assert the validation error is about the price
        $response->assertJsonValidationErrors(['price']);
    }
}
