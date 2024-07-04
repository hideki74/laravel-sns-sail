@extends('app')

@section('title', 'メモカード')

@section('content')
  @include('nav')
  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
      <a class="nav-link text-muted"
        href="">
        メモカード
      </a>
    </li>
  </ul>
  <board>
@endsection