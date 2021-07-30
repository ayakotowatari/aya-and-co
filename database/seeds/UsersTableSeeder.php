<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                "user_type_id" => NULL,
                "last_name" => "上田",
                "first_name" => "文子",
                "email" => "test@ayako.com",
                "email_verified_at" => NULL,
                "password" => Hash::make('testayako'),
                "life" => 1,
                "remember_token" => "1234567890abcdefg",
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
           
                DB::table('users')->insert($data);
    }
}
