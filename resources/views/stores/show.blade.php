@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container nagoyameshi-container pd-5">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
            <h1 class=text-center>{{$store->name}}</h1>


            @if ($store->image)
                <img src="{{ asset($store->image) }}" class="w-100">
            @else
                <img src="{{ asset('img/dummy.png')}}" class="w-100">
            @endif

            <div class="container">
                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">店舗名:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->name}}</span>
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">店舗説明:</span>
                    </div>
                    <div class="col">
                    {{$store->description}}
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">開店時間:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->open_time}}<span>
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">閉店時間:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->close_time}}</span> 
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">価格帯:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->price_range}}</span> 
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">郵便番号:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->postal_code}} </span>
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">住所:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->address}} </span>
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">電話番号:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->phone_number}} </span>
                    </div>
                </div>

                <div class="row p-2 border-bottom">
                    <div class="col-2">
                        <span class="fw-bold">休日:</span>
                    </div>
                    <div class="col">
                        <span>{{$store->holiday}} </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group text-center">
                <a href="{{route('stores.reservation', $store)}}">
                    <button type="submit" class="mt-3 btn nagoyameshi-submit-button ">
                        予約
                    </button>
                </a>
            </div>

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
        <button class="btn nagoyameshi-favorite-button text-favorite w-20">
            <i class="fa fa-heart"></i>
            お気に入り解除
        </button>
        @else
        <button  class="btn nagoyameshi-favorite-button text-favorite w-20">
            <i class="fa fa-heart"></i>
            お気に入り
        </button>
        @endif
    </form>
@endauth
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection