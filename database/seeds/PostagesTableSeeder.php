<?php

use Illuminate\Database\Seeder;

class PostagesTableSeeder extends Seeder
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
            //     "courier_id" => NULL,
            //     "prefecture" => "北海道",
            //     "postage" => "1200",
            //     "created_at" => now(),
            //     "updated_at" => now(),
            //     "deleted_at" => NULL
            // ],
            [
                "courier_id" => NULL,
                "prefecture" => "神奈川県",
                "postage" => "750",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('postages')->insert($data);
    }
}
