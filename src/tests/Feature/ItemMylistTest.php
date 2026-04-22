<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Condition;

class ItemMylistTest extends TestCase
{
    use RefreshDatabase;

    // いいねした商品だけが表示される
    public function test_only_liked_items_are_displayed()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $otherUser->id,
            'name' => 'いいねした商品',
            'condition_id' => $condition->id,
        ]);

        $user->likedItems()->attach($item->id);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('いいねした商品');
    }

    // 購入済み商品はSoldが表示される
    public function test_sold_label_is_displayed_in_mylist()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'condition_id' => $condition->id,
        ]);

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'is_sold' => 1, // ← これも重要🔥
        ]);
        
        $user->likedItems()->attach($item->id);
        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('Sold');
    }

    // 未承認は何も表示されない
    public function test_nothing_is_displayed_for_guest_user()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'condition_id' => $condition->id,
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertDontSee('テスト商品');
    }
}
