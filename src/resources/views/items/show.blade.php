@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')

<div class="container">

    {{-- 画像 --}}
    <div class="item-detail__left">
        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-detail__image">
    </div>

    {{-- 商品詳細 --}}
    <div class="item-detail__right">

        <div class="item-detail__title">
            <h1 class="item-detail__name">
                {{ $item->name }}
            </h1>
            <div class="item-detail__sold">
                @if($item->is_sold)
                    <p class="sold">
                        Sold
                    </p>
                @endif
            </div>
        </div>
        
        <p class="item-detail__brand">
            {{ $item->brand }}
        </p>

        <p class="item-detail__price">
            ¥<span class="item-detail__price--big">{{ number_format($item->price) }}</span> (税込)
        </p>

        {{-- いいね・コメント --}}
        <div class="item-detail__actions">
            <div class="item-detail__action">
                @if($item->likes->isNotEmpty())
                    {{-- いいね解除 --}}
                    <form action="{{ route('like.destroy', ['item_id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="action__btn">
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

                        <button type="submit" class="action__btn">
                            <img 
                                src="{{ asset('images/heart_logo_default.png') }}" 
                                alt="not liked"
                                class="action__img--like"
                            >
                        </button>
                    </form>
                @endif
                
                <span class="count">{{ $item->likes_count }}</span>
            </div>

            <div class="item-detail__action">
                <div class="action__img">
                    <img src="{{ asset('images/comment_logo.png') }}" alt="comment_logo" class="action__img--like">
                </div>
                <span class="count">{{ $item->comments_count }}</span>
            </div>
        </div>

        {{-- 購入ボタン --}}
        <a href="{{ route('purchase', ['item_id' => $item->id]) }}" class="btn-red item-detail__button-buy">購入手続きへ</a>

        {{-- 商品説明 --}}
        <div class="item-detail__description">
            <h2 class="item-detail__section-title">
                商品説明
            </h2>

            <p class='item-detail__description-text'>
                {{ $item->description }}
            </p>
        </div>


        {{-- 商品情報 --}}
        <h2 class="item-detail__section-title">
            商品情報
        </h2>

        <div class="item-detail__category">
            <p class="item-detail__label item-detail__label--category">
                カテゴリー
            </p>
            <div class="item-detail__tag-parent">
                @foreach($item->categories as $category)
                    <span class="category-tag">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        </div>
        
        <div class="item-detail__condition">
            <p class="item-detail__label item-detail__label--category">
                商品の状態
            </p>        
            <p class="small-text">{{ $item->condition->name }}</p>
            
        </div>

        {{-- コメント --}}
        <div class="item-detail__comments">

            <p class="item-detail__section-title title-comment">
                コメント({{ $item->comments->count() }})
            </p>

            @foreach($item->comments as $comment)
                <div class="item-comment">
                    <div class="item-comment__user">
                        @if($comment->user && $comment->user->profile && $comment->user->profile->avatar)
                            <img 
                                src="{{ asset('storage/' . $comment->user->profile->avatar) }}" 
                                class="item-comment__user--avatar"
                            >
                        @else
                            <div class="default-avatar">
                                {{ mb_substr($comment->user->name ?? 'U', 0, 1) }}
                            </div>
                        @endif

                        <p class="item-comment__user--name">{{ $comment->user->name }}</p>
                    </div>

                    <div class="item-comment__text">
                        <p class="comment-text">{{ $comment->comment }}</p>
       
                        <p class="comment-date">{{ $comment->created_at->format('Y/m/d H:i') }}</p>
                    </div>
                </div>
            @endforeach
            
            <label class="item-detail__label item-detail__label--comment">
                商品へのコメント
            </label>

            <form  action="{{ route('comments.store', ['item_id' => $item->id]) }}" method="POST">
                @csrf
                
                <div class="item-detail__comment-btn">
                    <textarea name="comment" class="item-detail__comment-input">{{ old('comment') }}</textarea>
                    <p class="error">@error('comment'){{ $message }}@enderror</p>
                </div>
                
                <button type="submit" class="btn-red">
                    コメントを送信する
                </button>
            </form>

        </div>
    </div>
</div>

@endsection