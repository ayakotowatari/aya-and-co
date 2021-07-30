<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
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
                'status' => 'Ongoing',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Scheduled',
                "created_at" => now(),
                "updated_at" => now(),
            ], 
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Packed',
                "created_at" => now(),
                "updated_at" => now(),
            ], 
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Shipped',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Delivered',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Cancelled',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Missing',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => Null,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Completed',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Draft',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Discontinued',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('statuses')->insert($data);
    }
}
