@extends('layouts.app')

@section('css')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
  <h1>会社情報</h1>  
  <p>会社名 {{ $company->name }}</p>
  <p>〒{{ $company->postal_code}} {{ $company->address}}</p>
  <p>代表者 {{ $company->representative}}</p>
  <p>メール {{ $company->email}}</p>
@endsection