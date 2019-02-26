@extends('layouts.admin')

@section('content')
<div class="container">
  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Eventos</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Fecha</th>
      <th>Timestamps</th>
    </tr>
    @foreach($events as $event)
    <tr>
      <td class="text-center">
        {{ $event->id }}<br>
        {!! $event->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        <strong><a href="{{ route('admin.events.edit', $event->id) }}">{{ $event->name }}</a></strong><br>
        <small>
          <a href="{{ route('page', $event->slug) }}" target="_blank">{{ route('page', $event->slug) }}</a><br>
          <i class="far fa-user"></i> {{ $event->user->name }}
        </small>

      </td>
      <td>
        @if($event->picture)
          <a data-fancybox href="/uploads/{{ $event->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> /uploads/{{ $event->picture }}
          </a>
        @endif
      </td>
      <td>
        {{ $event->event_start->toDayDateTimeString() }}<br>
        {{ $event->event_end->toDayDateTimeString() }}<br>
        <small>Duración: {{ $event->event_start->diffAsCarbonInterval($event->event_end) }}</small>
      </td>
      <td>
        <small>
          {{ $event->created_at->toDayDateTimeString() }}<br>
          {{ $event->updated_at->toDayDateTimeString() }}
          @if($event->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $event->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $events->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.events.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre del evento</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del evento" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
          <label for="event_start">Fecha y hora de finalización</label>
          <datetime-picker name="event_start" value="{{ old('event_start') }}"></datetime-picker>
        </div>
        <div class="form-group">
          <label for="event_start">Fecha y hora de finalización</label>
          <datetime-picker name="event_end" value="{{ old('event_end') }}"></datetime-picker>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
