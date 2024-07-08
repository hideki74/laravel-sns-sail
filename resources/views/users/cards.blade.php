@extends('app')

@section('title', $user->name . 'のメモカード')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <board>
  </div>
@endsection