<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_rendered()
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    public function test_products_can_be_filtered_by_category()
    {
        // Create products with different categories
        Product::factory()->create(['category_name' => 'Electronics']);
        Product::factory()->create(['category_name' => 'Books']);
        Product::factory()->create(['category_name' => 'Clothing']);

        // Filter by Electronics category
        $response = $this->get(route('products.index', ['category' => 'Electronics']));

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 1 && 
                   $products->first()->category_name === 'Electronics';
        });
    }

    public function test_products_can_be_filtered_by_price_range()
    {
        // Create products with different prices
        Product::factory()->create(['name' => 'Cheap Product', 'price' => 10.00]);
        Product::factory()->create(['name' => 'Medium Product', 'price' => 50.00]);
        Product::factory()->create(['name' => 'Expensive Product', 'price' => 100.00]);

        // Filter by price range
        $response = $this->get(route('products.index', ['min_price' => 20, 'max_price' => 80]));

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 1 && 
                   $products->first()->name === 'Medium Product';
        });
    }

    public function test_products_can_be_searched_by_name()
    {
        // Create products with different names
        Product::factory()->create(['name' => 'iPhone 13']);
        Product::factory()->create(['name' => 'Samsung Galaxy']);
        Product::factory()->create(['name' => 'Google Pixel']);

        // Search for iPhone
        $response = $this->get(route('products.index', ['q' => 'iPhone']));

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 1 && 
                   $products->first()->name === 'iPhone 13';
        });
    }

    public function test_products_can_be_sorted()
    {
        // Create products with different prices
        Product::factory()->create(['name' => 'Product A', 'price' => 30.00]);
        Product::factory()->create(['name' => 'Product B', 'price' => 10.00]);
        Product::factory()->create(['name' => 'Product C', 'price' => 20.00]);

        // Sort by price ascending
        $response = $this->get(route('products.index', ['sort' => 'price', 'dir' => 'asc']));

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 3 && 
                   $products->first()->price === 10.00;
        });
    }

    public function test_product_can_be_created()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 99.99,
            'category_name' => 'Test Category'
        ];

        $response = $this->post(route('products.store'), $productData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $productData);
    }

    public function test_product_can_be_updated()
    {
        $product = Product::factory()->create();
        
        $updatedData = [
            'name' => 'Updated Product',
            'description' => 'This is an updated product',
            'price' => 199.99,
            'category_name' => 'Updated Category'
        ];

        $response = $this->put(route('products.update', $product), $updatedData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $updatedData);
    }

    public function test_product_can_be_deleted()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_csv_export_works()
    {
        // Create some products
        Product::factory()->count(3)->create();

        // Request CSV export
        $response = $this->get(route('products.index', ['export' => 'csv']));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition', 'attachment; filename=products.csv');
    }

    public function test_api_returns_products()
    {
        // Create some products
        Product::factory()->count(3)->create();

        // Request API endpoint
        $response = $this->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'description', 'price', 'category_name', 'created_at', 'updated_at']
            ],
            'links',
            'meta'
        ]);
    }

    public function test_api_returns_single_product()
    {
        // Create a product
        $product = Product::factory()->create();

        // Request API endpoint for single product
        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category_name' => $product->category_name,
            ]
        ]);
    }
}