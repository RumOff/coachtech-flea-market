<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_名前未入力でエラーメッセージを表示()
    {
        $response = $this->post('/register', [
            'name' => '' ,
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_メールアドレス未入力でエラーメッセージを表示()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_パスワード未入力でエラーメッセージを表示()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => '',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_パスワードが7文字以下でエラーメッセージを表示()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_パスワードが確認用パスワードと不一致でエラーメッセージを表示()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'passworddd',
        ]);

        $response->assertSessionHasErrors(['password_confirmation']);
    }

    public function test_すべての項目入力で会員登録()
    {
        $email = 'test' . uniqid() . '@example.com';

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users',[
            'email' => $email,
        ]);
    }
}
