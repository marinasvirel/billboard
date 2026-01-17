@extends('layout')
@section('title', 'Доска объявлений | Главная')
@section('content')
<h1>Доска объявлений</h1>
@forelse($categories as $category)
<h2>{{ $category->name }}</h2>
<div>{!! $category->svg !!}</div>
@empty
<p>Данных не найдено</p>
@endforelse
@endsection