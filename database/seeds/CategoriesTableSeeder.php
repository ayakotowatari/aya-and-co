<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                "name" => 'Vintage',
                "details" => '厚めのピールが大人向けの、熟成されたビンテージのような味わいのビターオレンジマーマレード',
                "description" => '',
                "season" => '11月から4月初旬',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Awakening',
                "details" => '薄めのピールが爽やかな、朝の目覚めのぴったりなビターオレンジマーマレード',
                "description" => '',
                "season" => '11月から4月初旬',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Serenity',
                "details" => 'ふるふるとした絶妙な口あたりで、清らかな香りが広がるホワイトグレープフルーツマーマレード',
                "description" => '',
                "season" => '12月から3月',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Blush',
                "details" => '香り高く、個性的で口にするともう一度食べたくなるピンクグレープフルーツマーマレード',
                "description" => '',
                "season" => '12月から3月',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Miss You',
                "details" => '爽やかだけれどどこか切ない味と香りをそっくりそのまま閉じ込めた、レモンマーマレード',
                "description" => '',
                "season" => '11月から3月',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => NULL,
                "details" => NULL,
                "description" => NULL,
                "season" => NULL,
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Praise',
                "details" => '自分へのご褒美にそっと一瓶をキープしておきたいような、忘れられない味のいちじくジャム。',
                "description" => '',
                "season" => '8月から9月',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Balsamico',
                "details" => '濃縮したバルサミコ酢を加え、こくがあり芳醇ないちじくジャム。',
                "description" => '',
                "season" => '8月から9月',
                "image" => NULL,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
        DB::table('categories')->insert($data);
    }
}
