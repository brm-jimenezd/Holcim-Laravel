@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Logs</h1>
  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Usuario</th>
      <th>Accion</th>
      <th>Detalles</th>
      <th>Timestamps</th>
    </tr>
    @foreach($logs as $log)
    <tr>
      <td>{{ $log->id }}</td>
      <td>{!! $log->user ? $log->user->name.'<br>'.$log->user->email : 'No existe' !!}</td>
      <td>
        {{ $log->action }}<br>
        <small>{{ $log->location }}</small>
      </td>
      <td>{{ $log->userdata }}</td>
      <td>
        <small>
          {{ $log->created_at->toDayDateTimeString() }}<br>
          {{ $log->updated_at->toDayDateTimeString() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $logs->links() }}
</div>

@endsection
