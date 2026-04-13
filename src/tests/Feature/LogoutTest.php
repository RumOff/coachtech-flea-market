<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use SebastianBergmann\FileIterator\Factory;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログアウトできる()
    {
        $user = User::Factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();
    }
}
