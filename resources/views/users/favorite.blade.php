@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1>お気に入り</h1>

        <!-- 成功メッセージの表示 -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- お気に入りリストの表示 -->
        @foreach ($favorites as $fav)
            <a href="{{ route('stores.show', $fav->store_id) }}">
                <h5>{{ $fav->store->name }}</h5>
                @if ($fav->store->image !== "")
                    <img src="{{ asset($fav->store->image) }}" class="img-thumbnail">
                @else
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                @endif
            </a>

            <!-- お気に入り解除フォーム -->
            <form action="{{ route('stores.favorite', $fav->store_id) }}" method="POST">
                @csrf
                <button class="btn btn-primary my-3">
                    お気に入り解除
                </button>
            </form>
            <hr> 
        @endforeach
    </div>
@endsection
