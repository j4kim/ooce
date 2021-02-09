@extends('layout')

@section('content')
  <p>Résultats de la recherche "{{ $query }}"</p>
  <ul>
    @forelse ($things as $thing)
    <li>
      <a href="{{ route('show', $thing) }}">
        {{ $thing->id }} <b>{{ $thing->name }}</b>
      </a>
    </li>
    @empty
    <li>Aucun résultat</li>
    @endforelse
  </ul>
@endsection