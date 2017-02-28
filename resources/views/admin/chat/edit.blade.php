
@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="card-panel">
    <h5 class="teal-text center">
<i class="fa fa-commenting fa-2x" aria-hidden="true"></i>
    Activar Chat</h5>
    <div class="divider"></div>
    <label class="grey-text">Ingrese ID de Tawk.to creado al concejal.</label>@var('siteID',$room->siteID)
    @var('id',$room->id)
    <form action="{{url('admin/chat/'.$id)}}" method="POST">{{csrf_field()}}
      <input type="hidden" name="_method" value="PUT"/>
      <input type="text" name="siteID" placeholder="Ingrese ID" value="{{ old('email',$siteID) }}"/><br/>
      <button type="submit" class="btn blue">Enlazar <i aria-hidden="true" class="fa fa-link"> </i></button>
    </form>
  </div>
</div>@endsection