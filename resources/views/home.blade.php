@extends('layout')
@section('title', 'Доска объявлений | Главная')
@section('content')
<h1>Доска объявлений</h1>
@forelse($categories as $category)
<h2>{{ $category->name }}</h2>
<div>{!! $category->svg !!}</div>
@if($category->subcategories->isNotEmpty())
<ul>
  @foreach($category->subcategories as $subcategory)
  <li>{{ $subcategory->name }}</li>
  @endforeach
</ul>
@else
<p>В этой категории пока нет подкатегорий.</p>
@endif
@empty
<p>Данных не найдено</p>
@endforelse
@endsection