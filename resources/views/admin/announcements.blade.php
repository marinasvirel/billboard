@extends('layout')
@section('title', 'Админка | Объявления')
@section('content')
<section class="announcements">
  <h1>Объявления</h1>
  <x-links-admin />
  <div class="substrate">
    @foreach($announcements as $announcement)
    <div>
      <div>{{ $announcement->category->name }}</div>
      <div>{{ $announcement->subcategory->name }}</div>
      <div>{{ $announcement->action }}</div>
      <h2>{{ $announcement->title }}</h2>
      <p>{{ $announcement->text }}</p>
      <div class="gallery">
        @foreach($announcement->images as $image)
        <img src="{{ asset('storage/' . $image->path) }}"
          alt="{{ $announcement->title }}">
        @endforeach
      </div>
      <p>Автор: {{ $announcement->user->name }}</p>
      <div class="flex gap-2">
        {{-- Кнопка Опубликовать --}}
        <form action="{{ route('admin.announcements.publish', $announcement->slug) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success">Опубликовать</button>
        </form>

        {{-- Кнопка Отклонить --}}
        <form action="{{ route('admin.announcements.reject', $announcement->slug) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-danger">Отклонить</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  @endsection