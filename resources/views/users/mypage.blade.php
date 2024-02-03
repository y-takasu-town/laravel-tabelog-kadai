@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
<h1>マイページ</h1>

<hr>

<a href="{{route('mypage.edit')}}">会員情報の編集</a>
<br>

<a href="{{route('mypage.edit_password')}}">パスワード変更</a>
<br>

<a href="{{route('mypage.favorite')}}">お気に入り表示</a>
<br>


@endsection

@section('js')
@endsection