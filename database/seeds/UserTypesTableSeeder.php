<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
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
                "name" => 'one-time',
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'subscriber',
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'admin',
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'super-admin',
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('user_types')->insert($data);
    }
}
