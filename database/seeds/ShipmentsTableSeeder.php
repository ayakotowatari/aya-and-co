<?php

use Illuminate\Database\Seeder;

class ShipmentsTableSeeder extends Seeder
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
                "order_id" => 118,
                "package_id" => NULL,
                "shipping_address_id" => NULL,
                "scheduled_date" => NULL,
                "actual_date" => NULL,
                "delivery_time" => NULL,
                "courier_id" => NULL,
                "postage" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "order_id" => 119,
                "package_id" => NULL,
                "shipping_address_id" => NULL,
                "scheduled_date" => NULL,
                "actual_date" => NULL,
                "delivery_time" => NULL,
                "courier_id" => NULL,
                "postage" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "order_id" => 120,
                "package_id" => NULL,
                "shipping_address_id" => NULL,
                "scheduled_date" => NULL,
                "actual_date" => NULL,
                "delivery_time" => NULL,
                "courier_id" => NULL,
                "postage" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
                DB::table('shipments')->insert($data);
    }
}
