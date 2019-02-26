@extends('layouts.admin')

@section('content')
<div class="container">

  @include('partials.admin.search')
  <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addNew"><i class="fas fa-plus"></i> Nueva</button>
  <h1>Páginas</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Timestamps</th>
    </tr>
    @foreach($pages as $page)
    <tr>
      <td class="text-center">
        {{ $page->id }}<br>
        {!! $page->active ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' !!}
      </td>
      <td>
        <strong><a href="{{ route('admin.pages.edit', $page->id) }}">{{ $page->name }}</a></strong><br>
        <small>
          <a href="{{ route('page', $page->slug) }}" target="_blank">{{ route('page', $page->slug) }}</a><br>
          <i class="far fa-user"></i> {{ $page->user->name }}
        </small>

      </td>
      <td>
        @if($page->picture)
          <a data-fancybox href="/uploads/{{ $page->picture }}" class="btn btn-sm btn-light mr-2">
            <i class="far fa-image"></i> /uploads/{{ $page->picture }}
          </a>
        @endif
      </td>
      <td>
        <small>
          {{ $page->created_at->toDayDateTimeString() }}<br>
          {{ $page->updated_at->toDayDateTimeString() }}
          @if($page->trashed())
            <br>
            <span class="text-danger">
              <i class="far fa-trash-alt"></i>
              {{ $page->deleted_at->toDayDateTimeString() }}
            </span>
          @endif
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $pages->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.pages.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Agregar nueva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nombre de la página</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de la página" value="{{ old('name') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
