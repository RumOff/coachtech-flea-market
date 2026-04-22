<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Address;
use App\Models\Purchase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    // ユーザー情報が表示される
    public function test_user_profile_information_is_displayed()
    {
        $user = User::factory()->create();

        Profile::create([
            'user_id' => $user->id,
            'user_name' => 'テストユーザー',
            'avatar' => 'test.jpg',
            'postal_code' => '111-1111',
            'address' => '東京都',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage');

        $response->assertSee('テストユーザー');
        $response->assertSee('test.jpg');
    }

    // 出品商品一覧が表示される
    public function test_user_selling_items_are_displayed()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => '出品商品',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage');

        $response->assertSee('出品商品');
    }

    // 購入商品一覧が表示される
    public function test_user_purchased_items_are_displayed()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => '購入商品',
        ]);

        $address = Address::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '111-1111',
            'address' => '東京都',
        ]);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $address->id,
            'payment' => 'credit',
            'price' => $item->price,
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage?page=buy');

        $response->assertSee('購入商品');
    }

    // プロフィール編集画面に初期値が表示される
    public function test_profile_edit_page_has_initial_values()
    {
        $user = User::factory()->create();

        Profile::create([
            'user_id' => $user->id,
            'user_name' => 'テストユーザー',
            'avatar' => 'test.jpg',
            'postal_code' => '111-1111',
            'address' => '東京都',
            'building' => 'テストビル',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage/profile'); // ←編集画面のURL

        // 初期値チェック
        $response->assertSee('test.jpg');
        $response->assertSee('テストユーザー');
        $response->assertSee('111-1111');
        $response->assertSee('東京都');
        $response->assertSee('テストビル');
    }

}
