
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
      <div class="row animated bounceInDown">
      <div class="col s1">
       <i class="fa fa-folder-open-o fa-4x teal-text" aria-hidden="true"></i>
      </div>
      <div class="col s5">
        <h5 class="teal-text">Archivos</h5>
      </div>
      <div class="col s6">
        <nav>
          <div class="nav-wrapper white">
            <form action="{{url('/admin/busquedaProcesar')}}" method="post">{{csrf_field()}}
              <div class="input-field">
                <input type="search" name="search" id="searchArchivo" required="required"/>
                <label for="searchArchivo"><i class="material-icons teal-text">search</i></label><i class="material-icons">close</i>
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
          <th data-field="tipo">Tipo </th>
          <th data-field="Opciones">Opciones</th>
        </tr>
      </thead>
      <tbody>@foreach($resultados as $re)
        <tr>
          <td>{{$re->name}}</td>
          <td width="45%">
        @var('tipo',$re->type)
        @if($tipo == 'word')<i aria-hidden="true" class="fa fa-file-word-o fa-3x blue-text"></i>@endif
        @if($tipo == 'excel')<i aria-hidden="true" class="fa fa-file-excel-o fa-3x green-text"></i>@endif
        @if($tipo == 'pdf')<i aria-hidden="true" class="fa fa-file-pdf-o fa-3x red-text"></i>@endif
        @if($tipo == 'point')<i aria-hidden="true" class="fa fa-file-powerpoint-o fa-3x orange-text"></i>@endif
        @if($tipo == 'imagen')<i aria-hidden="true" class="fa fa-file-image-o fa-3x purple-text"></i>@endif
          </td>
           <script type='text/javascript'>
     function submit()
      {
         document.forms["eliminarArchivo"].submit();
      }
   </script>
          <td>@var("id",$re->id)<a href="#" data-activates="fileoptions{{$id}}" class="dropdown-button btn"><i class="fa fa-cog"></i></a>
            <ul id="fileoptions{{$id}}" class="dropdown-content">
              <li><a href="{{url('/admin/publicar/'.$id)}}">Publicar</a></li>
              <div class="divider"></div>
              <li class="red">
              <form id="eliminarArchivo" name="eliminarArchivo" action="{{url('/admin/eliminarArchivo/'.$id)}}" method="POST">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              </form>
              <a href="javascript: submit();" href="{{url('/admin/eliminarArchivo/'.$id)}}" class="white-text">Eliminar</a></li>
            </ul>
          </td>
        </tr>@endforeach
      </tbody>
    </table>
  </div>{{ $resultados->links() }}
</div>@endsection