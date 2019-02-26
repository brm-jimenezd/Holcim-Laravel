@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Trabajos: {{ $job->name }}</h1>
  <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label for="name">Nombre de la oferta</label>
      <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $job->name }}" required>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ url('/empleos/') }}</span>
        </div>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="slug" value="{{ old('slug') ? old('slug') : $job->slug }}" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Descripción</label>
          <textarea rows="10" name="description" id="description" class="form-control">{{ old('description') ? old('description') : $job->description }}</textarea>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="location">Ubicación</label>
          <input type="text" name="location" id="location" class="form-control" value="{{ old('location') ? old('location') : $job->location }}">
        </div>
        <div class="form-group">
          <label for="area">Área</label>
          <input type="text" name="area" id="area" class="form-control" value="{{ old('area') ? old('area') : $job->area }}">
        </div>
        <div class="form-group">
          <label for="vacancies">Vacantes</label>
          <input type="number" min="1" max="100" name="vacancies" id="vacancies" class="form-control" value="{{ old('vacancies') ? old('vacancies') : $job->vacancies }}">
        </div>

        <div class="form-group">
          <label for="icon">Icono (64x64px)</label>
          <input type="file" class="form-control" name="icon" id="icon">
          @if($job->icon)
            <a data-fancybox href="/uploads/{{ $job->icon }}" class="btn btn-sm btn-light mr-2">
              <i class="far fa-image"></i> /uploads/{{ $job->icon }}
            </a>
          @endif
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <editor name="content" value="{{ old('content') ? old('content') : $job->content }}"></editor>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ $job->active ? 'checked' : '' }}>
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

<form id="destroy-form" action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
