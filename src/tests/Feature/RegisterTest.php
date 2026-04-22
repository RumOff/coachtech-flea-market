<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    // 名前未入力でエラーメッセージを表示
    public function test_name_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => '' ,
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    // メールアドレス未入力でエラーメッセージを表
    public function test_email_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    // パスワード未入力でエラーメッセージを表示
    public function test_password_is_required_for_registration()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => '',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    // パスワードが7文字以下でエラーメッセージを表示
    public function test_password_must_be_at_least_8_characters()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    // パスワードが確認用パスワードと不一致でエラーメッセージを表示
    public function test_password_confirmation_must_match()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'passworddd',
        ]);

        $response->assertSessionHasErrors(['password_confirmation']);
    }

    // すべての項目入力で会員登録
    public function test_user_can_register_with_valid_data()
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
