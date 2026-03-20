@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

    <div class="sell-container">
        <h1 class="sell__title">商品の出品</h1>
{{-- ここ --}}
        <form action="{{ route('item.store') }}" class="sell__form"></form>
        <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" class="sell-form">
      @csrf

      {{-- 1. 商品画像 --}}
      <section class="sell-form__section">
        <label class="sell-form__label">商品画像<span class="sell-form__required">必須</span></label>
        <div class="sell-form__upload-area">
          <input type="file" name="item_image" id="item_image" class="sell-form__file-input">
          <p>クリックしてファイルをアップロード</p>
        </div>
      </section>

      {{-- 2. 商品名と説明 --}}
      <section class="sell-form__section">
        <div class="sell-form__group">
          <label for="name" class="sell-form__label">商品名<span class="sell-form__required">必須</span></label>
          <input type="text" name="name" id="name" class="sell-form__input" placeholder="商品名（40文字まで）">
        </div>
        <div class="sell-form__group">
          <label for="description" class="sell-form__label">商品の説明<span class="sell-form__required">必須</span></label>
          <textarea name="description" id="description" rows="5" class="sell-form__textarea" placeholder="商品の状態、色、素材、重さ、定価、注意点など"></textarea>
        </div>
      </section>

      {{-- 3. 商品の詳細（カテゴリー・状態） --}}
      <section class="sell-form__section">
        <h3 class="sell-form__sub-title">商品の詳細</h3>
        <div class="sell-form__group">
          <label for="category" class="sell-form__label">カテゴリー<span class="sell-form__required">必須</span></label>
          <select name="category" id="category" class="sell-form__select">
            <option value="">選択してください</option>
            {{-- ここにforeachでDBからカテゴリーを出す --}}
          </select>
        </div>
      </section>

      {{-- 4. 販売価格 --}}
      <section class="sell-form__section">
        <h3 class="sell-form__sub-title">販売価格（300〜9,999,999）</h3>
        <div class="sell-form__group sell-form__group--price">
          <label for="price" class="sell-form__label">販売価格</label>
          <div class="sell-form__price-input-wrap">
            <span class="sell-form__currency">¥</span>
            <input type="number" name="price" id="price" class="sell-form__input" placeholder="0">
          </div>
        </div>
      </section>

      {{-- 送信ボタン --}}
      <div class="sell-form__btn-area">
        <button type="submit" class="sell-form__btn-submit">出品する</button>
      </div>

    </form>
    </div>

@endsection