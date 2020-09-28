@extends('layout')

@section('content')
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <p>
    <form action="{{$thing->id}}/update" method="post">
      @csrf @method('PUT')
      <input type="text" name="name" value="{{$thing->name}}">
      <button>Renommer</button>
    </form>
  </p>
  <p>
    @if ($thing->parent)
      <form action="{{ $thing->id }}/detach" method="post">
        @csrf @method('PUT')
        Rangé dans: {{ $thing->parent->name }}
        <button>Sortir</button>
      </form>
    @else
      <form action="{{ $thing->id }}/move" method="post">
        @csrf @method('PUT')
        Ranger dans: <input type="number" name="parent_id">
      </form>
    @endif
  </p>
  <form action="create" method="post">
    @csrf
    <button>Ajouter un truc</button>
  </form>
@endsection