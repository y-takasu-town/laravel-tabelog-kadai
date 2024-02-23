@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container nagoyameshi-container pd-5">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                <!-- 検索フォーム -->
                <form>
                    @csrf
                    <select name="category_id">
                        <!-- カテゴリ選択のドロップダウンメニュー -->
                        <option disabled selected value>カテゴリを選択</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name}}</option>
                        @endforeach
                    </select>
                    <!-- キーワード入力 -->
                    <input type="text" name="keyword">
                    <!-- 検索ボタン -->
                    <button type="submit">検索</button>
                </form>

                <!-- ソートフォーム -->
                <form method="GET" action="{{ route('stores.index')}}" class="form-inline">
                    <select name="sort" onChange="this.form.submit();" class="form-inline ml-2">
                        <!-- ソートオプションのドロップダウンメニュー -->
                        @foreach ($sort as $key => $value)
                            @if ($sorted == $value)
                                <option value=" {{ $value}}" selected>{{ $key }}</option>
                            @else
                                <option value=" {{ $value}}">{{ $key }}</option>
                            @endif
                        @endforeach
                    </select>
                </form>

                <!-- 店舗一覧 -->
                @foreach ($stores as $store)
                    <div class="my-5">
                        <a href="{{ route('stores.show',$store) }}">{{ $store->name }}<br>
                            <!-- 店舗画像 -->
                            @if ($store->image !== "")
                                <img src="{{ asset($store->image) }}" class="img-thumbnail">
                            @else
                                <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                            @endif
                        </a><br>
                        <!-- カテゴリ名、住所、説明文 -->
                        {{ $store->category->name }}<br> 
                        {{ $store->address }}<br>
                        {{ $store->description }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
