@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <div class="profile__container">
        <div class="profile__header">
            <img src="{{ asset('storage/' . (optional($profile)->avatar ?? '/img/default.png')) }}" alt="" class="profile__avatar">

            <h1 class="profile__name">ユーザー名</h1>

            <a href="{{ route('profile.edit') }}" class="profile__link--edit">プロフィールを編集</a>
        </div>

        <div class="profile__tag">
            <a href="/mypage?page=sell" class="{{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>

            <a href="/mypage?page=buy" class="{{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
        </div>

        <div class="border-line"></div>

        <div class="item__cards">
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