<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductimageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('productimage')->insert([
                'product_id' => 1,
                'thumbnail' => 'product1_img1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
