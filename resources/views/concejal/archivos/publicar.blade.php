
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row">
      <div class="col s6">
        <h5 class="blue-text center animated pulse">Archivos</h5>
      </div>
      <div class="col s6">
        <nav>
          <div class="nav-wrapper white">
            <form action="{{url('/admin/busquedaProcesar')}}" method="post">{{csrf_field()}}
              <div class="input-field">
                <input type="search" name="search" id="searchArchivo" required="required"/>
                <label for="searchArchivo"><i class="material-icons blue-text">search</i></label><i class="material-icons">close</i>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
    <div class="divider"></div><br/>
    <table>
      <thead>
        <tr class="grey-text">
          <th data-field="nombre">Nombre</th>
          <th data-field="descripción">Visible</th>
          <th data-field="tipo">Tipo </th>
          <th data-field="Opciones">Opciones</th>
        </tr>
      </thead>
      <tbody>@foreach($resultados as $re)
        <tr>
          <td>{{$re->name}}</td>
          <td>Visible</td>
          <td>{{$re->type}}</td>
          <td>@var("id",$re->id)<a href="#" data-activates="fileoptions{{$id}}" class="dropdown-button btn"><i class="fa fa-cog"></i></a>
            <ul id="fileoptions{{$id}}" class="dropdown-content">
              <li><a href="{{url('/admin/publicar/'.$id)}}">Publicar</a></li>
              <li><a href="#">Editar</a></li>
              <div class="divider"></div>
              <li class="red"><a href="#" class="white-text">Eliminar</a></li>
            </ul>
          </td>
        </tr>@endforeach
      </tbody>
    </table>
  </div>{{ $resultados->links() }}
</div>@endsection