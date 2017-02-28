
@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="card-panel">
    <h4 class="blue-text">Ingreso de Archivo</h4>
    <div class="divider">
      <form id="formuploadajax" action="{{url('/admin/archivos')}}" enctype="multipart/form-data" method="post">{{csrf_field()}}
        <input type="text" name="archivo"/>
        <input type="submit" value="guardar"/>
      </form>
    </div>
  </div>
</div>@endsection