@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <div class="container">
        <!-- 会員情報編集フォーム -->
        <h1>会員情報の編集</h1>
        <form method="POST" action="{{ route('mypage') }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <!-- 氏名入力 -->
            <div class="form-group row mb-3">
                <label for="name" class="col-md-3 col-form-label text-md-right">氏名</label>
                <div class="col-md-7">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- メールアドレス入力欄 -->
            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>

                <div class="col-md-7">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="nagoyameshi@nagoyameshi.com">

                    @error('email')
                        <!-- エラーメッセージ -->
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- 保存ボタン -->
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-primary my-3">
                    保存
                </button>
            </div>
        </form>

        <!-- 退会フォーム -->
        <div class="form-group">
            <form method="POST" action="{{ route('mypage.destroy') }}">
                @csrf
                <input type="hidden" name="_method" value="DELETE">

                <!-- 退会ボタン -->
                <div data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal" class="text-center">
                    <a class="btn btn-primary my-3">
                        退会する
                    </a>
                </div>

                <!-- 退会確認モーダル -->
                <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                <button type="submit" class="btn btn-primary my-3">退会する</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
