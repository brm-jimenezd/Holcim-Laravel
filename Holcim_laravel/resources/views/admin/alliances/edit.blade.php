@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Alianzas: {{ $alliance->name }}</h1>
  <form action="{{ route('admin.alliances.update', $alliance->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label for="name">Nombre de la alianza</label>
      <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $alliance->name }}" required>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Descripción</label>
          <textarea name="description" id="description" class="form-control">{{ old('description') ? old('description') : $alliance->description }}</textarea>
        </div>
      </div>
      <div class="col-md-6">
        <label for="picture">Imagen</label>
        <input type="file" class="form-control" name="picture" id="picture">
        @if($alliance->picture)
          <a data-fancybox href="/uploads/{{ $alliance->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> /uploads/{{ $alliance->picture }}
          </a>
        @endif
      </div>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ $alliance->active ? 'checked' : '' }}>
      <label class="form-check-label" for="active">
        Activo
      </label>
    </div>
    <div class="form-group">
      <a class="btn btn-danger btn-sm float-right" href="#" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">
          <i class="far fa-trash-alt"></i> Borrar
      </a>
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
    </div>
  </form>
</div>

<form id="destroy-form" action="{{ route('admin.alliances.destroy', $alliance->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
