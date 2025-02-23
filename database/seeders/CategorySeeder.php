<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'نقاشی آبرنگ',
                'description' => 'یادگیری تکنیک‌های نقاشی آبرنگ',
                'icon' => 'watercolor'
            ],
            [
                'name' => 'نقاشی رنگ روغن',
                'description' => 'آموزش نقاشی رنگ روغن از پایه تا پیشرفته',
                'icon' => 'oil-painting'
            ],
            [
                'name' => 'طراحی و اسکچ',
                'description' => 'یادگیری اصول طراحی و اسکچ',
                'icon' => 'sketching'
            ],
            [
                'name' => 'دیجیتال آرت',
                'description' => 'آموزش نقاشی دیجیتال و گرافیک',
                'icon' => 'digital-art'
            ],
            [
                'name' => 'مینیاتور و تذهیب',
                'description' => 'آموزش هنر اصیل ایرانی',
                'icon' => 'miniature'
            ],
            [
                'name' => 'خوشنویسی',
                'description' => 'آموزش خطاطی و خوشنویسی',
                'icon' => 'calligraphy'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
