@extends('layout')
@section('title', 'Доска объявлений | Главная')
@section('content')
{{--@dump($categories)--}}
<h1>Доска объявлений</h1>
@livewire('read-announcement')
@endsection