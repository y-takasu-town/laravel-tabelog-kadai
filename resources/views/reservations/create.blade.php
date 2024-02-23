@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- メインコンテンツ -->
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 成功メッセージを表示 -->
                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- エラーメッセージを表示 -->
                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">予約</div>
                    <div class="card-body">
                        <!-- 予約フォーム -->
                        <form id="reservationForm" action="{{ route('stores.reservation.save', $store) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="reserved_time" class="form-label">ご予約時間</label>
                                <input type="datetime-local" class="form-control" id="reserved_time" name="reserved_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">ご利用人数</label>
                                <input type="number" class="form-control" name="amount" id="amount" required min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">予約</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- フォームのバリデーション用JavaScript -->
    <script>
        document.getElementById('reservationForm').addEventListener('submit', function(event) {
            var reservedTimeInput = document.getElementById('reserved_time');
            var reservedTime = new Date(reservedTimeInput.value);
            var currentTime = new Date();

            // 予約日時が未来かどうかをチェック
            if (reservedTime <= currentTime) {
                alert('予約日時は現在時刻よりも後の日時を選択してください。');
                event.preventDefault();
            }
        });
    </script>
@endsection
