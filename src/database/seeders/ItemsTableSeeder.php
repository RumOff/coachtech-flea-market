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

        $item = Item::create([
            'user_id' => 1,
            'name' => '腕時計',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'is_sold' => false,
            'condition_id' => 1,
            'brand' => 'Rolax',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([1]);

        $sourcePath = database_path('seeders/images/HDD+Hard+Disk.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'HDD',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000,
            'is_sold' => false,
            'condition_id' => 2,
            'brand' => '西芝',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([2]);

        $sourcePath = database_path('seeders/images/iLoveIMG+d.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => '玉ねぎ3束',
            'description' => '新鮮な玉ねぎ3束のセット',
            'price' => 300,
            'is_sold' => false,
            'condition_id' => 3,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([10]);

        $sourcePath = database_path('seeders/images/Leather+Shoes+Product+Photo.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => '革靴',
            'description' => 'クラシックなデザインの革靴',
            'price' => 4000,
            'is_sold' => false,
            'condition_id' => 4,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([1]);

        $sourcePath = database_path('seeders/images/Living+Room+Laptop.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'ノートPC',
            'description' => '高性能なノートパソコン',
            'price' => 45000,
            'is_sold' => false,
            'condition_id' => 1,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([2]);

        $sourcePath = database_path('seeders/images/Music+Mic+4632231.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'マイク',
            'description' => '高音質のレコーディング用マイク',
            'price' => 8000,
            'is_sold' => false,
            'condition_id' => 2,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([2]);

        $sourcePath = database_path('seeders/images/Purse+fashion+pocket.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'ショルダーバッグ',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => 3500,
            'is_sold' => false,
            'condition_id' => 3,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([1]);

        $sourcePath = database_path('seeders/images/Tumbler+souvenir.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'タンブラー',
            'description' => '使いやすいタンブラー',
            'price' => 500,
            'is_sold' => false,
            'condition_id' => 4,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([10]);

        $sourcePath = database_path('seeders/images/Waitress+with+Coffee+Grinder.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'コーヒーミル',
            'description' => '手動のコーヒーミル',
            'price' => 4000,
            'is_sold' => false,
            'condition_id' => 1,
            'brand' => 'Starbacks',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([10]);

        $sourcePath = database_path('seeders/images/外出メイクアップセット.jpg');
        $storedPath = Storage::disk('public')->putFile('items', new File($sourcePath));

        $item = Item::create([
            'user_id' => 1,
            'name' => 'メイクセット',
            'description' => '便利なメイクアップセット',
            'price' => 2500,
            'is_sold' => false,
            'condition_id' => 2,
            'brand' => '',
            'image' => $storedPath,
        ]);
        $item->categories()->attach([6]);
    }
}
