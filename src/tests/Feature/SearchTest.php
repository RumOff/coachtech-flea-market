<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Condition;
use App\Models\Item;
use App\Models\User;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    // 商品名で部分一致検索ができる
    public function test_items_can_be_searched_by_name()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $condition = Condition::factory()->create();

        Item::factory()->create([
            'user_id' => $otherUser->id,
            'name' => 'りんごのキーホルダー',
            'condition_id' => $condition->id,
        ]);

        Item::factory()->create([
            'user_id' => $otherUser->id,
            'name' => 'ばななのキーホルダー',
            'condition_id' => $condition->id,
        ]);

        $response = $this->actingAs($user)->get('/?keyword=りんご');

        $response->assertSee('りんごのキーホルダー');
        $response->assertDontSee('ばななのキーホルダー');
    }

    // マイリストでも検索条件が保持される
    public function test_search_keyword_is_retained_in_mylist()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item1 = Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'りんごのキーホルダー',
            'condition_id' => $condition->id,
        ]);

        $item2 = Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'ばななのキーホルダー',
            'condition_id' => $condition->id,
        ]);

        $user->likedItems()->attach($item1->id);
        $user->likedItems()->attach($item2->id);

        $response = $this->actingAs($user)->get('/?tab=mylist&keyword=りんご');

        $response->assertSee('りんごのキーホルダー');
        $response->assertDontSee('ばななのキーホルダー');
    }
}
