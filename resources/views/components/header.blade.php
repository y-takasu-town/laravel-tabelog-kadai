<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/logo.jpg')}}" class="img-logo">
        {{ config('app.name', 'Laravel') }}
    </a>
    <form class="row g-1">
        <div class="col-auto">
        </div>
        <div class="col-auto">
        </div>
      </form>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto mr-5 mt-2">
          <!-- Authentication Links -->
          @guest
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          <hr>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
          </li>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
          </li>
          @else
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa-solid fa-house"></i>ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          <li class="nav-item mr-5">
            <a href="{{route('mypage')}}" class="nav-link">
              <i class="fa-solid fa-house"></i> マイページ
            </a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
 