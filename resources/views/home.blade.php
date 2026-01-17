@extends('layout')
@section('title', 'Доска объявлений | Главная')
@section('content')
{{--@dump($categories)--}}
<h1>Доска объявлений</h1>
@forelse($categories as $category)
<h2>{{ $category->name }}</h2>
@forelse($category->subcategories as $subcategory)
<h3>{{ $subcategory->name }}</h3>
@forelse($subcategory->announcements as $announcement)
<h4>{{ $announcement->title  }}</h4>
@empty
<p>Нет объявлений</p>
@endforelse
@empty
<p>Нет субкатегорий</p>
@endforelse
@empty
<p>Нет категорий</p>
@endforelse
@endsection