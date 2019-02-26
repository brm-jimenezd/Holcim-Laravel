@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Páginas: {{ $page->name }}</h1>
  <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label for="name">Nombre del contenido</label>
      <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $page->name }}" required>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">{{ url('/') }}</span>
        </div>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="slug" value="{{ old('slug') ? old('slug') : $page->slug }}" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Descripción</label>
          <textarea name="description" id="description" class="form-control">{{ old('description') ? old('description') : $page->description }}</textarea>
        </div>
      </div>
      <div class="col-md-6">
        <label for="picture">Imagen</label>
        <input type="file" class="form-control" name="picture" id="picture">
        @if($page->picture)
          <a data-fancybox href="/uploads/{{ $page->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> /uploads/{{ $page->picture }}
          </a>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <editor name="content" value="{{ old('content') ? old('content') : $page->content }}"></editor>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ $page->active ? 'checked' : '' }}>
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

<form id="destroy-form" action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
