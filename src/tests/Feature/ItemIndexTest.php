<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Condition;

class ItemIndexTest extends TestCase
{
    use RefreshDatabase;

    // 商品一覧が表示される
    public function test_items_are_displayed_on_index_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // 購入済み商品はSoldが表示される
    public function test_sold_label_is_displayed_in_mylist()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'is_sold' => 1,
        ]);

        $response = $this->get('/');

        $response->assertSee('Sold');
    }

    // 自分が出品した商品は表示されない
    public function test_user_items_are_not_displayed()
    {
        $user = User::factory()->create();
        // 他のログインユーザー
        $otherUser = User::factory()->create();
        $condition = Condition::factory()->create();

        Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => '自分の商品',
        ]);

        Item::factory()->create([
            'user_id' => $otherUser->id,
            'condition_id' => $condition->id,
            'name' => '他人の商品',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertDontSee('自分の商品');
        $response->assertSee('他人の商品');
    }
}
