@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')

    <div class="profile__container">
        <div class="profile__header">
            <img src="{{ $profile && $profile->avatar 
                        ? asset('storage/' . (optional($profile)->avatar)) 
                        : asset('/img/default.png') }}" class="header__avatar">

            <h1 class="header__name">{{ optional($profile)->user_name ?? '未設定' }}</h1>

            <a href="{{ route('profile.edit') }}" class="header__link--edit">プロフィールを編集</a>
        </div>

        <div class="profile__tabs">
            <a href="{{ route('mypage.index', ['page' => 'sell']) }}" class="profile__tab {{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>

            <a href="{{ route('mypage.index', ['page' => 'buy']) }} " class="profile__tab {{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
        </div>

        <div class="profile__border-line"></div>

        <div class="profile__item-cards">
            @if(isset($items))
                @foreach ($items as $item)
                    <div class="item__card">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="item-img" class="item__img">
                        <label class="item__name">{{ $item->name }}</label>
                    </div>
                @endforeach
            @else
                <p class="no-item">商品がありません</p>
            @endif
        </div>

    </div>

@endsection