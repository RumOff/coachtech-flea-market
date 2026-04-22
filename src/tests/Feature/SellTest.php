<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class SellTest extends TestCase
{
    use RefreshDatabase;

    // 商品が出品できる
    public function test_item_can_be_listed()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/sell', [
            'name' => 'test',
            'price' => 10000,
            'description' => 'teat_description',
            'brand' => 'test_brand',
            'image' => UploadedFile::fake()->create('test.png', 100),
            'condition_id' => $condition->id,
            'categories' => [$category->id],
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('items', [
            'name' => 'test',
            'price' => 10000,
            'description' => 'teat_description',
            'brand' => 'test_brand',
            'condition_id' => $condition->id,
        ]);
    }
}
