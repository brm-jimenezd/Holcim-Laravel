@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Eventos: {{ $event->name }}</h1>
  <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label for="name">Nombre del evento</label>
      <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $event->name }}" required>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">{{ url('/') }}</span>
        </div>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="slug" value="{{ old('slug') ? old('slug') : $event->slug }}" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="event_start">Fecha y hora de inicio</label>
          <datetime-picker name="event_start" value="{{ old('event_start') ? old('event_start') : $event->event_start->format('Y-m-d\TH:i') }}"></datetime-picker>
        </div>
        <div class="form-group">
          <label for="event_start">Fecha y hora de finalización</label>
          <datetime-picker name="event_end" value="{{ old('event_end') ? old('event_end') : $event->event_end->format('Y-m-d\TH:i') }}"></datetime-picker>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Descripción</label>
          <textarea name="description" id="description" class="form-control">{{ old('description') ? old('description') : $event->description }}</textarea>
        </div>
        <div class="form-group">
          <label for="picture">Imagen (600x400px)</label>
          <input type="file" class="form-control" name="picture" id="picture">
          @if($event->picture)
            <a data-fancybox href="/uploads/{{ $event->picture }}" class="btn btn-sm btn-light mr-2">
              <i class="far fa-image"></i> /uploads/{{ $event->picture }}
            </a>
          @endif
        </div>
      </div>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ $event->active ? 'checked' : '' }}>
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

<form id="destroy-form" action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
