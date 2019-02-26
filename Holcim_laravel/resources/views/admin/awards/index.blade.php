@extends('layouts.admin')

@section('content')
<div class="container">
  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Reconocimientos</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Timestamps</th>
    </tr>
    @foreach($awards as $award)
    <tr>
      <td class="text-center">
        {{ $award->id }}<br>
        {!! $award->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        <strong><a href="{{ route('admin.awards.edit', $award->id) }}">{{ $award->name }}</a></strong><br>
        <small>
          <i class="far fa-user"></i> {{ $award->user->name }}
        </small>

      </td>
      <td>
        @if($award->picture)
          <a data-fancybox href="/uploads/{{ $award->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> {{ $award->picture }}
          </a>
        @endif
        @if($award->logo)
          <a data-fancybox href="/uploads/{{ $award->logo }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> {{ $award->logo }}
          </a>
        @endif
      </td>
      <td>
        <small>
          {{ $award->created_at->toDayDateTimeString() }}<br>
          {{ $award->updated_at->toDayDateTimeString() }}
          @if($award->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $award->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $awards->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.awards.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre del reconocimiento</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del reconocimiento" value="{{ old('name') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
