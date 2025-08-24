<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use the factory to create 50 products
        Product::factory(50)->create();
        
        // If you want to keep some specific products, uncomment and modify this section
        /*
        $products = [
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
                'price' => 1299.99,
                'category_name' => 'Electronics'
            ],
            [
                'name' => 'Smartphone X',
                'description' => 'Latest smartphone with 6.5-inch display and 128GB storage',
                'price' => 899.99,
                'category_name' => 'Electronics'
            ],
            [
                'name' => 'Coffee Maker',
                'description' => 'Programmable coffee maker with 12-cup capacity',
                'price' => 79.99,
                'category_name' => 'Kitchen Appliances'
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Noise-cancelling wireless headphones with 30-hour battery life',
                'price' => 249.99,
                'category_name' => 'Audio'
            ],
            [
                'name' => 'Fitness Tracker',
                'description' => 'Waterproof fitness tracker with heart rate monitor',
                'price' => 129.99,
                'category_name' => 'Wearables'
            ],
            [
                'name' => 'Blender',
                'description' => 'High-speed blender for smoothies and food processing',
                'price' => 89.99,
                'category_name' => 'Kitchen Appliances'
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with long battery life',
                'price' => 39.99,
                'category_name' => 'Computer Accessories'
            ],
            [
                'name' => 'Bluetooth Speaker',
                'description' => 'Portable Bluetooth speaker with 10-hour playback',
                'price' => 59.99,
                'category_name' => 'Audio'
            ],
            [
                'name' => 'Desk Lamp',
                'description' => 'LED desk lamp with adjustable brightness',
                'price' => 34.99,
                'category_name' => 'Home Office'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}