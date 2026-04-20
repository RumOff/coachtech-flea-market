<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;

class LikesTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_いいねすると登録される()
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

    public function test_いいね済みの場合アイコンが変わる()
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

    public function test_いいねを再度押すと解除される()
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

