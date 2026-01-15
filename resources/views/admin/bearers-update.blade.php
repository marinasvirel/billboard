@extends('layout')
@section('title', 'Редактирование подателей')
@section('content')
<section class="admin">
  <h1>Редактирование подателя</h1>
  <x-links-admin />
  <h2 class="bearer-edit-title">{{ $bearer->name }}</h2>
  <form action="{{ route('bearers.update', $bearer->id) }}" method="post">
    @csrf
    <label for="name">Имя</label>
    <input id="name" type="text" name="name" value="{{ old('name', $bearer->name) }}" placeholder="Имя">
    <div class="error-box">
      @error('name')
      {{ $message }}
      @enderror
    </div>
    <label for="email">Email</label>
    <input id="email" type="text" name="email" value="{{ old('email', $bearer->email) }}" placeholder="E-mail">
    <div class="error-box">
      @error('email')
      {{ $message }}
      @enderror
    </div>
    <label for="role">Роль</label>
    <input id="role" type="text" name="role" value="{{ $bearer->role }}" placeholder="Роль">
    <div class="error-box">
      @error('role')
      {{ $message }}
      @enderror
    </div>
    <button class="form-btn" type="submit">Редактировать</button>
  </form>
  @endsection