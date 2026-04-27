@extends('layout')
@section('title', $announcement->title)
@section('content')
<div class="announcement">
    <ul class="announcement-photos-list">
        @forelse($announcement->images as $index => $image)
        <li class="announcement-photos-item">
            <img src="{{ asset('storage/' . $image->path) }}" alt="Фото к объявлению {{ $announcement->title }}">
        </li>
        @empty
        <p>Фотографии отсутствуют</p>
        @endforelse
    </ul>
    <div class="announcement-content">
        <h1>{{ $announcement->title }}</h1>
        <p class="announcement-text-show">{{ $announcement->text }}</p>
        <p class="announcement-author">Автор: {{ $announcement->user->name }}</p>
    </div>
</div>

@endsection