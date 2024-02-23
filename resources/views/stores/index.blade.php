@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        /* 追加したスタイル */
        .nagoyameshi-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* 画面の高さいっぱいに表示するため */
        }
    </style>
@endsection

@section('content')
    <div class="container nagoyameshi-container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8">
                <form>
                    @csrf
                    <select name="category_id">
                        <option disabled selected value>カテゴリを選択</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name}}</option>
                        @endforeach
                    </select>
                    <input type="text" name="keyword">
                    <button type="submit">検索</button>
                </form>

                <form method="GET" action="{{ route('stores.index')}}" class="form-inline">
                    <select name="sort" onChange="this.form.submit();" class="form-inline ml-2">
                        @foreach ($sort as $key => $value)
                            @if ($sorted == $value)
                                <option value=" {{ $value}}" selected>{{ $key }}</option>
                            @else
                                <option value=" {{ $value}}">{{ $key }}</option>
                            @endif
                        @endforeach
                    </select>
                </form>

                @foreach ($stores as $store)
                    <div class="my-5">
                        <a href="{{route('stores.show',$store)}}">{{ $store->name }}<br>
                            @if ($store->image !== "")
                                <img src="{{ asset($store->image) }}" class="img-thumbnail">
                            @else
                                <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                            @endif
                        </a><br>
                        {{ $store->category->name }}<br> 
                        {{ $store->address }}<br>
                        {{ $store->discription }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
