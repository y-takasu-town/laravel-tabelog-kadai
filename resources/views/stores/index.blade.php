@extends('layouts.app')

@section('css')
@endsection


@section('content')
    @foreach ($stores as $store)
    <div class="my-5">
        <a href="{{route('stores.show',$store)}}">{{ $store->name }}</a><br>
        {{ $store->category->name }}<br>
        {{ $store->discription }}<br>
        {{ $store->address }}<br>
    </div>
    @endforeach
@endsection


@section('js')
@endsection
