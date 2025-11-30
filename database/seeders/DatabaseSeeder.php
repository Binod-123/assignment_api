<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() : void
    {
        $users = [
            [
                'name'     => 'Admin User',
                'email'    => 'admin@example.com',
                'password' => Hash::make('Admin@123'),
            ],
            [
                'name'     => 'Demo Buyer',
                'email'    => 'buyer@example.com',
                'password' => Hash::make('Buyer@123'),
            ]
        ];

        foreach ($users as $data) {
            User::firstOrCreate(['email' => $data['email']], $data);
        }

        $categories = [
            [
                'name'        => 'Electronics',
                'slug'        => 'electronics',
                'description' => 'Consumer electronics and gadgets.',
            ],
            [
                'name'        => 'Wearables',
                'slug'        => 'wearables',
                'description' => 'Smart watches and health trackers.',
            ],
            [
                'name'        => 'Home Office',
                'slug'        => 'home-office',
                'description' => 'Essentials for productive workspaces.',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $products = [
            [
                'name'        => 'Wireless Headphones',
                'slug'        => 'wireless-headphones',
                'sku'         => 'HEAD-001',
                'description' => 'Noise-cancelling, over-ear wireless headphones.',
                'price'       => 199.99,
                'stock'       => 50,
                'is_active'   => true,
            ],
            [
                'name'        => 'Smart Watch',
                'slug'        => 'smart-watch',
                'sku'         => 'WEAR-010',
                'description' => 'Fitness-focused smart watch with GPS.',
                'price'       => 149.50,
                'stock'       => 75,
                'is_active'   => true,
            ],
            [
                'name'        => 'Standing Desk',
                'slug'        => 'standing-desk',
                'sku'         => 'HOME-100',
                'description' => 'Adjustable standing desk with memory presets.',
                'price'       => 499.00,
                'stock'       => 15,
                'is_active'   => true,
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}