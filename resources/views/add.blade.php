@extends('layout')

@section('content')
  <h1>Ajouter un truc</h1>
  <form action="create" method="post" class="m-b-md">
    @csrf
    <p><input type="text" name="name" placeholder="Nom"></p>
    <p><button>Ajouter</button></p>
  </form>
@endsection