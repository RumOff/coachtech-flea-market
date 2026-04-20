<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログインユーザーはコメント送信できる()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        $response = $this->actingAs($user)->post("/item/{$item->id}/comments", [
            'comment' => 'テスト',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'comment' => 'テスト',
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_未ログインユーザーはコメント送信できない()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        $response = $this->post("/item/{$item->id}/comments", [
            'comment' => 'テスト',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('comments', [
            'comment' => 'テスト',
        ]);
    }

    public function test_コメントが未入力の場合エラーが表示される()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        $response = $this->actingAs($user)->post("/item/{$item->id}/comments", [
            'comment' => '',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors(['comment']);
    }

    public function test_コメントが255以上の場合エラーが表示される()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        $longText = str_repeat('あ', 256);

        $response = $this->actingAs($user)->post("/item/{$item->id}/comments", [
            'comment' => $longText,
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors(['comment']);
    }
}
