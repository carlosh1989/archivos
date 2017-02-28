
@extends('layouts.admin')
@section('content')
<style>
  .btn-block{
  	width:100%;
  }
</style>
<div class="container"><br/>
  <div class="card-panel">
    <h4 class="blue-text animated pulse infinite center">FORM</h4><br/>
    <form action="{{url('/admin/cuentas/form')}}" method="post">{{csrf_field()}}
      <input type="text" name="name" value="{{old('name')}}" placeholder="Ingrese Nombre"/>@if ($errors->has('name'))
      <div class="card-panel red white-text animated bounceIn">{{ $errors->first('name') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
      <div class="row">
        <div class="col s12 push-s10">
          <button type="submit" name="action" class="btn btn-large blue waves-effect waves-light"> <i aria-hidden="true" class="fa fa-save"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>@endsection