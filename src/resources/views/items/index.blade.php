@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="item__container">

    <!-- タブ -->
    <div class="item__tab">
        <a href="/items" class="item__tab item__tab--active">おすすめ</a>
        <a href="/mylist" class="item__tab item__tab--mylist">マイリスト</a>
    </div>

    <!-- 商品一覧 -->
    <div class="item__list">
        @if(isset($items))
            @foreach($items as $item)
            <div class="item__card">
                <a href="/item/{{ $item->id }}" class="item__link">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="item" class="item__img">
                    <p class="item__name">
                        {{ $item->name }}
                    </p>
                </a>
            </div>
            @endforeach
        @else
            <p class="no-item">商品がありません</p>
        @endif
    </div>

    @endsection