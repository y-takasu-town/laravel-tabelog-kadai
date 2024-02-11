@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
 
@section('content')
<h1>お気に入り</h1>

@if(session('success'))
<div class="alert alert-success">
   {{ session('success') }}
</div>
@endif

@foreach ($favorites as $fav)
<a href="{{route('stores.show', $fav->store_id)}}">
<h5>{{ $fav->store->name }}</h5>
@if ($fav->store->image !== "")
        <img src="{{ asset($fav->store->image) }}" class="img-thumbnail">
        @else
        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
        @endif
</a>

<form action="{{route('stores.favorite', $fav->store_id)}}" method="POST">
   @csrf
   <button class="btn btn-outline-danger">
      お気に入り解除
   </button>
</form>
<hr> 
@endforeach


@endsection
