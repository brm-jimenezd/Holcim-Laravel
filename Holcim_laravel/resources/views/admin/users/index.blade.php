@extends('layouts.admin')

@section('content')
<div class="container">

  <h1>Usuarios</h1>
  <table class="table table-striped">
    <tr>
      <th width="30">id</th>
      <th>Usuario</th>
      <th>rol</th>
      <th>email</th>
      <th>estado</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>
        <strong><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></strong><br>
        <small>
          <i class="far fa-user"></i> {{ $user->name }}
        </small>
      </td>

      <td>{{ $user->role }}</td>
      <td>{{ $user->email }}</td>

        <td>
            @if($user->active == 1)
                activo
            
            @else
                inactivo
            
            @endif
        </td>    
 
   
    </tr>
    @endforeach
  </table>
  {{ $users->links() }}
</div>

@endsection
