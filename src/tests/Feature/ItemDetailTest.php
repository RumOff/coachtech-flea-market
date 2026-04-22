<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    // 商品詳細に必要な情報が表示される
    public function test_item_detail_displays_required_information()
    {
        $user = User::factory()->create();
        $commentUser = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => 'テスト',
            'description' => '商品説明',
            'price' => 1000,
            'brand' => 'ノーブランド',
            'image' => 'test.jpg',
        ]);

        $item->likedUsers()->attach($user->id); 

        $comment = Comment::factory()->count(2)->create([
            'user_id' => $commentUser->id,
            'item_id' => $item->id,
            'comment' => '値下げ希望です',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('テスト');
        $response->assertSee('test.jpg');
        $response->assertSee('1');
        $response->assertSee('商品説明');
        $response->assertSee($commentUser->name);
        $response->assertSee('2');

    }

    // 複数のカテゴリが表示される
    public function test_multiple_categories_are_displayed()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => 'テスト',
        ]);

        $category1 = Category::factory()->create([
            'name' => '家電',
        ]);
        $category2 = Category::factory()->create([
            'name' => 'ファッション',
        ]);

        // 中間テーブルに登録
        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('家電');
        $response->assertSee('ファッション');
    }
}
