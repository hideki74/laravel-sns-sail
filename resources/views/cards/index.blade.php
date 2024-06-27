@extends('app')

@section('title', 'カードメモ')
@include('nav')

@section('content')
<ul class="nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="nav-link text-muted"
      href="">
      カード
    </a>
  </li>
</ul>

<board></board>