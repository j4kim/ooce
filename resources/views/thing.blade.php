@extends('layout')

@section('content')
  <p>
    @if ($thing->parent)
      Rangé dans: {{ $thing->parent->name }}
      <form action="{{ $thing->id }}/detach" method="post">
        @csrf
        @method('PUT')
        <button>Sortir</button>
      </form>
    @else
      <form action="{{ $thing->id }}/move" method="post">
        @csrf
        @method('PUT')
        Ranger dans: <input type="number" name="parent_id">
      </form>
    @endif
  </p>
  {{$thing->id}} - {{$thing->name}}
@endsection