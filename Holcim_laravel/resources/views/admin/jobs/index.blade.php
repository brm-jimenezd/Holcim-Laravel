@extends('layouts.admin')

@section('content')
<div class="container">
  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Trabajos</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Candidatos</th>
      <th>Timestamps</th>
    </tr>
    @foreach($jobs as $job)
    <tr>
      <td class="text-center">
        {{ $job->id }}<br>
        {!! $job->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        @if($job->icon)
          <img src="/uploads/{{ $job->icon }}" class="float-left mr-2">
        @endif
        <strong><a href="{{ route('admin.jobs.edit', $job->id) }}">{{ $job->name }}</a></strong><br>
        <small>
          <i class="far fa-user"></i> {{ $job->user->name }}
        </small>

      </td>
      <td>
        {{ $job->candidates->count() }}
      </td>
      <td>
        <small>
          {{ $job->created_at->toDayDateTimeString() }}<br>
          {{ $job->updated_at->toDayDateTimeString() }}
          @if($job->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $job->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $jobs->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.jobs.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre de la oferta</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de la oferta" value="{{ old('name') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
