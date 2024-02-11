@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

<div>
    <h2>{{$store->name}}</h2>
</div>


<div>
    <a href="{{ route('stores.index') }}"> 戻る</a>
</div>

@if ($store->image)
<img src="{{ asset($store->image) }}" class="w-50 img-fluid">
@else
<img src="{{ asset('img/dummy.png')}}" class="w-50 img-fluid">
@endif

<div>
    <strong>店舗名:</strong>
    {{$store->name}}
</div>

<div>
    <strong>店舗説明:</strong>
    {{$store->description}}
</div>

<div>
    <strong>開店時間:</strong>
    {{$store->open_time}} 
</div>

<div>
    <strong>閉店時間:</strong>
    {{$store->close_time}} 
</div>

<div>
    <strong>価格帯:</strong>
    {{$store->price_range}} 
</div>

<div>
    <strong>郵便番号:</strong>
    {{$store->postal_code}} 
</div>

<div>
    <strong>住所:</strong>
    {{$store->address}} 
</div>

<div>
    <strong>電話番号:</strong>
    {{$store->phone_number}} 
</div>

<div>
    <strong>休日:</strong>
    {{$store->holiday}} 
</div>

<a href="{{route('stores.reservation', $store)}}">予約</a>

<hr>
<h3>カスタマーレビュー</h3>
@foreach($reviews as $review)
<h3>{{ str_repeat('★', $review->star) }}</h3>
    <p>{{$review->comment}}</p>
    <label>{{$review->created_at}} {{$review->user->name}}</label>
@endforeach


@auth
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <h4>評価</h4>
             <select name="star">
                 <option value="5">★★★★★</option>
                 <option value="4">★★★★</option>
                 <option value="3">★★★</option>
                 <option value="2">★★</option>
                 <option value="1">★</option>
             </select>
        <h4>レビュー内容</h4>
        @error('comment')
            <strong>レビュー内容を入力してください</strong>
        @enderror
        <textarea name="comment"></textarea>
        <input type="hidden" name="store_id" value="{{$store->id}}">
        <button type="submit">レビューを追加</button>
    </form>
    <form action="{{ route('stores.favorite', $store) }}" method="POST">
        @csrf
        @if(!empty(Auth::user()->favorites()->where('store_id', $store->id)->first()))
        <button class="btn nagoyameshi-favorite-button text-favorite w-100">
            <i class="fa fa-heart"></i>
            お気に入り解除
        </button>
        @else
        <button  class="btn nagoyameshi-favorite-button text-favorite w-100">
            <i class="fa fa-heart"></i>
            お気に入り
        </button>
        @endif
    </form>

@endauth
@endsection

@section('js')
@endsection