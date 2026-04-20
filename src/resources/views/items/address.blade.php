@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/address.css') }}">
@endsection

@section('content')

<div class="container">

    <h1 class="form__title">
        住所の変更
    </h1>

    <form action="{{ route('purchase.update', $item_id) }}" method="post" enctype="multipart/form-data" class="address__form">
        @csrf

        {{-- 郵便番号 --}}
        <div class="address__content">
            <label class="address__label">
                郵便番号
            </label>
            <input type="text" name="postal_code" class="address__input" value="{{ old('postal_code', $profile->postal_code ?? '') }}">
            
            <p class="error">@error('postal_code'){{ $message }}@enderror</p>
            
        </div>

        {{-- 住所 --}}
        <div class="address__content">
            <label class="address__label">
                住所
            </label>
            <input type="text" name="address" class="address__input" value="{{ old('address', $profile->address ?? '') }}">
            
            <p class="error">@error('address'){{ $message }}@enderror</p>
            
        </div>

        {{-- 建物名 --}}
        <div class="address__content">
            <label class="address__label">
                建物名
            </label>
            <input type="text" name="building" class="address__input" value="{{ old('building', $profile->building ?? '') }}">
        </div>

        <button type="submit" class="btn-red address__btn">
            更新する
        </button>
     
    </form>
</div>

@endsection