@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <!-- コンテンツ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="mt-3 mb-3">パスワード再設定</h3>

                <p>
                    ご登録時のメールアドレスを入力してください。<br>
                    パスワード再発行用のメールをお送りします。  
                </p>

                <hr>

                <!-- メッセージ -->
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- フォーム -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- メールアドレス入力欄 -->
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror nagoyameshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                        @error('email')
                            <!-- エラーメッセージ -->
                            <span class="invalid-feedback" role="alert">
                                <strong>メールアドレスが正しくない可能性があります。</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- 送信ボタン -->
                    <div class="form-group">
                        <button type="submit" class="btn nagoyameshi-submit-button w-100">
                            送信
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
