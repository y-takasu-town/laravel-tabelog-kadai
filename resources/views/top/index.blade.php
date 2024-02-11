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
@endsection
