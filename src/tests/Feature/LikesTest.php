<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    // いいねすると登録される
    public function test_item_can_be_liked()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/like");

        $response->assertRedirect();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    // いいね済みの場合アイコンが変わる
    public function test_like_icon_changes_when_liked()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        // いいね済みにする
        $item->likedUsers()->attach($user->id);

        $response = $this->actingAs($user)
            ->get("/item/{$item->id}");

        $response->assertSee('images/heart_logo_pink.png');
    }

    // いいねを再度押すと解除される
    public function test_like_can_be_removed_by_clicking_again()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        // 先にいいね
        $item->likedUsers()->attach($user->id);
        $response = $this->actingAs($user)->delete("/item/{$item->id}/like");

        $response->assertRedirect();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}

