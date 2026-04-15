@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="form__container">
  
  <form class="form" action="/login" method="post">
    @csrf
    <h1 class="form__title">
      ログイン
    </h1>

    <div class="form__group">
      <p class="form__label--item">メールアドレス</p>
      <div class="form__group-content">
        <div class="form__input">

          <input type="email" name="email" value="{{ old('email') }}"
          class="form__input--text" />
          
          <p class="error">
            @error('email'){{ $message }}@enderror
          </p>
      
       </div> 
    </div>

    <div class="form__group">
      <p class="form__label--item">パスワード</p>
      <div class="form__group-content">
        <div class="form__input">

          <input type="password" name="password" class="form__input--text" />

          <p class="error">
            @error('password'){{ $message }}@enderror
          </p>

        </div>
      </div>
    </div>

    <div class="login-form__button">
      <button class="form__button-submit btn-red" type="submit">ログイン</button>
    </div>
    
    <div class="login-parent">
      <a class="register__button" href="/register">会員登録の方はこちら</a>
    </div>

  </form>
  
</div>
@endsection
