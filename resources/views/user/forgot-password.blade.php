@extends('layout')
@section('title', 'Восстановление пароля')
@section('content')
<section class="forgot">
  <h1>Восстановление пароля</h1>
  <p>Введите свой e-mail для получения ссылки на сброс пароля</p>
  <form action="{{ route('password.email') }}" method="post">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail">
    <div class="error-box">
      @error('email')
      {{ $message }}
      @enderror
    </div>
    <button class="form-btn" type="submit">Отправить</button>
  </form>
  <a class="link-page" href="{{ route('register') }}">Ссылка на регистрацию</a>
  <a class="link-page" href="{{ route('home') }}">Вернуться на главную</a>
  <a class="link-page" href="{{ route('login') }}">Сcылка на авторизацию</a>
</section>
@endsection