@extends('layout')
@section('title', 'Верификация')
@section('content')
<h1>Верификация</h1>
<p class="verify-text">
  Проверьте почту. Пройдите по ссылке в письме для верификации.
</p>
<form action="{{ route('verification.send') }}" method="post">
  @csrf
  <button type="submit">Отправить повторно</button>
</form>
@endsection