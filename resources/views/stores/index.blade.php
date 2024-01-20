@extends('layouts.app')

@section('css')
@endsection


@section('content')
    @foreach ($stores as $store)
    <div class="my-5">
        {{ $store->name }}<br>
        {{ $store->category->name }}<br>
        {{ $store->discription }}<br>
        {{ $store->address }}<br>
    </div>
    @endforeach
@endsection


@section('js')
@endsection
