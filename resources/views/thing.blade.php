@extends('layout')

@section('content')
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <p>
    <form action="{{$thing->id}}/update" method="post">
      @csrf @method('PUT')
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-2 mb-sm-0">
          <input class="form-control" type="text" name="name" value="{{$thing->name}}">
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <button type="submit" class="btn btn-primary">Renommer</button>
        </div>
      </div>
    </form>
  </p>
  <p>
    @if ($thing->parent)
      <form action="{{ $thing->id }}/detach" method="post">
        @csrf @method('PUT')
        Rangé dans: {{ $thing->parent->name }}
        <button type="submit" class="btn btn-primary">
          Sortir
        </button>
      </form>
    @else
      <form action="{{ $thing->id }}/move" method="post">
        @csrf @method('PUT')
        Ranger dans:
        <input
          style="max-width:100px"
          class="form-control d-inline"
          type="number"
          name="parent_id"
          min="1"
        >
      </form>
    @endif
  </p>
  <form action="create" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">
      Ajouter un truc
    </button>
  </form>
@endsection