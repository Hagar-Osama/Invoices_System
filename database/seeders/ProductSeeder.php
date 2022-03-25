<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

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
                'name' => 'Loaning',
                'description'   => 'jgjgjkg',
                'department_id' => 1

            ],
            [
                'name' => 'Credit Cards',
                'description'   => 'jgjgjkg',
                'department_id' => 2

            ],

        ];
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'department_id' => $product['department_id']

            ]);
        }
    }
}
