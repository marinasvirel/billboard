@extends('layout')
@section('title', 'Редактирование подателей')
@section('content')
<section class="admin">
  <h1>Редактирование подателя</h1>
  <x-links-admin />
  <h2 class="bearer-edit-title">{{ $bearer->name }}</h2>
  <form action="{{ route('bearers.update', $bearer->id) }}" method="post" class="create-form">
    @csrf
    <div class="form-item">
      <label for="name">Имя</label>
      <input id="name" type="text" name="name" value="{{ old('name', $bearer->name) }}">
      <div class="error-box">
        @error('name')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-item">
      <label for="email">Email</label>
      <input id="email" type="text" name="email" value="{{ old('email', $bearer->email) }}">
      <div class="error-box">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-item">
      <label for="role">Роль</label>
      <select id="role" name="role" class="form-control">
        <option value="bearer" {{ (old('role', $bearer->role) == 'bearer') ? 'selected' : '' }}>
          bearer
        </option>
        <option value="admin" {{ (old('role', $bearer->role) == 'admin') ? 'selected' : '' }}>
          admin
        </option>
      </select>
      <div class="error-box">
        @error('role')
        {{ $message }}
        @enderror
      </div>
    </div>
    <button class="form-btn" type="submit">Редактировать</button>
  </form>
  @endsection