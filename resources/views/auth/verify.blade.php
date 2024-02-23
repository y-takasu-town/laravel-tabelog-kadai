@extends('layouts.app')

@section('css')
    <!-- CSSスタイル -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
    <!-- メインコンテンツ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="text-center">会員登録ありがとうございます！</h3>

                <!-- 仮会員メッセージ -->
                <p class="text-center">
                    現在、仮会員の状態です。  
                </p>

                <!-- 確認メール送信メッセージ -->
                <p class="text-center">
                    ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。  
                </p>

                <!-- メール内のURL説明 -->
                <p class="text-center">
                    メール本文内のURLをクリックすると本会員登録が完了となります。  
                </p>

                <!-- トップページへのリンク -->
                <div class="text-center">
                    <a href="{{ url('/') }}" class="btn nagoyameshi-submit-button w-50 text-white">トップページへ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
