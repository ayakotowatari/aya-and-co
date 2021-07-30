<?php

use Illuminate\Database\Seeder;

class ProductInventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "product_id" => 1,
                "quantity" => 64,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "product_id" => 2,
                "quantity" => 64,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "product_id" => 3,
                "quantity" => 5,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "product_id" => 4,
                "quantity" => 5,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
        ];
           
                DB::table('product_inventories')->insert($data);
    }
}
