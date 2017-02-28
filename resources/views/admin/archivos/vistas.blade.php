
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row">
      <div class="col l12 s12">
        <h5 class="teal-text center animated pulse">
<i class="fa fa-file-text fa-2x" aria-hidden="true"></i>
        Publicaciones</h5>
        <div class="pull-right">
        <a class="teal-text" href="{{url('/admin/reporte/'.$file->file_id)}}">
          <i class="fa fa-print fa-3x" aria-hidden="true"></i>
        </a>
          
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="row"> 
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3 teal-text"><a href="#vistos" class="green-text">Vistos: {{$publicacionesVistas->count()}} <i aria-hidden="true" class="fa fa-check"></i></a></li>
          <li class="tab col s3"><a href="#novistos" class="active red-text">No vistos: {{$publicacionesNoVistas->count()}} <i aria-hidden="true" class="fa fa-times"></i></a></li>
        </ul>
      </div>
      <div id="vistos" class="col s12">
        <table>
          <thead>
            <tr class="grey-text">
              <th data-field="Avatar">Avatar</th>
              <th data-field="Nombre">Nombre</th>
              <th data-field="Rol">Rol</th>
              <th data-field="Comisión">Comisión</th>
              <th data-field="Visto">Visto</th>
            </tr>
          </thead>
          <tbody>@foreach($publicacionesVistas as $post)
            <tr>@var('avatar',$post->councilor->avatar)
              <td><img width="70" src="{{asset('storage/'.$avatar)}}" class="materialboxed"/></td>
              <td>{{$post->councilor->name}}</td>
              <td>{{$post->councilor->user->role}}</td>
              <td>{{$post->councilor->comision}}</td>@var('date',new Date($post->update_at))
              <td>{{$date->format('j-m-Y')}} a las {{$date->format('H:i:s')}}</td>
            </tr>@endforeach
          </tbody>
        </table>
      </div>
      <div id="novistos" class="col s12">
        <table>
          <thead>
            <tr class="grey-text">
              <th data-field="Avatar">Avatar</th>
              <th data-field="Nombre">Nombre</th>
              <th data-field="Rol">Rol</th>
              <th data-field="Comisión">Comisión</th>
            </tr>
          </thead>
          <tbody>@foreach($publicacionesNoVistas as $post)
            <tr>@var('avatar',$post->councilor->avatar)
              <td><img width="70" src="{{asset('storage/'.$avatar)}}" class="materialboxed"/></td>
              <td>{{$post->councilor->name}}</td>
              <td>{{$post->councilor->user->role}}</td>
              <td>{{$post->councilor->comision}}</td>
            </tr>@endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  (function($){
  $(function(){
  
  window.onload = function() {
  document.getElementById('searchGo').onclick = function() {
  document.getElementById('searchForm').submit();
  return false;
  };
  };
  $('.modal-trigger').leanModal();
  $('#searchConcejal').focus(function(){
  $(this).val('');
  });
  
  $(document).ready(function(){
  $('ul.tabs').tabs('select_tab', 'tab_id');
  });
         
  $('#borrarSearch').click(function(){
  $('#searchConcejal').val('');
  });
  
  }); // end of document ready
  })(jQuery); // end of jQuery name space
  
  
  
</script>@endsection