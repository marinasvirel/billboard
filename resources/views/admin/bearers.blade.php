@extends('layout')
@section('title', 'Админка | Податели')
@section('content')
<section class="bearers">
  <h1>Податели</h1>
  <x-links-admin />
  <div class="substrate">
    <table>
      <thead>
        <tr>
          <td>Имя</td>
          <td>E-mail</td>
          <td>Роль</td>
          <td>Бан</td>
          <td></td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role }}</td>
          <td>Бан</td>
          <td class="right-td">
            <a class="table-link" href="">
              Забанить
            </a>
          </td>
          <td class="right-td">
            <a class="table-link" href="{{ route('bearers.edit', $user->id) }}">
              &#9998
            </a>
          </td>
        </tr>
        @empty
        <p>Данных не найдено</p>
        @endforelse
      </tbody>
    </table>
  </div>
  @endsection