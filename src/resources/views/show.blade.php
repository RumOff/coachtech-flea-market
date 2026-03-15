@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="product-detail__container">

    {{-- 画像 --}}
    <div class="product-detail__left">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-detail__image">
    </div>

    {{-- 商品詳細 --}}
    <div class="product-detail__right">

        <h1 class="product-detail__name">
            {{ $product->name }}
        </h1>

        <p class="product-detail__brand">
            {{ $product->brand }}
        </p>

        <p class="product-detail__price">
            ¥{{ number_format($product->price) }}
        </p>


        {{-- いいね・コメント --}}
        <div class="product-detail__actions">

            <div class="product-detail__action">
                ❤️
                {{-- <span>{{ $product->likes_count ?? 0 }}</span> --}}
            </div>

            <div class="product-detail__action">
                💬
                {{-- <span>{{ $product->comments->count() }}</span> --}}
            </div>

        </div>


        {{-- 購入ボタン --}}
        <button class="product-detail__buy">
            購入する
        </button>


        {{-- 商品説明 --}}
        <div class="product-detail__description">
            <h2 class="product-detail__section-title">
                商品説明
            </h2>

            <p>
                {{ $product->description }}
            </p>
        </div>


        {{-- 商品情報 --}}
        <div class="product-detail__info">

            <h2 class="product-detail__section-title">
                商品情報
            </h2>

            <p>
                <span class="product-detail__label">カテゴリー：</span>
                {{ $product->category->name ?? '' }}
            </p>

            <p>
                <span class="product-detail__label">商品の状態：</span>
                {{ $product->condition }}
            </p>

        </div>


        {{-- コメント --}}
        <div class="product-detail__comments">

            <h2 class="product-detail__section-title">
                コメント
            </h2>

            {{-- @foreach($product->comments as $comment)
                <div class="product-comment">

                    <div class="product-comment__user">
                        {{ $comment->user->name }}
                    </div>

                    <div class="product-comment__text">
                        {{ $comment->content }}
                    </div>

                </div>
            @endforeach --}}


            {{-- コメント投稿 --}}
            <form method="POST" action="/comments">
                @csrf

                <textarea 
                    name="content"
                    class="product-detail__comment-input"
                    placeholder="商品へのコメント"></textarea>

                <button class="product-detail__comment-button">
                    送信する
                </button>

            </form>

        </div>
    </div>
    </div>

@endsection