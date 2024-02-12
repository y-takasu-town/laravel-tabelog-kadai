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
                    <li>
                        <a href="{{route('mypage.favorite')}}">お気に入り一覧</a>
                    </li>
                </ul>
            </div>
        </div>

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
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
@endsection