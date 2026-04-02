@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="item__container">

    <!-- タブ -->
    <div class="item__tabs">
        <a href="{{ route('items.index', ['keyword' => request('keyword')]) }}" class="{{ $page === '' ? 'active' : '' }} item__tab">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}" class="{{ $page === 'mylist' ? 'active' : '' }} item__tab">マイリスト</a>
        <input type="hidden" name="tab" value="{{ request('tab') }}"> 
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
                    <div class="item__sold">
                    @if($item->is_sold)
                        <p class="sold">
                            SOLD
                        </p>
                    @endif
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <p class="no-item">商品がありません</p>
        @endif
    </div>

    @endsection