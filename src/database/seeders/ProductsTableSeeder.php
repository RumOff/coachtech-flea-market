<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'user_id' => 1,
            'name' => '腕時計',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'status' => 'selling',
            'condition' => '良好',
            'category_id' => 1,
            'brand' => 'Rolax',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
        ]);
        
        Product::create([
            'user_id' => 1,
            'name' => 'HDD',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000,
            'status' => 'selling',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1,
            'brand' => '西芝',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => '玉ねぎ3束',
            'description' => '新鮮な玉ねぎ3束のセット',
            'price' => 300,
            'status' => 'selling',
            'condition' => 'やや傷や汚れあり',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => '革靴',
            'description' => 'クラシックなデザインの革靴',
            'price' => 4000,
            'status' => 'selling',
            'condition' => '状態が悪い',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'ノートPC',
            'description' => '高性能なノートパソコン',
            'price' => 45000,
            'status' => 'selling',
            'condition' => '良好',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'マイク',
            'description' => '高音質のレコーディング用マイク',
            'price' => 8000,
            'status' => 'selling',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'ショルダーバッグ',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => 3500,
            'status' => 'selling',
            'condition' => 'やや傷や汚れあり',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'タンブラー',
            'description' => '使いやすいタンブラー',
            'price' => 500,
            'status' => 'selling',
            'condition' => '状態が悪い',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'コーヒーミル',
            'description' => '手動のコーヒーミル',
            'price' => 4000,
            'status' => 'selling',
            'condition' => '良好',
            'category_id' => 1,
            'brand' => 'Starbacks',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'メイクセット',
            'description' => '便利なメイクアップセット',
            'price' => 2500,
            'status' => 'selling',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1,
            'brand' => '',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
        ]);
    }
}
