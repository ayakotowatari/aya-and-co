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
            [
                "sku" => NULL,
                "name" => "Vintage",
                "slug" => "vintage-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 1,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Morning",
                "slug" => "morning-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "140g",
                "price" => 990,
                "category_id" => 2,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Serenity",
                "slug" => "serenity-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 3,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Blush",
                "slug" => "blush-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 4,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Miss You",
                "slug" => "missyou-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 5,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Praise",
                "slug" => "praise-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 6,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "sku" => NULL,
                "name" => "Lemonade",
                "slug" => "lemonade-100",
                "subtitle" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "size" => "100g",
                "price" => 990,
                "category_id" => 7,
                "image" => NULL,
                "inventory" => 10,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('products')->insert($data);
    }
}
