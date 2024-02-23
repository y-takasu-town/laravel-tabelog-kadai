<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF トークン -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- フォント -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- スクリプト -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/6b575be985.js" crossorigin="anonymous"></script>

    <!-- スタイル -->
    <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/stripe.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nagoyameshi.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">

        <!-- ヘッダー -->
        @component('components.header')
        @endcomponent

        <!-- エラーメッセージ -->
        @if ($errors->any())
        <div class="container py-3">
            <div class="row justify-content-center">
                <div class="col-md-6">                    
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-3">
                        {{ $error }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- メインコンテンツ -->
        <main class="py-4 mb-5">
            @yield('content')
        </main> 

        <!-- フッター -->
        @component('components.footer')
        @endcomponent
    </div>

    <!-- スクリプト -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
