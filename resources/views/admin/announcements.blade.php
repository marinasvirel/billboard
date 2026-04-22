@extends('layout')
@section('title', 'Админка | Объявления')
@section('content')
<section class="announcements">
  <h1>Объявления</h1>
  <x-links-admin />
  <div class="substrate">
    @foreach($announcements as $announcement)
    <div class="announcement-box">
      <div class="announcement-tags">
        <div class="announcement-tag">{{ $announcement->category->name }}</div>
        <div class="announcement-tag">{{ $announcement->subcategory->name }}</div>
        <div class="announcement-tag">{{ $announcement->action }}</div>
      </div>
      <ul class="announcement-photos-list">
        @foreach($announcement->images as $image)
        <li class="announcement-photos-item">
          <img src="{{ asset('storage/' . $image->path) }}"
            alt="{{ $announcement->title }}">
        </li>
        @endforeach
      </ul>
      <div class="announcement-admin-margin">
        <h2 class="announcement-admin-title">{{ $announcement->title }}</h2>
        <p class="announcement-admin-text">{{ $announcement->text }}</p>
        <p class="announcement-author">Автор: {{ $announcement->user->name }}</p>
      </div>
      <div class="announcement-admin-btns">
        <form action="{{ route('admin.announcements.publish', $announcement->slug) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success">Опубликовать</button>
        </form>
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