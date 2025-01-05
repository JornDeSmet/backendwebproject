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
        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'Experience the best sound quality with these wireless headphones. Perfect for music and calls.',
                'price' => 59.99,
                'stock' => 120,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Stay connected and track your fitness goals with this stylish smartwatch.',
                'price' => 99.99,
                'stock' => 80,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Bluetooth Speaker',
                'description' => 'Compact and powerful Bluetooth speaker for all your audio needs.',
                'price' => 29.99,
                'stock' => 200,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Gaming Mouse',
                'description' => 'Enhance your gaming experience with this high-precision gaming mouse.',
                'price' => 49.99,
                'stock' => 150,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Portable Charger',
                'description' => 'Never run out of battery with this high-capacity portable charger.',
                'price' => 24.99,
                'stock' => 300,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Laptop Stand',
                'description' => 'Ergonomic laptop stand to improve your posture while working.',
                'price' => 34.99,
                'stock' => 90,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Noise-Cancelling Earbuds',
                'description' => 'Compact earbuds with excellent noise-cancellation technology.',
                'price' => 79.99,
                'stock' => 100,
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Mechanical Keyboard',
                'description' => 'Durable mechanical keyboard with customizable RGB lighting.',
                'price' => 89.99,
                'stock' => 50,
                'image' => 'https://via.placeholder.com/150',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}


