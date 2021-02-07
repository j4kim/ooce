@extends('layout')

@section('content')
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <form class="mt-4" action="{{$thing->id}}/add" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">
      Ajouter un truc dans ce truc
    </button>
  </form>
@endsection