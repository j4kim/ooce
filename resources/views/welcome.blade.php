@extends('layout')

@section('content')
  <div class="title m-b-md">
      Oocé
  </div>
  <form action="search" method="get">
      <input type="search" name="q" placeholder="Rechercher un truc">
  </form>
@endsection