<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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
                "user_type_id" => 6,
                "name" => "上田文子",
                "email" => "test@ayako.com",
                "email_verified_at" => NULL,
                "password" => Hash::make('testayako'),
                "life" => 1,
                "remember_token" => "1234567890abcdefg",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "user_type_id" => 5,
                "name" => "上田恭太",
                "email" => "test@kyota.com",
                "email_verified_at" => NULL,
                "password" => Hash::make('testkyota'),
                "life" => 1,
                "remember_token" => "1234567890abcdefg",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('admins')->insert($data);
    }
}
