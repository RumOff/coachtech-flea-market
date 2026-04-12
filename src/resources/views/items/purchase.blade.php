@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/purchase.css') }}">
@endsection

@section('content')

    <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
    @csrf
        <div class="purchase__container">
            <div class="purchase__left">

                <div class="purchase__box">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="item-image" class="purchase__img">
                    
                    <div class="purchase__box--product-name">
                        <h1 class="purchase__title">{{ $item->name }}</h1>
                        <p class="parchase__price">¥{{ number_format($item->price) }}</p>
                    </div>
                </div>

                <div class="border-line"></div>
                
                <div class="purchase__pay">
                    <h2 class="purchase__label">
                        支払方法
                    </h2>
                    <select name="payment" id="payment" class="purchase__select">
                        <option value="">選択してください</option>
                        <option value="credit" {{ old('payment') === 'credit' ? 'selected' : '' }}>クレジットカード</option>
                        <option value="convenience" {{ old('payment') == 'convenience' ? 'selected' : '' }}>コンビニ払い</option>
                    </select>
                    <div class="error">
                        @error('payment')
                            <p class="purchase__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-line"></div>

                <div class="purchase__pay">
                    <div class="purchase__pay-box">
                        <h2 class="purchase__label">
                            配送先
                        </h2>

                        <a href="{{ route('purchase.address', ['item_id' => $item->id]) }}" class="purchase__link--update">変更する</a>
                    </div>

                    <p class="purchase__address">
                        〒{{ $address['postal_code'] ?? Auth::user()->profile->postal_code }}<br>
                        {{ $address['address'] ??Auth::user()->profile->address }}
                        {{ $address['building'] ??Auth::user()->profile->building }}
                    </p>

                </div>

                <div class="border-line"></div>

            </div>

            <div class="purchase__right">
                <div class="purchase__check">
                    <div class="purchase__box--price">
                        <label for="" class="purchase__label-check">商品代金</label>
                        <p class="purchase__">
                            {{ number_format($item->price) }}円
                        </p>
                    </div>
                    <div class="border-line border-line--check"></div>
                    <div class="purchase__box--price">
                        <label for="" class="purchase__label-check">支払い方法</label>

                        <p class="purchase__">aaa</p>
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                    </div>
                </div>    
                
                <button type="submit" class="purchase__button--buy btn-red">購入する</button>
                
            </div>
        </div>
    </form>    
@endsection