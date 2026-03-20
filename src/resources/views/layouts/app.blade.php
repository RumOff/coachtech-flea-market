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

      {{-- ロゴ --}}
      <a class="header__logo" href="/">
        <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="logo" class="header__img">
      </a>

      {{-- 検索ボックス --}}
      <div class="header__search">
        <form action="/search" method="GET">
          <input type="text" name="keyword" class="header__search-box" placeholder="なにをお探しですか？">
        </form>
      </div>  

      {{-- ナビ --}}
      <nav class="header__nav">
        <ul class="nav-list">
          
          @auth
            <li class="nav-list__item">
              <form action="/logout" method="post">
                @csrf
                <button class="nav-list__button btn-logout">ログアウト</button>
              </form>
            </li>
          @else
              <li class="nav-list__item">
                <a href="/login" class="nav-list__link">ログイン</a>
              </li>
          @endauth

          <li class="nav-list__item">
            <a href="/mypage" class="nav-list__link">マイページ</a>
          </li>
          <li class="nav-list__item">
            <a href="/sell" class="nav-list__link nav-list__link--sell">出品</a>
          </li>

        </ul>
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>