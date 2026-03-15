@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="product__container">

    <!-- タブ -->
    <div class="product__tab">
        <a href="/products" class="product__tab product__tab--active">おすすめ</a>
        <a href="/mylist" class="product__tab product__tab--mylist">マイリスト</a>
    </div>

    <!-- 商品一覧 -->
    <div class="product__list">
        @foreach($products as $product)
            <div class="product__card">
                <a href="/item/{{ $product->id }}" class="product__link">
                    <img src="{{ $product->image }}" alt="product" class="product__img">
                    <p class="product__name">
                        {{ $product->name }}
                    </p>
                </a>
            </div>
        @endforeach
    </div>

@endsection