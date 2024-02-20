@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <div class="container">
        <h1>会員情報の編集</h1>

        <form method="POST" action="{{ route('mypage') }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row mb-3">
                <label for="name" class="">氏名</label>
                <div class="col-md-7">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="email" class="text-md-left samuraimart-edit-user-info-label">メールアドレス</label>
                <div class="col-md-7">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn nagoyameshi-submit-button mt-3 w-25">
                    保存
                </button>
            </div>
        </form>
    </div>

@endsection

@section('js')
@endsection
