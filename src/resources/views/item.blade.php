@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="product-detail__container">

    <!-- 画像 -->
    <div class="product-detail__left">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-detail__image">
    </div>

    <!-- 商品詳細 -->
    <div class="product-detail__right">
            <div class="product__card">
                <a href="/item/{{ $product->id }}" class="product__link">
                    <img src="{{ $product->image }}" alt="product" class="product__img">
                    <p class="product__name">
                        {{ $product->name }}
                    </p>
                </a>
            </div>
    </div>

@endsection