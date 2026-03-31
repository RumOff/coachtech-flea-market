@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="profile">

    <h1 class="profile__title">
        プロフィール設定
    </h1>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="profile__form">
        @csrf
        @method('PUT')

        {{-- プロフィール画像 --}}
        <div class="profile__img">
            <img src="{{ Auth::user()->avatar ?? '/img/default.png' }}" alt="" class="profile__avatar">
            <label for="avatar" class="profile__upload-btn">
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
                value="{{ old('user_name') }}"
                class="profile__input"
            >
            @error('user_name')
            <p class="profile__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 郵便番号 --}}
        <div class="profile__content">
            <label class="profile__label">
                郵便番号
            </label>
            <input 
                type="text" 
                name="postal_code" 
                value="{{ old('postal_code') }}"
                class="profile__input"
            >
            @error('postal_code')
            <p class="profile__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div class="profile__content">
            <label class="profile__label">
                住所
            </label>
            <input 
                type="text" 
                name="address" 
                value="{{ old('address') }}"
                class="profile__input"
            >
            @error('address')
            <p class="profile__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div class="profile__content">
            <label class="profile__label">
                建物名
            </label>
            <input 
                type="text" 
                name="building" 
                value="{{ old('building') }}"
                class="profile__input"
            >
            @error('building')
            <p class="profile__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="profile__btn">
            更新する
        </button>
     
    </form>
</div>

@endsection