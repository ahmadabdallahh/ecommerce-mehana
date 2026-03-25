<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأقسام أولاً مع الـ Slug
        $men = Category::firstOrCreate(['name' => 'رجالي'], ['slug' => 'men']);
        $women = Category::firstOrCreate(['name' => 'حريمي'], ['slug' => 'women']);

        $products = [
            [
                'category_id' => $men->id,
                'name' => 'Premium Black Jacket',
                'slug' => 'premium-black-jacket',
                'description' => 'جاكيت شتوي أنيق مقاوم للمطر، مثالي للأجواء الباردة.',
                'price' => 250.00,
                'image' => 'jacket-1.jpg',
                'is_ai_enabled' => true, 
                'colors' => ['#000000', '#1f2937'],
                'sizes' => ['M', 'L', 'XL']
            ],
            [
                'category_id' => $men->id,
                'name' => 'Urban White Hoodie',
                'slug' => 'urban-white-hoodie',
                'description' => 'هودي قطني مريح بتصميم عصري يناسب الشباب.',
                'price' => 120.00,
                'image' => 'hoodie-1.png',
                'is_ai_enabled' => true,
                'colors' => ['#ffffff', '#f3f4f6'],
                'sizes' => ['S', 'M', 'L']
            ],
            [
                'category_id' => $women->id,
                'name' => 'Classic Denim Jacket',
                'slug' => 'classic-denim-jacket',
                'description' => 'جاكيت جينز كلاسيكي قطعة أساسية في خزانة ملابسك.',
                'price' => 180.00,
                'image' => 'denim-1.png',
                'is_ai_enabled' => false,
                'colors' => ['#1e40af', '#60a5fa'],
                'sizes' => ['S', 'M']
            ],
            [
                'category_id' => $men->id,
                'name' => 'Sporty Windbreaker',
                'slug' => 'sporty-windbreaker',
                'description' => 'سترة رياضية خفيفة الوزن للتمارين الخارجية.',
                'price' => 150.00,
                'image' => 'sport-1.png',
                'is_ai_enabled' => true,
                'colors' => ['#dc2626', '#000000'],
                'sizes' => ['L', 'XL', 'XXL']
            ],
            [
                'category_id' => $women->id,
                'name' => 'Oversized Cotton Shirt',
                'slug' => 'oversized-cotton-shirt',
                'description' => 'قميص قطني واسع ومريح جداً للاستخدام اليومي.',
                'price' => 95.00,
                'image' => 'shirt-1.png',
                'is_ai_enabled' => false,
                'colors' => ['#fbbf24', '#ffffff'],
                'sizes' => ['Free Size']
            ],
            [
                'category_id' => $men->id,
                'name' => 'Leather Biker Jacket',
                'slug' => 'leather-biker-jacket',
                'description' => 'جاكيت جلد طبيعي بتصميم بايكر كلاسيكي فخم.',
                'price' => 450.00,
                'image' => 'leather-1.png',
                'is_ai_enabled' => true,
                'colors' => ['#000000'],
                'sizes' => ['M', 'L', 'XL']
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}