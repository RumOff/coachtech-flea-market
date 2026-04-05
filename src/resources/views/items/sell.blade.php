@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

    <div class="sell-container">
      <h1 class="sell__title">商品の出品</h1>

      <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="sell-form">
        @csrf

        {{-- 商品画像 --}}
        <section class="sell-form__section">
          <label class="sell-form__label">商品画像</label>
          <div class="sell-form__upload-area">
            <input type="file" name="image" id="image" class="sell-form__file-input">
            <p>クリックしてファイルをアップロード</p>
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </section>

        {{-- 商品詳細 --}}
        <section class="sell-form__section">
          <h2 class="sell-form__sub-title">商品の詳細</h2>
          <div class="sell-form__group">
            <label for="category_id" class="sell-form__label">カテゴリー</label>
              @foreach ($categories as $category)
                <label class="category__item">
                  <input 
                    type="checkbox"
                    name="categories[]"
                    value="{{ $category->id }}"
                    class="category__checkbox"
                  >
                  <span class="category__label">
                    {{ $category->name }}
                  </span>

                </label>
                <option value="{{ $category->id }}">
                  {{ $category->name }}
                </option>
              @endforeach
            @error('categories')
            <p class="error">{{ $message }}</p>
            @enderror
          </div>
          
          <div class="sell-form__group">
            <label for="condition_id" class="sell-form__label">商品の状態</label>
              <select name="condition_id" id="condition_id" class="sell-form__select">
                <option value="">選択してください</option>
                @foreach($conditions as $condition)
                  <option value="{{ $condition->id }}">
                    {{ $condition->name }}
                  </option>
                @endforeach
              </select>
              @error('condition_id')
            <p class="error">{{ $message }}</p>
            @enderror
            </div>
        </section>

        {{-- 商品名と説明 --}}
        <section class="sell-form__section">
          <h2 class="sell-form__sub-title">商品名と説明</h2>
          <div class="sell-form__group">
            <label for="name" class="sell-form__label">商品名</label>
            <input type="text" name="name" id="name" class="sell-form__input">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="sell-form__group">
            <label for="brand" class="sell-form__label">ブランド名</label>
            <input type="text" name="brand" id="brand" class="sell-form__input">
          </div>

          <div class="sell-form__group">
            <label for="description" class="sell-form__label">商品の説明</label>
            <textarea name="description" id="description" rows="5" class="sell-form__textarea" ></textarea>
            @error('description')
            <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="sell-form__group">
            <label for="price" class="sell-form__label">販売価格</label>
            <div class="sell-form__price-input-wrap">
              <input type="number" name="price" id="price" class="sell-form__input" placeholder="¥">
              @error('price')
              <p class="error">{{ $message }}</p>
              @enderror
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