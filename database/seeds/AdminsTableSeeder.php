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
                "name" => "戸渡文子",
                "email" => "",//githubで削除
                "email_verified_at" => NULL,
                "password" => Hash::make(''),//githubで削除
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
