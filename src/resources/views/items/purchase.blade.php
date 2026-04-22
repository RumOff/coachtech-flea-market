@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/purchase.css') }}">
@endsection

@section('content')

    <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
    @csrf
        <div class="container">
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

                    <div class="purchase__select--wrapper">
                        <select name="payment" id="payment" class="purchase__select">
                            <option value="">選択してください</option>
                            <option value="credit" {{ old('payment') === 'credit' ? 'selected' : '' }}>クレジットカード</option>
                            <option value="convenience" {{ old('payment') == 'convenience' ? 'selected' : '' }}>コンビニ払い</option>
                        </select>
                    </div>
                        <p class="error">@error('payment'){{ $message }}@enderror</p>
                </div>

                <div class="border-line"></div>

                <div class="purchase__pay">
                    <div class="purchase__pay-box">
                        <h2 class="purchase__label">
                            配送先
                        </h2>

                        <a href="{{ route('purchase.address', ['item_id' => $item->id]) }}" class="purchase__link--update">変更する</a>
                    </div>

                    @if(!empty($useAddress->address))
                        <p class="purchase__address">
                            〒{{ $useAddress->postal_code ?? '' }}<br>
                            {{ $useAddress->address ?? ''  }}
                            {{ $useAddress->building ?? ''  }}
                        </p>
                    @else
                        <p class="error">住所を登録してください</p>
                    @endif

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

                        <p class="purchase__payment" id="payment_text"></p>
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                    </div>
                </div>    
                
                <button type="submit" class="purchase__button--buy btn-red">購入する</button>
                
            </div>
        </div>
    </form>   
    
    <script>
    document.getElementById('payment').addEventListener('change', function() {
        const value = this.value;

        let text = '';

        if (value === 'credit') {
            text = 'クレジットカード';
        } else if (value === 'convenience') {
            text = 'コンビニ払い';
        } else {
            text = '未選択';
        }

        document.getElementById('payment_text').textContent = text;
    });
    </script>
@endsection