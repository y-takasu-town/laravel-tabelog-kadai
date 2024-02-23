@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{session('message')}}
                    </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{session('error')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">予約</div>
                    <div class="card-body">
                        <form action="{{ route('stores.reservation.save', $store) }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="reserved_time" class="form-label">ご予約時間</label>
                                    <input type="datetime-local" class="form-control" name="reserved_time" required>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">ご利用人数</label>
                                    <input type="number" class="form-control" name="amount" required min="1">
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
@endsection
