@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form__container">
  <div class="login-form__title">
    <h2>ログイン</h2>
  </div>
  <form class="form" action="/login" method="post">
    @csrf
    <div class="form__group">
      <p class="form__label--item">メールアドレス</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" value="{{ old('email') }}"
          class="form__input--text />
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
       </div> 
    </div>

    <div class="form__group">
      <p class="form__label--item">パスワード</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password" class="form__input--text />
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit btn-red" type="submit">ログイン</button>
    </div>
  </form>
  <div class="parent">
    <a class="register__button" href="/register">会員登録の方はこちら</a>
  </div>
</div>
@endsection
