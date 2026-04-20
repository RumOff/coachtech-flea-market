<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Address;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_変更した住所が購入画面に表示される()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
        ]);

        Address::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '111-1111',
            'address' => '東京都渋谷区',
            'building' => 'テストビル',
        ]);

        $response = $this->actingAs($user)
            ->get("/purchase/{$item->id}");

        $response->assertSee('東京都渋谷区');
    }

}
