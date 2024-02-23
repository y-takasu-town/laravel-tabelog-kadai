@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if(session('message'))
        <!-- メッセージの表示 -->
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card mt-5">
                <div class="card-header" style="font-size: 20px; font-weight: bold;">
                    会員ステータス
                </div>
                <div class="card-body">
                    @if (!$user->subscribed('default'))
                        <!-- 無料会員情報 -->
                        <h1 class="text-center"><i class="fa-regular fa-user"></i>無料会員</h1>
                        <p class="text-center">有料会員になると、予約やレビュー投稿、お気に入り登録ができます。</p>
                    @elseif ($user->subscribed('default') && ($user->subscription('default')->ends_at === null || \Carbon\Carbon::parse($user->subscription('default')->ends_at)->lt(now())))
                        <!-- 有料会員情報 -->
                        <h1 class="text-center"><i class="fa-solid fa-crown"></i>有料会員</h1>
                        <p class="text-center">予約やレビュー投稿、お気に入り登録ができます。</p>
                    @else
                        <!-- 有料会員情報（有効期限付き） -->
                        <h1 class="text-center"><i class="fa-solid fa-crown"></i>有料会員</h1>
                        <p class="text-center">{{ \Carbon\Carbon::parse($user->subscription('default')->ends_at)->format('Y年m月d日') }}まで有効です。</p>
                    @endif
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header" style="font-size: 20px; font-weight: bold;">
                    マイページ
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="{{ route('mypage.edit') }}"><i class="fa-solid fa-pen-to-square"></i>会員情報の編集</a></li>
                        <li><a href="{{ route('mypage.edit_password') }}"><i class="fa-solid fa-lock"></i>パスワード変更</a></li>
                        @if (Auth::user()->subscribed('default'))
                            <!-- 有料会員特典 -->
                            <li><a href="{{ route('mypage.edit_card') }}"><i class="fa-solid fa-credit-card"></i>クレジットカード情報変更</a></li>
                            <li><a href="{{ route('mypage.favorite') }}"><i class="fa-solid fa-star"></i>お気に入り一覧</a></li>
                        @endif
                        @if(!$user->subscribed('default'))
                            <!-- 有料会員登録リンク -->
                            <li><a href="{{ route('subscription') }}"><i class="fa-solid fa-address-card"></i>有料会員に登録する</a></li>
                        @else
                            <!-- 有料会員解約リンク -->
                            @if ($user->subscription('default')->ends_at === null || \Carbon\Carbon::parse($user->subscription('default')->ends_at)->lt(now()))
                                <li><a href="#" onclick="event.preventDefault(); document.getElementById('subscription-cancel-form').submit();"><i class="fa-solid fa-address-card"></i>有料会員を解約する</a></li>
                                <form id="subscription-cancel-form" action="{{ route('subscription.cancel') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>

            @if (Auth::user()->subscribed('default'))
                <div class="card mt-5">
                    <div class="card-header" style="font-size: 20px; font-weight: bold;">
                        ご予約履歴
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach (Auth::user()->reservations as $reservation)
                                <li>
                                    <a href="{{ route('stores.show', $reservation->store_id) }}">
                                        {{ $reservation->store->name }}<br>
                                        @if ($reservation->store->image !== "")
                                            <img src="{{ asset($reservation->store->image) }}" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                                        @endif
                                    </a>
                                    <p>予約日時: {{ \Carbon\Carbon::parse($reservation->reserved_time)->format('Y-m-d H:i') }}</p>
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary my-3">キャンセル</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
@endsection
