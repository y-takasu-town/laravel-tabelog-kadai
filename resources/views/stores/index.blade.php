@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container nagoyameshi-container pd-5">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
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
                            {{ カテゴリ名:$store->category->name }}<br> 
                            {{ 住所:$store->address }}<br>
                            {{ 店舗説明:$store->discription }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
