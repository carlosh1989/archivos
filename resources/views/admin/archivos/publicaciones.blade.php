
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row">
      <div class="col l12 s12">
        <h5 class="teal-text center animated pulse">
<i class="fa fa-file-text fa-2x" aria-hidden="true"></i>
        Publicaciones </h5>
      </div>
    </div>
    <div class="divider"></div>
    <div class="row">
      <div class="col s12">
        <table class="responsive-table highlight">
          <thead>
            <tr class="grey-text">
              <th data-field="Tipo">Tipo</th>
              <th data-field="Nombre">Nombre</th>
              <th data-field="Clasificación">Clasificación</th>
              <th data-field="Fecha">Fecha</th>
              <th data-field="Opciones">Visto</th>
            </tr>
          </thead>
          <tbody>
            @foreach($publicaciones as $re)
            @var('councilor_id',$re->user->id)
            <input type="hidden" value="{{$councilor_id}}" name="councilor_id"/>
            <tr>
              <td>
                <ul>
                  <li>
                    @var('tipo','word')
                    @if($tipo == 'word')<i aria-hidden="true" class="fa fa-file-word-o fa-3x blue-text"></i>@endif
                    @if($tipo == 'excel')<i aria-hidden="true" class="fa fa-file-excel-o fa-3x green-text"></i>@endif
                    @if($tipo == 'pdf')<i aria-hidden="true" class="fa fa-file-pdf-o fa-3x red-text"></i>@endif
                    @if($tipo == 'point')<i aria-hidden="true" class="fa fa-file-powerpoint-o fa-3x orange-text"></i>@endif
                    @if($tipo == 'imagen')<i aria-hidden="true" class="fa fa-file-image-o fa-3x purple-text"></i>@endif
                  </li>
                </ul>
              </td>
              <td>{{ucwords(strtolower($re->file->name))}}</td>
              <td>{{$re->clasificacion}}</td>@var('date',new Date($re->created_at))
              <td>{{$date->format('d-m-Y')}}</td>
              <td>@var('PublicID', url('/admin/publicaciones/'.$re->id))<a href="{{$PublicID}}"><i class="fa fa-eye fa-3x teal-text"></i></a></td>
            </tr>@endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>{{ $publicaciones->links() }}
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
  
  $('#borrarSearch').click(function(){
  $('#searchConcejal').val('');
  });
  
  $('input.autocomplete').autocomplete({
  data: {
  @foreach($publicaciones as $re)
  "{{$re->comision}}" : null,
  "{{$re->name}} {{$re->comision}}": "{{asset('storage/'.$re->avatar)}}",
  @endforeach
  }
  });
  }); // end of document ready
  })(jQuery); // end of jQuery name space
  
  
  
</script>@endsection