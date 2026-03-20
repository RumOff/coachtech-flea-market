@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

    <div class="sell-container">
        <h1 class="sell__title">商品の出品</h1>

        <form action="{{ route('item.store') }}" class="sell__form"></form>

    </div>

@endsection