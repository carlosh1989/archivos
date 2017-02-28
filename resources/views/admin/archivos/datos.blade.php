
@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="card-panel">
    <h4 class="teal-text">Datos de usuario</h4>
    <div class="divider"></div><br/>@foreach ($usuarios as $user)
    {{ $user->id }}
    @endforeach
  </div>
</div>@endsection