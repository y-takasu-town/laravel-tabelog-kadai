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
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('js')
@endsection