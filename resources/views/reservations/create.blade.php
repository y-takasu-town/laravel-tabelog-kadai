@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
<form action="{{ route('stores.reservation.save', $store) }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="reserved_time" class="form-label">ご予約時間</label>
      <input type="datetime-local" class="form-control" name="reserved_time">
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">ご利用人数</label>
        <input type="number" class="form-control" name="amount">
    </div>
    <button type="submit" class="btn btn-primary">予約</button>
</form>
@endsection

@section('js')
@endsection