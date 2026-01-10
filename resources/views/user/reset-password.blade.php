@extends('layout')
@section('title', 'Новый пароль')
@section('content')
<section class="reset">
  <h1>Новый пароль</h1>
  <form action="{{ route('password.update') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
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
    <input type="password" name="password_confirmation" placeholder="Повтор пароля">
    <button class="form-btn" type="submit">Отправить</button>
  </form>
  <a class="link-page" href="{{ route('register') }}">Ссылка на регистрацию</a>
  <a class="link-page" href="{{ route('home') }}">Вернуться на главную</a>
</section>
@endsection