@extends('layouts.admin')

@section('content')
<div class="container">
  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Casos</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Timestamps</th>
    </tr>
    @foreach($works as $work)
    <tr>
      <td class="text-center">
        {{ $work->id }}<br>
        {!! $work->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        <strong><a href="{{ route('admin.works.edit', $work->id) }}">{{ $work->name }}</a></strong><br>
        <small>
          <i class="far fa-user"></i> {{ $work->user->name }}
        </small>

      </td>
      <td>
        @if($work->background)
          <a data-fancybox href="/uploads/{{ $work->background }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> {{ $work->background }}
          </a>
        @endif
        @if($work->picture)
          <a data-fancybox href="/uploads/{{ $work->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> {{ $work->picture }}
          </a>
        @endif
        @if($work->logo)
          <a data-fancybox href="/uploads/{{ $work->logo }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> {{ $work->logo }}
          </a>
        @endif
      </td>
      <td>
        <small>
          {{ $work->created_at->toDayDateTimeString() }}<br>
          {{ $work->updated_at->toDayDateTimeString() }}
          @if($work->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $work->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $works->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.works.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre del caso</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del caso" value="{{ old('name') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
