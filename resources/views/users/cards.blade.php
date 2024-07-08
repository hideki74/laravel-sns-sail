@extends('app')

@section('title', $user->name . 'のメモカード')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a class="nav-link text-muted"
          href="">
          メモカード
        </a>
      </li>
    </ul>
    <user-board>
  </div>
@endsection