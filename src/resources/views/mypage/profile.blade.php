@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
@endsection

@section('content')

<div class="container">

    <h1 class="form__title">
        プロフィール設定
    </h1>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="profile__form">
        @csrf
        @method('PUT')

        {{-- プロフィール画像 --}}
        <div class="profile__img">
            <img src="{{ $profile && $profile->avatar 
                        ? asset('storage/' . (optional($profile)->avatar)) 
                        : asset('/images/default.png') }}" class="header__avatar">

            <label for="avatar" class="profile__upload-btn btn-select">
                画像を選択
            </label>
            <input type="file" name="avatar" id="avatar" hidden>
        </div>

        {{-- ユーザー名 --}}
        <div class="profile__content">
            <label class="profile__label">
                ユーザー名
            </label>
            <input 
                type="text" 
                name="user_name" 
                value="{{ old('user_name', $profile->user_name ?? '') }}"
                class="profile__input"
            >
            
            <p class="error">@error('user_name'){{ $message }}@enderror</p>
            
        </div>

        {{-- 郵便番号 --}}
        <div class="profile__content">
            <label class="profile__label">
                郵便番号
            </label>
            <input 
                type="text" 
                name="postal_code" 
                value="{{ old('postal_code', $profile->postal_code ?? '') }}"
                class="profile__input"
            >
            
            <p class="error">@error('postal_code'){{ $message }}@enderror</p>
            
        </div>

        {{-- 住所 --}}
        <div class="profile__content">
            <label class="profile__label">
                住所
            </label>
            <input 
                type="text" 
                name="address" 
                value="{{ old('address', $profile->address ?? '')  }}"
                class="profile__input"
            >
            
            <p class="error">@error('address'){{ $message }}@enderror</p>
            
        </div>

        {{-- 建物名 --}}
        <div class="profile__content">
            <label class="profile__label">
                建物名
            </label>
            <input 
                type="text" 
                name="building" 
                value="{{ old('building', $profile->building ?? '') }}"
                class="profile__input"
            >
            
            <p class="error">@error('building'){{ $message }}@enderror</p>
            
        </div>

        <button type="submit" class="btn-red profile__btn">
            更新する
        </button>
     
    </form>
</div>

@endsection