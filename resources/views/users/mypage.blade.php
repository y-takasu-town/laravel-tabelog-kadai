@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')

@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                会員ステータス
            </div>
            <div class="card-body">
                @if (Auth::user()->subscribed('default') && Auth::user()->subscription('default')->onGracePeriod() && empty(Auth::user()->subscription('default')->ends_at))
                    <form method="POST" action="{{route('stripe.cancel') }}">
                        @csrf
                            <button class="btn btn-danger">有料会員を解約する</button>
                    </form>
                @elseif (Auth::user()->subscribed('default') && Auth::user()->subscription('default')->onGracePeriod() && !empty(Auth::user()->subscription('default')->ends_at))
                    <p>有料会員を解約しました。{{ Auth::user()->subscription('default')->ends_at->format('Y年m月d日') }}までご利用いただけます。</p>
                @else
                    <p>有料会員に登録すると、店舗予約やお気に入り機能、お店のレビュー投稿ができます。</p>
                    <a class="btn btn-primary" href="{{ route('subscription') }}">有料会員に登録する</a>
                @endif
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                マイページ
            </div>
            <div class="card-body">
                <ul>
                    <li>
                        <a href="{{route('mypage.edit')}}">会員情報の編集</a>
                    </li>
                    <li>
                        <a href="{{route('mypage.edit_password')}}">パスワード変更</a>
                    </li>
                        @if (Auth::user()->subscribed('default'))
                    <li>
                        <a href="{{route('mypage.favorite')}}">お気に入り一覧</a>
                    </li>
                        @endif
                </ul>
            </div>
        </div>

        @if (Auth::user()->subscribed('default'))
            <div class="card mt-5">
                <div class="card-header">
                    ご予約履歴
                </div>
                <div class="card-body">
                    <ul>
                        @foreach (Auth::user()->reservations as $reservation)
                            <li>
                                <a href="{{route('stores.show', $reservation->store_id)}}">
                                    {{ $reservation->store->name }}
                                </a>
                                <p>来店予定時間: {{ $reservation->reserved_time }}</p>
                                <form action="{{route('reservations.destroy','$reservation')}}" method="post">
                                    @csrf
                                    <!-- @method('DELETE') -->
                                    <button type="submit">キャンセルする</button>
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
