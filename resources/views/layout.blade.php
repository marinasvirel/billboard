<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Доска объявлений')</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
  <div class="container wrapper">
    <header>
      <a href="{{ route('home') }}">
        <img src="{{ asset('img/logo.png') }}" alt="logo">
      </a>
      @auth
      <div class="header-links">
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a class="header-link" href="{{ route('admin') }}">Админка</a>
        @endif
        <a class="header-link" href="{{ route('profile') }}">{{ auth()->user()->name }}</a>
        <a class="header-link" href="{{ route('announcement.create') }}">Подать объявление</a>
        <a class="header-link" href="{{ route('logout') }}">Выйти</a>
      </div>
      @endauth
      @guest
      @if(!Route::is('login', 'register', 'password.*'))
      <a class="header-link" href="{{ route('login') }}">Войти</a>
      @endif
      @endguest
    </header>
    <main>
      @if (session('message'))
      <div class="alert-message">
        {{ session('message') }}
      </div>
      @endif
      @yield('content')
    </main>
    <footer>© Зинченко Марина, 2026</footer>
  </div>

</body>

</html>