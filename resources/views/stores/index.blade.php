@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('css')
@endsection


@section('content')

    <form>
        <select name="category_id">
            <option disabled selected value>カテゴリを選択</option>
            @foreach($categories as $category)
                <option value="{{ $category->id}}">{{ $category->name}}</option>
            @endforeach
        </select>
        <input type="name" name="name">
        <button type="submit">検索</button>
    </form>

    <div>
        Sort By
        @sortablelink('price_range', '価格帯')
    </div>


    @foreach ($stores as $store)
    <div class="my-5">
        <a href="{{route('stores.show',$store)}}">{{ $store->name }}</a><br>
        {{ $store->category->name }}<br>
        {{ $store->discription }}<br>
        {{ $store->address }}<br>
    </div>
    @endforeach
@endsection


@section('js')
@endsection
