@extends('layout')

@section('content')
  <h2>
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
@endsection