<?php

use Illuminate\Database\Seeder;

class CouriersTableSeeder extends Seeder
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
                "name" => "日本郵便",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => "ヤマト運輸",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('couriers')->insert($data);
    }
}
