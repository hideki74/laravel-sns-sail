@extends('app')

@section('title', 'カードメモ')

@section('content')
  @include('nav')
  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
      <a class="nav-link text-muted"
        href="">
        カード
      </a>
    </li>
  </ul>
  <board>
@endsection