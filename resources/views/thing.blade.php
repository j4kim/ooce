@extends('layout')

@section('content')
  @if ($thing->parent)
  <div class="mb-2 font-weight-light">
    <a href="{{ route('show', $thing->parent->id) }}">
      ← {{ $thing->parent->name }}
    </a>
  </div>
  @endif
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <a href="{{ route('edit', $thing->id) }}" class="btn btn-light">Modifier</a>
  <form class="mt-4" action="{{ route('add', $thing->id) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">
      Ajouter un truc dans ce truc
    </button>
  </form>
@endsection