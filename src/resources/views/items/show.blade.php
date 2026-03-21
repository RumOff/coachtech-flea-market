@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="item-detail__container">

    {{-- 画像 --}}
    <div class="item-detail__left">
        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-detail__image">
    </div>

    {{-- 商品詳細 --}}
    <div class="item-detail__right">

        <h1 class="item-detail__name">
            {{ $item->name }}
        </h1>

        <p class="item-detail__brand">
            {{ $item->brand }}
        </p>

        <p class="item-detail__price">
            ¥{{ number_format($item->price) }}
        </p>


        {{-- いいね・コメント --}}
        <div class="item-detail__actions">

            <div class="item-detail__action">
                ❤️
                {{-- <span>{{ $item->likes_count ?? 0 }}</span> --}}
            </div>

            <div class="item-detail__action">
                💬
                {{-- <span>{{ $item->comments->count() }}</span> --}}
            </div>

        </div>


        {{-- 購入ボタン --}}
        <button class="item-detail__buy">
            購入する
        </button>


        {{-- 商品説明 --}}
        <div class="item-detail__description">
            <h2 class="item-detail__section-title">
                商品説明
            </h2>

            <p>
                {{ $item->description }}
            </p>
        </div>


        {{-- 商品情報 --}}
        <div class="item-detail__info">

            <h2 class="item-detail__section-title">
                商品情報
            </h2>

            <p>
                <span class="item-detail__label">カテゴリー：</span>
                {{ $item->category->name ?? '' }}
            </p>

            <p>
                <span class="item-detail__label">商品の状態：</span>
                {{ $item->condition }}
            </p>

        </div>


        {{-- コメント --}}
        <div class="item-detail__comments">

            <h2 class="item-detail__section-title">
                コメント
            </h2>

            {{-- @foreach($item->comments as $comment)
                <div class="item-comment">

                    <div class="item-comment__user">
                        {{ $comment->user->name }}
                    </div>

                    <div class="item-comment__text">
                        {{ $comment->content }}
                    </div>

                </div>
            @endforeach --}}


            {{-- コメント投稿 --}}
            <form method="POST" action="/comments">
                @csrf

                <textarea 
                    name="content"
                    class="item-detail__comment-input"
                    placeholder="商品へのコメント"></textarea>

                <button class="item-detail__comment-button">
                    送信する
                </button>

            </form>

        </div>
    </div>
    </div>

@endsection