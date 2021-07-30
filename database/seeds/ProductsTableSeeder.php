<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            // [
            //     "sku" => NULL,
            //     "name" => "Praise",
            //     "slug" => "praise-100",
            //     "details" => NULL,
            //     "description" => NULL,
            //     "season" => "8月から10月",
            //     "size" => "100g",
            //     "price" => 900,
            //     "category_id" => NULL,
            //     "brand_id" => NULL,
            //     "created_at" => now(),
            //     "updated_at" => now(),
            //     "deleted_at" => NULL
            // ],
            // [
            //     "sku" => NULL,
            //     "name" => "Praise",
            //     "slug" => "praise-140",
            //     "details" => NULL,
            //     "description" => NULL,
            //     "season" => "8月から10月",
            //     "size" => "140g",
            //     "price" => 1200,
            //     "category_id" => NULL,
            //     "brand_id" => NULL,
            //     "created_at" => now(),
            //     "updated_at" => now(),
            //     "deleted_at" => NULL
            // ],
            [
                "sku" => NULL,
                "name" => "Vintage",
                "slug" => "vintage-140",
                "details" => NULL,
                "description" => NULL,
                "season" => "11月から4月",
                "size" => "140g",
                "price" => 1100,
                "category_id" => NULL,
                "brand_id" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Serenity",
                "slug" => "serenity-100",
                "details" => NULL,
                "description" => NULL,
                "season" => "12月から4月",
                "size" => "100g",
                "price" => 990,
                "category_id" => NULL,
                "brand_id" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('products')->insert($data);
    }
}
