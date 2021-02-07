@extends('layout')

@section('content')
  @if($root)
    <h2>
      Truc racine: 
      <a href="{{ route('show', $root) }}">
        {{ $root->name }}
      </a>
    </h2>
  @endif
  @if(count($orphans))
    <h2 class="mt-4">
      Trucs pas rangés
    </h2>
    <ul>
      @foreach ($orphans as $orphan)
        <li>
          <a href="{{ route('show', $orphan->id) }}">
            {{ $orphan->id }} <b>{{ $orphan->name }}</b>
          </a>
        </li>
      @endforeach
    </ul>
  @endif
  <form class="mt-5 text-center" action="{{ route('create') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-plus mr-1"></i> Créer un truc
    </button>
  </form>
@endsection