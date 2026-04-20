<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class AddressFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => 1,
            'postal_code' => '123-4567',
            'address' => '東京都',
            'building' => 'テスト',
        ];
    }
}
