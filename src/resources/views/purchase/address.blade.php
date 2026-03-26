@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="address">

    <h1 class="address__title">
        住所の変更
    </h1>

    <form action="{{ route('purchase.update', $item_id) }}" method="post" enctype="multipart/form-data" class="address__form">
        @csrf

        {{-- 郵便番号 --}}
        <div class="address__content">
            <label class="address__label">
                郵便番号
            </label>
            <input type="text" name="postal_code" class="address__input">
            @error('postal_code')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div class="address__content">
            <label class="address__label">
                住所
            </label>
            <input type="text" name="address" class="address__input">
            @error('address')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div class="address__content">
            <label class="address__label">
                建物名
            </label>
            <input type="text" name="building" class="address__input">
            @error('building')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="address__btn">
            更新する
        </button>
     
    </form>
</div>

@endsection