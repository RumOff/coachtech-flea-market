<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    // ログインユーザーはコメント送信できる
    public function test_authenticated_user_can_post_comment()
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

    // 未ログインユーザーはコメント送信できない
    public function test_guest_user_cannot_post_comment()
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

    // コメントが未入力の場合エラーが表示される
    public function test_comment_is_required()
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

    // コメントが255以上の場合エラーが表示される
    public function test_comment_cannot_exceed_255_characters()
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
