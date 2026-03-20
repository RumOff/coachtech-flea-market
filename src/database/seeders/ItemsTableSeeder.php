<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // 
    public function run()
    {

        $sourcePath = database_path('seeders/images/Armani+Mens+Clock.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => '腕時計',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'is_sold' => true,
            'condition' => '良好',
            'category_id' => 1,
            'brand' => 'Rolax',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/HDD+Hard+Disk.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'HDD',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000,
            'is_sold' => true,
            'condition' => '目立った傷や汚れなし',
            'category_id' => 2,
            'brand' => '西芝',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/iLoveIMG+d.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => '玉ねぎ3束',
            'description' => '新鮮な玉ねぎ3束のセット',
            'price' => 300,
            'is_sold' => true,
            'condition' => 'やや傷や汚れあり',
            'category_id' => 10,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Leather+Shoes+Product+Photo.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => '革靴',
            'description' => 'クラシックなデザインの革靴',
            'price' => 4000,
            'is_sold' => true,
            'condition' => '状態が悪い',
            'category_id' => 1,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Living+Room+Laptop.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'ノートPC',
            'description' => '高性能なノートパソコン',
            'price' => 45000,
            'is_sold' => true,
            'condition' => '良好',
            'category_id' => 2,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Music+Mic+4632231.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'マイク',
            'description' => '高音質のレコーディング用マイク',
            'price' => 8000,
            'is_sold' => true,
            'condition' => '目立った傷や汚れなし',
            'category_id' => 2,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Purse+fashion+pocket.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'ショルダーバッグ',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => 3500,
            'is_sold' => true,
            'condition' => 'やや傷や汚れあり',
            'category_id' => 1,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Tumbler+souvenir.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'タンブラー',
            'description' => '使いやすいタンブラー',
            'price' => 500,
            'is_sold' => true,
            'condition' => '状態が悪い',
            'category_id' => 10,
            'brand' => '',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/Waitress+with+Coffee+Grinder.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'コーヒーミル',
            'description' => '手動のコーヒーミル',
            'price' => 4000,
            'is_sold' => true,
            'condition' => '良好',
            'category_id' => 10,
            'brand' => 'Starbacks',
            'image' => $storedPath,
        ]);

        $sourcePath = database_path('seeders/images/外出メイクアップセット.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        Item::create([
            'user_id' => 1,
            'name' => 'メイクセット',
            'description' => '便利なメイクアップセット',
            'price' => 2500,
            'is_sold' => true,
            'condition' => '目立った傷や汚れなし',
            'category_id' => 6,
            'brand' => '',
            'image' => $storedPath,
        ]);
    }
}
