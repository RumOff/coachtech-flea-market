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

    public function test_商品一覧が表示される()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_購入済み商品はSoldが表示される()
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

    public function test_自分が出品した商品は表示されない()
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
