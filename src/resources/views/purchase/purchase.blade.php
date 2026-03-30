@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
    @csrf
        <div class="purchase__container">
            <div class="purchase__left">
                <img src="{{ asset('storage/' . $item->image) }}" alt="item-image" class="purchase__img">
                <h1 class="purchase__title">{{ $item->name }}</h1>
                <p class="parchase__price">¥{{ number_format($item->price) }}</p>
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
                    <h2 class="purchase__label">
                        配送先
                    </h2>

                    <a href="{{ route('purchase.address', ['item_id' => $item->id]) }}" class="purchase__link--update">変更する</a>
                    
                    <p class="purchase__address">
                        〒{{ Auth::user()->profile->postal_code }}<br>
                        {{ Auth::user()->profile->address }}{{ Auth::user()->profile->building }}
                    </p>

                </div>

                <div class="border-line"></div>

            </div>


            <div class="purchase__right">
                <div class="purchase__box">

                    <label for="" class="purchase__price">商品代金</label>
                    <p class="purchase__">
                        {{ number_format($item->price) }}円
                    </p>

                    <label for="" class="purchase__pay">支払い方法</label>
                    <p class="purchase__"></p>
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button type="submit" class="purchase__button--buy">購入する</button>
                </div>
            </div>
        </div>
    </form>    
@endsection