@extends('layout')

@section('content')
  <h2>
    {{$thing->id}} <b>{{$thing->name}}</b>
  </h2>
  <p>
    <form action="{{ route('update', $thing->id) }}" method="post" id="update-form" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-2">
          Nom:
          <input class="form-control" type="text" name="name" value="{{$thing->name}}" required>
        </div>
        <div class="col-12 mb-2">
          Description:
          <textarea class="form-control" name="description" class="btn btn-primary" rows="5">{{ $thing->description}}</textarea>
        </div>
        <div class="col-12 mb-2">
          Photo:
          <input class="form-control" type="file" name="picture">
        </div>
        <div class="col-12 mt-2 mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="thing_container" id="thing-container-input"
              @if($thing->thing_container) checked @endif
            >
            <label class="form-check-label" for="thing-container-input">
              Ce truc peut contenir d'autres trucs
            </label>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-2">
          Rangé dans:
          <thing-input name="parent_id" value="{{ $thing->parent_id }}" />
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-12 mt-2 d-flex">
        <div class="flex-fill">
          <a class="btn btn-light mr-2" href="{{ route('show', $thing->id) }}">Annuler</a>
          <button type="submit" form="update-form" class="btn btn-primary">
            <i class="bi bi-check2"></i> Enregistrer
          </button>
        </div>
        <form action="{{ route('delete', $thing->id) }}" method="post">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger mr-2">
            <i class="bi bi-trash"></i> Supprimer
          </button>
        </form>
      </div>
    </div>
  </p>
@endsection
