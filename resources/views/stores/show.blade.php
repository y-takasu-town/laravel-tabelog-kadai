@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container nagoyameshi-container pd-5">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8">
                <!-- 成功メッセージの表示 -->
                @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- 店舗名の表示 -->
                <h1 class="text-center">{{$store->name}}</h1>

                <!-- 店舗画像の表示 -->
                @if ($store->image)
                    <img src="{{ asset($store->image) }}" class="w-100">
                @else
                    <img src="{{ asset('img/dummy.png')}}" class="w-100">
                @endif

                <div class="container">
                    <!-- 店舗情報の表示 -->
                    <div class="row p-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">店舗名:</span>
                        </div>
                        <div class="col">
                            <span>{{$store->name}}</span>
                        </div>
                    </div>
                    <!-- 以下、各店舗情報の表示 -->
                    <!-- ... -->

                    <!-- 予約ボタンの表示 -->
                    <div class="form-group text-center">
                        @if (Auth::user()->subscribed('default'))
                            <a href="{{route('stores.reservation', $store)}}">
                                <button type="submit" class="mt-3 btn nagoyameshi-submit-button ">
                                    予約
                                </button>
                            </a>
                        @else
                            <a href="{{route('subscription')}}" class="btn btn-primary my-3">
                                予約
                            </a>
                        @endif
                    </div><hr>

                    <!-- レビュー投稿フォーム -->
                    @auth
                        @if (Auth::user()->subscribed('default'))
                            <form method="POST" action="{{ route('reviews.store') }}"><br>
                                <!-- ... -->
                            </form>
                        @endif
                        <!-- カスタマーレビューの表示 -->
                        <!-- ... -->

                        <!-- お気に入りボタン -->
                        @if (Auth::user()->subscribed('default'))
                            <form action="{{ route('stores.favorite', $store) }}" method="POST">
                                <!-- ... -->
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
