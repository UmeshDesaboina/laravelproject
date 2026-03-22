<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        $categories = [
            [
                'name' => 'Boxing',
                'slug' => 'boxing',
                'description' => 'Professional boxing equipment and accessories',
                'children' => ['Gloves', 'Punching Bags', 'Hand Wraps', 'Mouth Guards']
            ],
            [
                'name' => 'MMA',
                'slug' => 'mma',
                'description' => 'Mixed Martial Arts gear and training equipment',
                'children' => ['Gloves', 'Shin Guards', 'Training Gear']
            ],
            [
                'name' => 'Fitness',
                'slug' => 'fitness',
                'description' => 'Fitness and cardio training equipment',
                'children' => ['Jump Ropes', 'Resistance Bands', 'Weights']
            ],
            [
                'name' => 'Protective Gear',
                'slug' => 'protective-gear',
                'description' => 'Safety and protective equipment',
                'children' => ['Head Gear', 'Body Protectors', 'Groin Protectors']
            ],
            [
                'name' => 'Apparel',
                'slug' => 'apparel',
                'description' => 'Fight wear and training apparel',
                'children' => ['Shorts', 'Rash Guards', 'T-Shirts']
            ],
        ];

        foreach ($categories as $catData) {
            $children = $catData['children'] ?? [];
            unset($catData['children']);
            
            $category = Category::firstOrCreate(
                ['slug' => $catData['slug']],
                array_merge($catData, ['is_active' => true, 'sort_order' => 0])
            );

            foreach ($children as $index => $childName) {
                Category::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($childName)],
                    [
                        'name' => $childName,
                        'parent_id' => $category->id,
                        'description' => "$childName for martial arts training",
                        'is_active' => true,
                        'sort_order' => $index,
                    ]
                );
            }
        }

        $products = [
            [
                'name' => 'Pro Boxing Gloves',
                'slug' => 'pro-boxing-gloves',
                'sku' => 'BOX-001',
                'category' => 'boxing',
                'price' => 79.99,
                'compare_price' => 99.99,
                'description' => "Premium leather boxing gloves with reinforced padding for maximum hand protection. Features a secure velcro closure system and moisture-wicking inner lining.",
                'short_description' => 'Professional leather boxing gloves',
                'quantity' => 45,
                'is_featured' => true,
                'delivery_type' => 'free',
            ],
            [
                'name' => 'MMA Training Gloves',
                'slug' => 'mma-training-gloves',
                'sku' => 'MMA-001',
                'category' => 'mma',
                'price' => 45.99,
                'compare_price' => 59.99,
                'description' => 'Open-finger MMA gloves perfect for grappling and striking. Breathable mesh construction with gel padding for superior comfort.',
                'short_description' => 'Versatile MMA training gloves',
                'quantity' => 60,
                'is_featured' => true,
                'delivery_type' => 'free',
            ],
            [
                'name' => 'Speed Jump Rope',
                'slug' => 'speed-jump-rope',
                'sku' => 'FIT-001',
                'category' => 'fitness',
                'price' => 15.99,
                'compare_price' => 24.99,
                'description' => 'Ultra-lightweight speed jump rope with ball bearings for smooth rotation. Adjustable length suitable for all heights.',
                'short_description' => 'Professional speed jump rope',
                'quantity' => 150,
                'is_featured' => false,
                'delivery_type' => 'fixed',
                'delivery_charge' => 5.00,
            ],
            [
                'name' => 'Heavy Punching Bag',
                'slug' => 'heavy-punching-bag',
                'sku' => 'BOX-002',
                'category' => 'boxing',
                'price' => 129.99,
                'compare_price' => 159.99,
                'description' => 'Filled heavy punching bag (70 lbs) made from premium synthetic leather. Triple-stitched seams for durability.',
                'short_description' => '70lb filled heavy bag',
                'quantity' => 25,
                'is_featured' => true,
                'delivery_type' => 'fixed',
                'delivery_charge' => 25.00,
            ],
            [
                'name' => 'Head Gear',
                'slug' => 'boxing-head-gear',
                'sku' => 'BOX-003',
                'category' => 'protective-gear',
                'price' => 65.99,
                'compare_price' => null,
                'description' => 'Competition-grade head gear with cheek protection. Lightweight design allows full visibility while providing excellent impact absorption.',
                'short_description' => 'Protective head gear',
                'quantity' => 35,
                'is_featured' => false,
                'delivery_type' => 'free',
            ],
            [
                'name' => 'Fight Shorts',
                'slug' => 'mma-fight-shorts',
                'sku' => 'APP-001',
                'category' => 'apparel',
                'price' => 35.99,
                'compare_price' => 45.99,
                'description' => 'Stretchy MMA fight shorts with slit design for maximum mobility. Sublimated graphics that never fade.',
                'short_description' => 'Comfortable fight shorts',
                'quantity' => 80,
                'is_featured' => false,
                'delivery_type' => 'fixed',
                'delivery_charge' => 5.00,
            ],
            [
                'name' => 'Resistance Bands Set',
                'slug' => 'resistance-bands-set',
                'sku' => 'FIT-002',
                'category' => 'fitness',
                'price' => 29.99,
                'compare_price' => 39.99,
                'description' => 'Set of 5 resistance bands with different resistance levels. Includes door anchor, handles, and ankle straps.',
                'short_description' => 'Complete resistance bands kit',
                'quantity' => 120,
                'is_featured' => true,
                'delivery_type' => 'free',
            ],
            [
                'name' => 'Shin Guards',
                'slug' => 'mma-shin-guards',
                'sku' => 'MMA-002',
                'category' => 'mma',
                'price' => 39.99,
                'compare_price' => null,
                'description' => 'Lightweight shin guards with high-density foam padding. Ventilated design keeps you cool during training.',
                'short_description' => 'Premium shin protection',
                'quantity' => 55,
                'is_featured' => false,
                'delivery_type' => 'free',
            ],
        ];

        foreach ($products as $productData) {
            $categorySlug = $productData['category'];
            unset($productData['category']);
            
            $category = Category::where('slug', $categorySlug)->first();
            
            if (!$category) continue;

            $product = Product::firstOrCreate(
                ['sku' => $productData['sku']],
                array_merge($productData, [
                    'category_id' => $category->id,
                    'cost_price' => $productData['price'] * 0.4,
                    'low_stock_threshold' => 10,
                    'is_active' => true,
                    'published_at' => now(),
                ])
            );

            $sizes = ['S', 'M', 'L', 'XL'];
            foreach ($sizes as $size) {
                ProductSize::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'size' => $size,
                    ],
                    [
                        'stock' => rand(10, 50),
                        'is_active' => true,
                    ]
                );
            }
        }

        Coupon::firstOrCreate(
            ['code' => 'WELCOME10'],
            [
                'type' => 'percentage',
                'value' => 10,
                'min_order_amount' => 50,
                'max_discount' => 20,
                'usage_limit' => 100,
                'is_active' => true,
                'expires_at' => now()->addMonths(3),
            ]
        );

        Coupon::firstOrCreate(
            ['code' => 'FLAT25'],
            [
                'type' => 'fixed',
                'value' => 25,
                'min_order_amount' => 100,
                'usage_limit' => 50,
                'is_active' => true,
                'expires_at' => now()->addMonths(2),
            ]
        );

        Coupon::firstOrCreate(
            ['code' => 'FREESHIP'],
            [
                'type' => 'percentage',
                'value' => 100,
                'min_order_amount' => 75,
                'max_discount' => 15,
                'usage_limit' => null,
                'is_active' => true,
                'expires_at' => now()->addMonths(6),
            ]
        );
    }
}
