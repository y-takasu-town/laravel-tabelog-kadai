@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container nagoyameshi-container pd-5">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
                @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif
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
                            {{$store->discription}}
                        </div>
                    </div>

                    <div class="row p-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">開店時間:</span>
                        </div>
                        <div class="col">
                            <span>{{ \Carbon\Carbon::parse($store->open_time)->format('H:i') }}<<span>
                        </div>
                    </div>

                    <div class="row p-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">閉店時間:</span>
                        </div>
                        <div class="col">
                            <span>{{ \Carbon\Carbon::parse($store->close_time)->format('H:i') }}<</span> 
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

                @auth
                    @if (Auth::user()->subscribed('default'))
                        <form method="POST" action="{{ route('reviews.store') }}"><br>
                            @csrf
                            <h5>評価</h5>
                                <select name="star">
                                    <option value="5">★★★★★</option>
                                    <option value="4">★★★★</option>
                                    <option value="3">★★★</option>
                                    <option value="2">★★</option>
                                    <option value="1">★</option>
                                </select><br><br>
                            <h5>レビュー投稿をしてみよう</h5>
                                @error('comment')
                                    <strong>レビュー内容を入力してください</strong>
                                @enderror
                                    <textarea name="comment" rows="5" cols="70"></textarea>
                                    <input type="hidden" name="store_id" value="{{$store->id}}">
                                    <button type="submit">レビューを追加</button>
                        </form>
                    @endif
                        <br>
                            <h5>カスタマーレビューを読んでみよう</h5>
                                @if (!Auth::user()->subscribed('default'))
                                    <a href="{{route('subscription')}}" class="btn btn-primary my-3">有料会員になってレビューを投稿しよう</a>
                                @endif
                                @foreach($reviews as $review)
                                    <h5><i class="fa-regular fa-user"></i>{{$review->user->name}}</h5>
                                    <h3>{{ str_repeat('★', $review->star) }}</h3>
                                    <p>{{$review->comment}}</p>
                                @endforeach

                    @if (Auth::user()->subscribed('default'))
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
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
