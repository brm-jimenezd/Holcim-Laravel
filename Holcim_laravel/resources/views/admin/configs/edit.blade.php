@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Páginas: {{ $config->name }}</h1>
  <form action="{{ route('admin.configs.update', $config->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf

    <div class="form-group">
        <label for="content">Content</label>
        <editor name="content" value="{{ old('content') ? old('content') : $config->content }}"></editor>
      </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
    </div>
  </form>
</div>

@endsection
