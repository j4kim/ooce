@extends('layout')

@section('content')
  <p>Résultats de la recherche "{{ $query }}"</p>
  @forelse ($things as $thing)
    <div class="card mb-3">
      <div class="card-body d-flex justify-content-between">
        <div>
          <a href="{{ route('show', $thing) }}" class="stretched-link text-decoration-none">
            <h4>
              {{ $thing->id }} <b>{{ $thing->name }}</b>
            </h4>
          </a>
          <div>{{ $thing->description }}</div>
        </div>
        @if ($thing->asset_path)
          <div>
            <img src="{{  Storage::url($thing->asset_path) }}" style="max-height:60px">
          </div>
        @endif
      </div>
    </div>
  @empty
    <p class="text-muted">Aucun résultat...</p>
  @endforelse
@endsection