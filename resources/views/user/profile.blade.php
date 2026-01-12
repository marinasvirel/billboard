@extends('layout')
@section('title', 'Профиль')
@section('content')
<section class="profile">
  <h1>{{ auth()->user()->name }}</h1>
  <p>{{ auth()->user()->email }}</p>
@endsection