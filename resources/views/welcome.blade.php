@extends('layout')

@section('content')
  <div class="title m-b-md">
      Oocé
  </div>
  <form action="search" method="get" class="m-b-md">
      <input type="search" name="q" placeholder="Rechercher un truc">
  </form>
  <a href="add" class="title">+</a>
@endsection