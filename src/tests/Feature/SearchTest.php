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

    public function test_商品名で部分一致検索ができる()
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

    public function test_マイリストでも検索条件が保持される()
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
