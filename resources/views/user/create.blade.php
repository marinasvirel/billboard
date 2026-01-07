@extends('layout')
@section('title', 'Регистрация')
@section('content')
<section class="register">
  <h1>Регистрация</h1>
  <form action="{{ route('userStore') }}" method="post">
    @csrf
    <input type="text" name="name" value="{{ old('name') }}" placeholder="Имя" autofocus>
    <div class="error-box">
      @error('name')
      {{ $message }}
      @enderror
    </div>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail">
    <div class="error-box">
      @error('email')
      {{ $message }}
      @enderror
    </div>
    <input type="password" name="password" placeholder="Пароль">
    <div class="error-box">
      @error('password')
      {{ $message }}
      @enderror
    </div>
    <button class="form-btn" type="submit">Зарегистрироваться</button>
  </form>
  <a class="link-page" href="{{ route('login') }}">Ссылка на авторизацию</a>
  <a class="link-page" href="{{ route('home') }}">Вернуться на главную</a>
</section>
@endsection