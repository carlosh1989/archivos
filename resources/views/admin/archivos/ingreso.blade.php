@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <h5 class="teal-text center animated pulse">
       <i class="fa fa-folder-open-o fa-2x teal-text" aria-hidden="true"></i>
    Ingresar Archivo</h5>
    <div class="divider"></div><br/>
    <form action="{{url('/admin/archivos')}}" enctype="multipart/form-data" method="post">{{csrf_field()}}
      <div class="file-field input-field">
        <div class="btn"><span>Buscar <i class="fa fa-search white-text" aria-hidden="true"></i></span>
          <input type="file" name="archivo"/>
        </div>
        <div class="file-path-wrapper">
          <input type="text" name="archivo" placeholder="Avatar" class="file-path validate"/>
        </div>
      </div>@if ($errors->has('archivo'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('archivo') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" name="name" value="{{old('name')}}" class="validate"/>
          <label for="name">Nombre</label>
        </div>
      </div>@if ($errors->has('name'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('name') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <div class="input-field col s12">
        <textarea id="textarea1" name="description" cols="30" rows="10" required="required" class="materialize-textarea validate">{{ old('description') }}</textarea>
        <label for="textarea1">Descripción</label>
      </div>@if ($errors->has('description'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('description') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <select name="type" class="validate">@if(old('type'))
        <option value="{{old('type')}}">{{old('type')}}</option>
        <option value="word">Word</option>
        <option value="excel">Excel</option>
        <option value="point">Power Point</option>
        <option value="pdf">PDF</option>
        <option value="imagen">Imagen</option>@else
        <option value="" disabled="disabled" selected="selected">Ingrese tipo de archivo</option>
        <option value="word">Word</option>
        <option value="excel">Excel</option>
        <option value="point">Power Point</option>
        <option value="pdf">PDF</option>
        <option value="imagen">Imagen</option>@endif
      </select>@if ($errors->has('type'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('type') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <button type="submit" class="btn btn-large">Guardar</button>
    </form>
  </div>
</div>@endsection