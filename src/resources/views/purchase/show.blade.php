@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <div class="purchase__container">
        <div class="purchase__left">
            <img src="{{ asset('strage/' . $iterm->image) }}" alt="item-image" class="purchase__img">
            <h1 class="purchase__title">{{ $item->name }}</h1>
            <p class="parchase__price">\{{ $item->price }}</p>


            <div class="border-line"></div>
            
            <div class="purchase__pay">
                <h2 class="purchase__label">
                    支払方法
                </h2>


            </div>

            <div class="border-line"></div>

            <div class="purchase__pay">
                <h2 class="purchase__label">
                    配送先
                </h2>

                <a href="{{ route('purchase.address') }}" class="purchase__link--update">変更する</a>
                
                <p class="purchase__address">〒</p>

            </div>

            <div class="border-line"></div>

        </div>


        <div class="purchase__right">
            <div class="purchase__box">
                <label for="" class="purchase__price">商品代金</label>
                <p class="purchase__"></p>
                <label for="" class="purchase__pay">支払い方法</label>
                <p class="purchase__"></p>
                <form action="{{ route('purchase.sell') }}" class="purchase__button--buy"></form>
            </div>
            
        </div>

    </div>
@endsection