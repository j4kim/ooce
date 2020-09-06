@extends('layout')

@section('content')
  <p>
    @if ($thing->parent)
      Parent: {{$thing->parent->name}}
    @else
      Sorti
    @endif
  </p>
  {{$thing->id}} - {{$thing->name}}
@endsection