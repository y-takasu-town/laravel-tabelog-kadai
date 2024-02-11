@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid top-container">
    <div class="row justify-content-center align-items-center" style="height: 70vh">
        <div class="col-md-6 text-center mx-auto">
          <h1>会社情報</h1>  
             <p>企業名: {{ $company->name }}</p>
             <p>〒{{ $company->postal_code}} {{ $company->address}}</p>
             <p>代表: {{ $company->representative}}</p>
             <p>メールアドレス: {{ $company->email}}</p>
        </div>
    </div>
</div>
@endsection