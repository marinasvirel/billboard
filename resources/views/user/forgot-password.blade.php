@extends('layout')
@section('title', 'Восстановление пароля')
@section('content')
<section class="forgot">
  <h1>Восстановление пароля</h1>
  @if(session('status'))
  <div class="alert">
    {{ session('status') }}
  </div>
  @else
  <p class="form-message">Введите свой e-mail для получения ссылки на сброс пароля</p>
  <form action="{{ route('password.email') }}" method="post">
    @csrf
    <div class="form-item">
      <input type="text" name="email" value="{{ old('email') }}" placeholder="E-mail">
      <div class="error-box">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <button class="form-btn" type="submit">Отправить</button>
  </form>
  @endif
  <a class="link-page" href="{{ route('home') }}">Вернуться на главную</a>
  <a class="link-page" href="{{ route('register') }}">Ссылка на регистрацию</a>
  <a class="link-page" href="{{ route('login') }}">Сcылка на авторизацию</a>
</section>
@endsection