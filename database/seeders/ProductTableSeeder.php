<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['product_name' => 'Product 1', 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Product 2', 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Product 3', 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Product 4', 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Product 5', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('products')->insert($data);
    }
}
