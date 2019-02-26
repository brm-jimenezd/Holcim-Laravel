@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Usuarios: {{ $user->name }}</h1>
  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label for="name">Nombre del usuario</label>
      <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $user->name }}" required>
    </div>
    

    <div class="form-group">
      <label for="name">Contraseña</label>
      <input type="text" name="password" id="password" class="form-control form-control-lg" value="{{ old('password') ? old('password') : $user->password }}" required>
    </div>


    <div class="form-group">
      <label for="name">Email</label>
      <input type="text" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') ? old('email') : $user->email }}" required>
    </div>

    <div class="form-group">
      <label for="name">Rol</label>
      <input type="text" name="role" id="role" class="form-control form-control-lg" value="{{ old('role') ? old('role') : $user->role }}" required>
    </div>
    
  
    
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ $user->active ? 'checked' : '' }}>
      <label class="form-check-label" for="active">
        Activo
      </label>
    </div>
    <div class="form-group">
      <a class="btn btn-danger btn-sm float-right" href="#" onclick="user.pruserDefault(); document.getElementById('destroy-form').submit();">
          <i class="far fa-trash-alt"></i> Borrar
      </a>
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
    </div>
  </form>
</div>

<form id="destroy-form" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
