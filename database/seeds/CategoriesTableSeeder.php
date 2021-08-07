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
                "name" => 'Summer Meets Autumn',
                "subtitle" => 'Summer Meets Autumn＝夏から秋へ',
                "details" => '夏の終わりを告げるレモンマーマレードと、訪れる秋を迎えるいちじくジャム。限られた季節だけのセット。',
                "description" => NULL,
                "season" => '8月中旬から9月初旬',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Vintage',
                "subtitle" => 'ビンテージ＝時を超えて価値のあるもの',
                "details" => '厚めのピールが大人向けの、熟成されたビンテージのような味わいのビターオレンジマーマレード',
                "description" => NULL,
                "season" => '11月から4月初旬',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Morning',
                "subtitle" => 'Morning = 朝の目覚め',
                "details" => '薄めのピールが爽やかな、朝の目覚めにぴったりのビターオレンジマーマレード',
                "description" => '',
                "season" => '11月から4月初旬',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Serenity',
                "subtitle" => 'Serenity = 静かで落ち着いた気持ち',
                "details" => 'ふるふるとした絶妙な口あたりで、清らかな香りが広がるホワイトグレープフルーツマーマレード',
                "description" => '',
                "season" => '12月から3月',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Blush',
                "subtitle" => 'Blush = 頬をほんのりピンクに染める',
                "details" => '香り高く、個性的で口にするともう一度食べたくなるピンクグレープフルーツマーマレード',
                "description" => '',
                "season" => '12月から3月',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Miss You',
                "subtitle" => 'Miss You = 大切な人に会いたい',
                "details" => '爽やかだけれどどこか切ない味と香りをそっくりそのまま閉じ込めた、レモンマーマレード',
                "description" => '',
                "season" => '11月から3月',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Praise',
                "subtitle" => 'Praise = 賞賛',
                "details" => 'ぷっくりとしたイチジクの禁断の美味しさをすっかり閉じ込めたジャム。',
                "description" => '',
                "season" => '8月から10月',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
            [
                "name" => 'Lemonade',
                "subtitle" => 'Lemonade = 幸せにするもの',
                "details" => '暑い日にレモネードを飲むように、甘酸っぱく涼しさを感じさせるマーマレード。',
                "description" => '',
                "season" => '8月から10月',
                "ingredients" => NULL,
                "image" => NULL,
                "status_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
                "deleted_at" => NULL
            ],
           
        ];
        DB::table('categories')->insert($data);
    }
}
