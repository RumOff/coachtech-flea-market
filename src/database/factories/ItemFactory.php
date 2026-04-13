<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => 1000,
            'is_sold' => 0,
            'condition_id' => 1,
            // 'category_id' => 1,
            'brand' => 'テストブランド',
            'image' => 'test.jpg',
        ];
    }
}
