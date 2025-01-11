<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['product_id' => 1, 'uuid' => uniqid(), 'purchase_price'=>100,'price'=>150,'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'uuid' => uniqid(), 'purchase_price'=>200,'price'=>250,'quantity' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'uuid' => uniqid(), 'purchase_price'=>300,'price'=>350,'quantity' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 4, 'uuid' => uniqid(), 'purchase_price'=>400,'price'=>450,'quantity' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 5, 'uuid' => uniqid(), 'purchase_price'=>500,'price'=>550,'quantity' => 5, 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('product_purchases')->insert($data);
    }
}
