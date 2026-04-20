<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Condition;

class ItemMylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_いいねした商品だけが表示される()
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

    public function test_購入済み商品はSoldが表示される()
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

    public function test_未承認は何も表示されない()
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
