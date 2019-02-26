@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Páginas</h1>

  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Nombre</th>
      <th>Contenido</th>
      <th>Timestamps</th>
    </tr>
    @foreach($configs as $config)
    <tr>
      <td>{{ $config->id }}</td>
      <td>
        <strong><a href="{{ route('admin.configs.edit', $config->id) }}">{{ $config->name }}</a></strong><br>
        <small>
          {{ $config->position }}
        </small>

      </td>
      <td>
        {{ $config->content }}
      </td>
      <td>
        <small>
          {{ $config->created_at->toDayDateTimeString() }}<br>
          {{ $config->updated_at->toDayDateTimeString() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
</div>

@endsection
