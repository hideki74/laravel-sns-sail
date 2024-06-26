@extends('app')

@section('title', 'ブックマーク一覧')
@include('nav')

@section('content')
<ul class="nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="nav-link text-muted"
      href="{{ route('articles.index') }}">
      ブックマーク
    </a>
  </li>
</ul>

<div class="container">
  @foreach($articles as $article)
    @include('articles.card')
  @endforeach
</div>
@endsection