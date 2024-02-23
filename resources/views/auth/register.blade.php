@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <!-- メインコンテンツ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="mt-3 mb-3">新規会員登録</h3>

                <hr>

                <!-- 会員登録フォーム -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- 氏名入力欄 -->
                    <div class="form-group row">
                        <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror nagoyameshi-login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="鈴木 一郎">

                            @error('name')
                                <!-- エラーメッセージ -->
                                <span class="invalid-feedback" role="alert">
                                    <strong>氏名を入力してください</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- メールアドレス入力欄 -->
                    <div class="form-group row">
                        <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nagoyameshi@nagoyameshi.com">

                            @error('email')
                                <!-- エラーメッセージ -->
                                <span class="invalid-feedback" role="alert">
                                    <strong>メールアドレスを入力してください</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- パスワード入力欄 -->
                    <div class="form-group row">
                        <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="ml-1 nagoyameshi-require-input-label"><span class="nagoyameshi-require-input-label-text">必須</span></span></label>

                        <div class="col-md-7">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror nagoyameshi-login-input" name="password" required autocomplete="new-password">

                            @error('password')
                                <!-- エラーメッセージ -->
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- パスワード確認入力欄 -->
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-5 col-form-label text-md-left"></label>

                        <div class="col-md-7">
                            <input id="password-confirm" type="password" class="form-control nagoyameshi-login-input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <!-- アカウント作成ボタン -->
                    <div class="form-group">
                        <button type="submit" class="btn nagoyameshi-submit-button w-100">
                            アカウント作成
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
