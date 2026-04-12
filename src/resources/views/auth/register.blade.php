@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form__container">
  <div class="register-form__title">
    <h2>会員登録</h2>
  </div>
  <form class="form" action="{{ route('register') }}" method="post">
    @csrf
    <div class="form__group">
      <p class="form__label--item">お名前</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="name" value="{{ old('name') }}" class="form__input--text />
        </div>
        <div class="form__error">
          @error('name')
          <p class="msg-error">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <p class="form__label--item">メールアドレス</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" value="{{ old('email') }}" class="form__input--text />
        </div>
        <div class="form__error">
          @error('email')
          <p class="msg-error">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <p class="form__label--item">パスワード</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password" value="{{ old('password') }}" class="form__input--text />
        </div>
        <div class="form__error">
          @error('password')
          <p class="msg-error">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <p class="form__label--item">確認用パスワード</p>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form__input--text />
        </div>
        <div class="form__error">
          @error('password_confirmation')
          <p class="msg-error">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="btn-red form__button-submit" type="submit" formnovalidate >登録</button>
    </div>
  </form>
  <div class="login__link">
    <a class="login__button" href="/login">ログインの方はこちら</a>
  </div>
</div>
@endsection
