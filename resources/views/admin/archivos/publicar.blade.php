
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row">

      <div class="col s1">
       <i class="fa fa-folder-open-o fa-4x teal-text" aria-hidden="true"></i>
      </div>
      <div class="col s5">
        <h5 class="teal-text">{{ucfirst($archivo->name)}}</h5>
      </div>    
  

    {{-- asdsa --}}
      <div class="col l6 s6">
        <nav style="z-index:888;">
          <div class="nav-wrapper white">
            <form id="searchForm" action="{{url('/admin/busquedaProcesarPublicar')}}" method="post">{{csrf_field()}}
              <div class="input-field">@var('idArchivo',$archivo->id)
                <input type="hidden" value="{{$idArchivo}}" name="idArchivo"/>
                <input type="search" name="search" id="searchConcejal" autocomplete="off" required="required" class="autocomplete grey-text"/>
                <label for="searchConcejal">
                  @if($search == "si")
                  @var('urlAtras',url('/admin/publicar/'.$idArchivo))<a href="{{$urlAtras}}" class="teal-text"><i class="fa fa-chevron-left fa-2x teal-text"></i></a>@else
                  @var('submitEnter','this.form.submit()')<a id="searchGo" href="#" onClick="{{$submitEnter}}" class="teal-text"><i class="fa fa-search fa-2x teal-text"></i></a>@endif
                </label><i id="borrarSearch" class="material-icons">close</i>
              </div>
            </form>
          </div>
        </nav>
      </div>
    <div class="divider"></div>
    <div class="row">
      <div class="col s12">
        <table class="responsive-table highlight">
          <thead>
            <tr class="grey-text">
              <th data-field="Avatar"></th>
              <th data-field="Nombre">Nombre</th>
              <th data-field="Role">Role</th>
              <th data-field="Cargo">Comisión</th>
              <th data-field="Telefono">Telefono</th>
              <th data-field="Cedula">Cedula</th>
            </tr>
          </thead>
          <tbody>
            <tr></tr>
            <form action="{{url('/admin/publicar')}}" method="post">{{csrf_field()}}
              <select name="elejir_comida" onchange="mostrarValor(this.options[this.selectedIndex].innerHTML); mostrarValor2(this.value);">
                <option value="ordenanza">Ordenanza</option>
                <option value="memorandum">Memorandum</option>
                <option value="oficio">Oficio</option>
                <option value="acuerdo">Acuerdo</option>
              </select>
              <input type="hidden" name="clasificacion" id="comida"/>
              <script type="text/javascript">
                var mostrarValor = function(x){
                document.getElementById('comida').value=x;
                }
                
                var mostrarValor2 = function(x){
                document.getElementById('comida2').value=x;
                }
              </script>@if ($errors->has('clasificacion'))
              <div class="card-panel red white-text animated bounceIn">{{ $errors->first('clasificacion') }}<i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i></div>@endif
              @var('idArchivo',$archivo->id)
              <input type="hidden" name="file_id" value="{{$idArchivo}}"/>
              @foreach($usuarios as $re)
              @var('councilor_id',$re->user->id)
              <input type="hidden" value="{{$councilor_id}}" name="councilor_id"/>
              <tr>
                <td class="center-align">
                  <ul>
                    <li>
                      @var('avatar',$re->avatar)
                      @var("userId",$re->id)
                      <input type="checkbox" name="concejales[]" value="{{$userId}}" id="check{{$userId}}" class="filled-in"/>
                      <label for="check{{$userId}}"><img width="70" src="{{asset('storage/'.$avatar)}}" alt=""/></label>
                    </li>
                  </ul>
                </td>
                <td>{{ucwords(strtolower($re->name))}}</td>
                <td>{{$re->user->role}}</td>
                <td>{{$re->comision}}</td>
                <td>{{$re->telefono}}</td>
                <td>{{$re->cedula}}</td>
              </tr>
              @endforeach
              <div style="bottom: 120px; right: 24px;" class="fixed-action-btn"><a id="selectComi" href="#modalSelectComi" data-position="top" data-delay="50" data-tooltip="Seleccionar comisión" class="btn-floating btn-large red tooltipped modal-trigger"><i class="large material-icons">mode_edit</i></a></div>
              <div id="modalSelectComi" class="modal bottom-sheet">
                <div class="modal-content">
                  <h5 class="teal-text center">Seleccionar Comisiones</h5>
                  <div class="divider"></div><br/>
                  <div class="row">
                    <div class="col l10 s12">
                      <div class="col l2 s12">
                        <input type="checkbox" name="comision[]" value="transporte" id="checkTransporte" class="filled-in"/>
                        <label for="checkTransporte">Transporte</label>
                      </div>
                      <div class="col l2 s12">
                        <input type="checkbox" name="comision[]" value="salud" id="checkSalud" class="filled-in"/>
                        <label for="checkSalud">Salud</label>
                      </div>
                      <div class="col l2 s12">
                        <input type="checkbox" name="comision[]" value="finanza" id="checkFinanza" class="filled-in"/>
                        <label for="checkFinanza">Finanza</label>
                      </div>
                      <div class="col l2 s12">
                        <input type="checkbox" name="comision[]" value="legislacion" id="checkLegislacion" class="filled-in"/>
                        <label for="checkLegislacion">Legislación</label>
                      </div>
                    </div>
                    <div class="col l2 s12">
                      <button type="submit" href="#" class="btn btn-large teal waves-effect waves-light">Publicar <i class="fa fa-send fa-2x"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div data-position="left" data-delay="50" data-tooltip="Publicar Archivo" style="bottom: 45px; right: 24px;" class="fixed-action-btn tooltipped">
                <button type="submit" href="#" class="btn-floating btn-large teal"><i class="large material-icons">send</i></button>
              </div>
            </form>
          </tbody>
        </table>
      </div>
    </div>
  </div>{{ $usuarios->links() }}
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
  var mostrarValor = function(x){
  document.getElementById('comida').value=x;
  }
  
  var mostrarValor2 = function(x){
  document.getElementById('comida2').value=x;
  }
  
  $('input.autocomplete').autocomplete({
  data: {
  @foreach($todos as $re)
  "{{$re->comision}}" : null,
  "{{$re->name}} {{$re->comision}}": "{{asset('storage/'.$re->avatar)}}",
  @endforeach
  }
  });
  
  
  $('input.autocompleteClasificacion').autocomplete({
  data: {
  @foreach($todos as $re)
  "memorandun" : null,
  "oficio": null,
  "ordenanza": null,
  "acuerdos": null,
  @endforeach
  }
  });
  
  }); // end of document ready
  })(jQuery); // end of jQuery name space
  
  
  
</script>@endsection