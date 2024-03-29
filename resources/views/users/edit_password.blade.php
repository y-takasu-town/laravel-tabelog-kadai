@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <div class="container">
        <!-- パスワード更新フォーム -->
        <form method="post" action="{{ route('mypage.update_password') }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <!-- 新しいパスワード入力 -->
            <div class="form-group row mb-3">
                <label for="password" class="col-md-3 col-form-label text-md-right">新しいパスワード</label>

                <div class="col-md-7">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- パスワード確認入力 -->
            <div class="form-group row mb-3">
                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">確認用</label>

                <div class="col-md-7">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <!-- パスワード更新ボタン -->
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-primary my-3">
                    パスワード更新
                </button>
            </div>
        </form>
    </div>
@endsection
