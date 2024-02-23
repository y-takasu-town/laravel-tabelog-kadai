@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- コンテンツ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- カードヘッダー -->
                    <div class="card-header">{{ __('パスワード(確認用)') }}</div>

                    <div class="card-body">
                        <!-- メッセージ -->
                        {{ __('続行する前にパスワードを確認してください') }}

                        <!-- フォーム -->
                        <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                            <!-- パスワード入力欄 -->
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <!-- エラーメッセージ -->
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- 送信ボタン -->
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('パスワード(確認用)') }}
                                    </button>

                                    <!-- パスワードリセットリンク -->
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('パスワードをお忘れですか ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
