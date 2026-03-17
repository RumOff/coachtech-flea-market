<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>coachtech flea market</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">
          <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="logo" class="header__img">
        </a>
        <nav>
          <ul class="header-nav">

            {{-- @if(request()->is('admin*')) --}}
            @auth
            <li class="header-nav__item">
              <form action="/logout" method="post">
                @csrf
                <button class="header-nav__button">logout</button>
              </form>
            </li>
            @endauth
            {{-- @elseif(request()->is('login*'))
            <li class="header-nav__item">
              <a href="/register" class="header-nav__button">register</a>
            </li>
            @elseif(request()->is('register*'))
            <li class="header-nav__item">
              <a href="/login" class="header-nav__button">login</a>
            </li>
            @endif --}}

          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>