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
  <p style="white-space:pre-line">{{ $thing->description }}</p>
  <p><small>Dernier mouvement: {{ $thing->moved_at }}</small></p>
  @if($thing->asset_path)
    <div class="mb-3">
      <img src="{{  Storage::url($thing->asset_path) }}">
    </div>
  @endif
  <a href="{{ route('edit', $thing->id) }}" class="btn btn-secondary">
    <i class="bi bi-pencil-fill"></i> Modifier
  </a>
  <a href="{{ route('duplicate', $thing->id) }}" class="btn btn-secondary">
    <span class="bi bi-files"></span> Dupliquer
  </a>
  @if ($thing->thing_container || count($thing->children))
    <h3 class="mt-4">
      Trucs rangés dans ce truc
    </h3>
    <form class="my-3" action="{{ route('add', $thing->id) }}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary"
        @if(!$thing->thing_container) disabled @endif
      >
        <i class="bi bi-plus"></i> Ajouter un truc dans ce truc
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
  @endif
@endsection