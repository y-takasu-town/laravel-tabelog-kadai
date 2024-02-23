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
                                    <select name="reservation_time" required>
                                        @for ($i = 0; $i < 24 * 2; $i++)
                                            @php
                                                $time = \Carbon\Carbon::createFromTime(0, 0)->addMinutes($i * 30);
                                            @endphp
                                            @if(old('reservation_time') && old('reservation_time') == $time->format('H:i'))
                                            <option value="{{ $time->format('H:i') }}" selected>{{ $time->format('H:i') }}</option>
                                            @else
                                            <option value="{{ $time->format('H:i') }}">{{ $time->format('H:i') }}</option>
                                            @endif
                                        @endfor
                                    </select>                                
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
