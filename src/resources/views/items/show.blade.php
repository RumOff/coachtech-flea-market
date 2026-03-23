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
                @if($item->likes->isNotEmpty())
                    {{-- いいね解除 --}}
                    <form action="{{ route('like.destroy', ['item_id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="action__img">
                            <img 
                                src="{{ asset('images/ハートロゴ_ピンク.png') }}" 
                                alt="liked"
                                class="action__img--like"
                            >
                        </button>
                    </form>
                @else
                    {{-- いいね --}}
                    <form action="{{ route('like.store', ['item_id' => $item->id]) }}" method="POST">
                        @csrf

                        <button type="submit" class="action__img">
                            <img 
                                src="{{ asset('images/ハートロゴ_デフォルト.png') }}" 
                                alt="not liked"
                                class="action__img--like"
                            >
                        </button>
                    </form>
                @endif

                {{-- <div class="action__img">
                    <img src="{{ $item->likes->isNotEmpty()
                        ? asset('images/ハートロゴ_デフォルト.png')
                        : asset('images/ハートロゴ_デフォルト.png') }}" alt="like_logo"  
                        class="action__img--like"
                    >
                </div> --}}
                
                <span>{{ $item->likes_count }}</span>
            </div>

            <div class="item-detail__action">
                <div class="action__img">
                    <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="comment_logo" class="action__img--like">
                </div>
                <span>{{ $item->comments_count }}</span>
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

            <p class="item-detail__section-title">
                コメント( {{ $item->comments->count() }} )
            </p>

            @foreach($item->comments as $comment)
                <div class="item-comment">

                    <div class="item-comment__user">
                        {{ $comment->user->name }}
                    </div>

                    <div class="item-comment__text">
                        {{ $comment->comment }}
                    </div>

                    <div class="item-comment__text">
                        {{ $comment->created_at->format('Y/m/d H:i') }}
                    </div>
                </div>
            @endforeach
            
            <label class="item-detail__label">
                商品へのコメント
            </label>
            <form  action="{{ route('comments.store', ['item_id' => $item->id]) }}" method="POST">
                @csrf

                <textarea name="comment" class="item-detail__comment-input">
                </textarea>

                <button type="submit" class="item-detail__comment-button">
                    コメントを送信する
                </button>

            </form>

        </div>
    </div>
    </div>

@endsection