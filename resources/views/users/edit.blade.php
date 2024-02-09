@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')

<h1>会員情報の編集</h1>

<form method="POST" action="{{ route('mypage') }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
        <label for="name" class="">氏名</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>氏名を入力してください</strong>
            </span>
            @enderror
    <br>

            <label for="email" class="text-md-left samuraimart-edit-user-info-label">メールアドレス</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>メールアドレスを入力してください</strong>
            </span>
            @enderror

    <hr>
    <button type="submit" class="btn nagoyameshi-submit-button mt-3 w-25">
        保存
    </button>
</form>
    



@endsection

@section('js')
@endsection