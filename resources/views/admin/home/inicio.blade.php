
@extends('layouts.admin')
@section('content')
<br>
<div class="container">
  <div class="card-panel">
     <div style="text-align:center;" > <img height="250" class="logo" src="{{asset('img/logo.png')}}" alt="descripción de imagen" /></div> 
    <div class="divider"></div>
    <p>
      Sistema web para gestión de pocesos administrativos, es una herramienta para la publicación de archivos para la secretaria de camara de municipio barinas.
    </p>
    <div class="divider"></div>
    <pre>De  click abajp para descargar manuales y los video tutoriales:</pre>
    <a class="btn" href=""><i class="fa fa-book" aria-hidden="true"></i> Manual</a>
    <a class="btn" href=""><i class="fa fa-file-video-o" aria-hidden="true"></i> Video Tutorial</a>
  </div>
  
</div>
@endsection