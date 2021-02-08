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
    {{ $thing->id }} <b>{{ $thing->name }}</b>
  </h2>
  <p style="white-space:pre">{{ $thing->description }}</p>
  <p><small>Dernier mouvement: {{ $thing->moved_at }}</small></p>
  @if($thing->picture_path)
    <div class="mb-3">
      <img src="{{  Storage::url($thing->picture_path) }}" style="max-width:300px; max-height:300px">
    </div>
  @endif
  <a href="{{ route('edit', $thing->id) }}" class="btn btn-secondary">
    <i class="bi bi-pencil-fill mr-1"></i> Modifier
  </a>
  <h3 class="mt-4">
    Trucs rangés dans ce truc
  </h3>
  <form class="my-3" action="{{ route('add', $thing->id) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-plus mr-1"></i> Ajouter un truc dans ce truc
    </button>
  </form>
  <ul>
    @foreach ($thing->children as $child)
      <li>
        <a href="{{ route('show', $child->id) }}">
          {{ $child->id }} <b>{{ $child->name }}</b>
        </a>
      </li>
    @endforeach
  </ul>
@endsection