@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid top-container">
        <div class="row justify-content-center align-items-center" style="height: 70vh">
            <div class="col-md-6 text-center mx-auto">
                <h1 class="display-3">NAGOYA MESHI</h1>
                    <p class="lead">名古屋の味を、見つけよう。</p>
                <form action="{{ route('stores.index') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="お店を検索" aria-label="お店を検索" aria-describedby="button-addon2" name="keyword">
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected value="">カテゴリーを選択</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary btn-lg w-100">お店を探す</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // ローテーションさせる背景画像のURL配列
        var images = ["images/nagoya-bg.jpg", "images/hitsumabushi.jpg", "images/tebasaki.jpg"];
        var currentIndex = 0;

        function rotateBackground() {
            document.body.style.backgroundImage = "url('" + images[currentIndex] + "')";
            currentIndex = (currentIndex + 1) % images.length; // 次の背景画像へ
        }

        // 5秒ごとに背景画像をローテーション
        setInterval(rotateBackground, 5000);
    </script>
@endsection
