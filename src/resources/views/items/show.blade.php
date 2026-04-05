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
        <div class="item-detail__sold">
            @if($item->is_sold)
                <p class="sold">
                    SOLD
                </p>
            @endif
        </div>

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
                                src="{{ asset('images/heart_logo_pink.png') }}" 
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
                                src="{{ asset('images/heart_logo_default.png') }}" 
                                alt="not liked"
                                class="action__img--like"
                            >
                        </button>
                    </form>
                @endif
                
                <span>{{ $item->likes_count }}</span>
            </div>

            <div class="item-detail__action">
                <div class="action__img">
                    <img src="{{ asset('images/comment_logo.png') }}" alt="comment_logo" class="action__img--like">
                </div>
                <span>{{ $item->comments_count }}</span>
            </div>
        </div>

        {{-- 購入ボタン --}}
        <a href="{{ route('purchase', ['item_id' => $item->id]) }}" class="item-detail__button-buy">購入手続きへ</a>

        {{-- 商品説明 --}}
        <div class="item-detail__description">
            <h2 class="item-detail__section-title">
                商品説明
            </h2>

            <p class='item-detail__description'>
                {{ $item->description }}
            </p>
        </div>


        {{-- 商品情報 --}}
        <div class="item-detail__info">

            <h2 class="item-detail__section-title">
                商品情報
            </h2>

            <p class="item-detail__label">
                カテゴリー：
            </p>

            @foreach($item->categories as $category)
                <span class="category-tag">
                    {{ $category->name }}
                </span>
            @endforeach

            <p class="item-detail__label">
                商品の状態：{{ $item->condition->name }}
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

                <textarea name="comment" class="item-detail__comment-input">{{ old('comment') }}</textarea>

                <button type="submit" class="item-detail__comment-button">
                    コメントを送信する
                </button>

            </form>
            <div class="item-detail__comment--error">
                @error('comment')
                    <p class="msg_error">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>
    </div>

@endsection