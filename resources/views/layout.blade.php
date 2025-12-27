<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Доска объявлений')</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
  <div class="container">
    <header>
      <a href="{{ route('home') }}">home</a>
      @auth
      <a href="{{ route('logout') }}">Выйти</a>
      @endauth
      @guest
      <a href="{{ route('login') }}">Войти</a>
      @endguest
    </header>
    <main>
      @yield('content')
    </main>
    <footer>© Зинченко Марина, 2025</footer>
  </div>

</body>

</html>