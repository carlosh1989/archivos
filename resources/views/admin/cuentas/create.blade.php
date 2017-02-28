
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <h5 class="teal-text center">
<i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
    Cuentas</h5>
    <div class="divider"></div><br/>
    <form action="{{url('admin/cuentas')}}" enctype="multipart/form-data" method="post">{{csrf_field()}}
      <div class="file-field input-field">
        <div class="btn"><span>Buscar 
        <i class="fa fa-search fa-2x" aria-hidden="true"></i></span>
          <input type="file" name="archivo" required="required"/>
        </div>
        <div class="file-path-wrapper">
          <input type="text" name="archivo" placeholder="Avatar" required="required" class="file-path validate"/>
        </div>
        <div class="file-path-wrapper"></div>
      </div>@if ($errors->has('archivo'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('archivo') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="text" name="name" placeholder="Ingrese nombre" value="{{ old('name') }}" required="required"/>@if ($errors->has('name'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('name') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="text" name="email" placeholder="Ingrese email" value="{{ old('email') }}"/>@if ($errors->has('email'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('email') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="password" name="password" placeholder="Ingrese clave" value="{{ old('password') }}" required="required"/>@if ($errors->has('password'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('password') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <select name="role" required="required">@if(old('role'))
        <option value="{{old('role')}}">{{old('role')}} </option>
        <option value="concejal">Concejal</option>
        <option value="asistente">Asistente</option>
        <option value="admin">Admin</option>{{old('role')}}
        @else
        <option value="" disabled="disabled" selected="selected">Ingrese Role </option>
        <option value="concejal">Concejal</option>
        <option value="asistente">Asistente</option>
        <option value="admin">Admin</option>@endif
      </select>@if ($errors->has('role'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('role') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="number" name="cedula" placeholder="Cedula" value="{{ old('cedula') }}" required="required"/>@if ($errors->has('cedula'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('cedula') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="number" name="telefono" placeholder="Celular" value="{{ old('telefono') }}" required="required"/>@if ($errors->has('telefono'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('telefono') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <select name="comision" required="required">@if(old('comision'))
        <option value="{{old('comision')}}">{{old('comision')}}</option>
        <option value="transporte">Transporte</option>
        <option value="salud">Salud</option>
        <option value="educacion">Educación</option>
        <option value="finanza">Finanza</option>
        <option value="urbanismo">Urbanismo</option>
        <option value="legislacion">Legislación</option>
        <option value="contraloria">Contraloria</option>
        <option value="egidos">Egidos</option>
        <option value="ambiente">Ambiente</option>
        <option value="pciudadana">Participación Ciudadana</option>@else
        <option value="" disabled="disabled" selected="selected">Ingrese Comisión</option>
        <option value="transporte">Transporte</option>
        <option value="salud">Salud</option>
        <option value="educacion">Educación</option>
        <option value="finanza">Finanza</option>
        <option value="urbanismo">Urbanismo</option>
        <option value="legislacion">Legislación</option>
        <option value="contraloria">Contraloria</option>
        <option value="egidos">Egidos</option>
        <option value="ambiente">Ambiente</option>
        <option value="pciudadana">Participación Ciudadana</option>@endif
      </select>@if ($errors->has('comision'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('comision') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <div class="input-field col s12">
        <textarea id="textarea1" name="direccion" cols="30" rows="10" required="required" class="materialize-textarea">{{ old('direccion') }}</textarea>
        <label for="textarea1">Descripción</label>
      </div>@if ($errors->has('direccion'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('direccion') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <select name="parroquia" required="required">@if(old('parroquia'))
        <option value="{{ old('parroquia') }}">{{ old('parroquia') }} </option>
        <option value="ramon ignacion mendez">Ramon ignacio Mendez</option>
        <option value="conrazon de jesus">Corazon de Jesus</option>@else
        <option value="" disabled="disabled" selected="selected">Ingrese parroquia</option>
        <option value="ramon ignacion mendez">Ramon ignacio Mendez</option>
        <option value="conrazon de jesus">Corazon de Jesus</option>@endif
      </select>@if ($errors->has('parroquia'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('parroquia') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <input type="date" name="nacimiento" placeholder="Fecha de nacimiento" value="{{ old('nacimiento') }}" required="required" class="datepicker"/>@if ($errors->has('nacimiento'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('nacimiento') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <button type="submit" name="action" class="btn waves-effect waves-light">Guardar <i aria-hidden="true" class="fa fa-wpforms"></i></button>
    </form>
  </div>
</div>@endsection