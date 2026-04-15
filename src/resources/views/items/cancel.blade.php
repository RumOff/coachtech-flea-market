@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/cancel.css') }}">
@endsection

@section('content')

    <p class="cancel__msg">決済がキャンセルされました</p>

    <a href="{{ route('items.show', $item->id) }}">
        商品ページに戻る
    </a>

@endsection