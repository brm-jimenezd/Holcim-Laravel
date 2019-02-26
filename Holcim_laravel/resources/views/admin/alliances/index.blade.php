@extends('layouts.admin')

@section('content')
<div class="container">
  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Alianzas</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Timestamps</th>
    </tr>
    @foreach($alliances as $alliance)
    <tr>
      <td class="text-center">
        {{ $alliance->id }}<br>
        {!! $alliance->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        <strong><a href="{{ route('admin.alliances.edit', $alliance->id) }}">{{ $alliance->name }}</a></strong><br>
        <small>
          <i class="far fa-user"></i> {{ $alliance->user->name }}
        </small>

      </td>
      <td>
        @if($alliance->picture)
          <a data-fancybox href="/uploads/{{ $alliance->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> /uploads/{{ $alliance->picture }}
          </a>
        @endif
      </td>
      <td>
        <small>
          {{ $alliance->created_at->toDayDateTimeString() }}<br>
          {{ $alliance->updated_at->toDayDateTimeString() }}
          @if($alliance->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $alliance->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $alliances->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.alliances.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre de la alianza</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de la alianza" value="{{ old('name') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
