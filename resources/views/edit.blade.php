@extends('layout')

@section('content')
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <p>
    <form action="{{ route('update', $thing->id) }}" method="post">
      @csrf @method('PUT')
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-2">
          Nom:
          <input class="form-control" type="text" name="name" autofocus value="{{$thing->name}}">
        </div>
        <div class="col-12 mb-2">
          Description:
          <textarea class="form-control" name="description" class="btn btn-primary">{{ $thing->description}}</textarea>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-2">
          Rangé dans:
          <input class="form-control" name="parent_id" value="{{ $thing->parent_id }}">
        </div>
        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </form>
  </p>
@endsection