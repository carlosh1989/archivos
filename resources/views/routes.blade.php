@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col s12">
        <table class="striped card-panel">
<h3 class="blue-text"><i class="fa fa-truck" aria-hidden="true"></i> Rutas ({{$routeCollection->count()}})</h3>
        <thead>
          <tr>
              <th data-field="id">Metodo</th>
              <th data-field="name">Ruta</th>
              <th data-field="price">Controlador</th>
            <th data-field="price">Función</th>
          </tr>
        </thead>

        <tbody>
        @foreach($routeCollection as $value)
          <tr>
          <td>
  <?php $methodColours = ['GET' => 'green', 'HEAD' => 'purple', 'POST' => 'blue', 'PUT' => 'yellow', 'PATCH' => 'orange', 'DELETE' => 'red']; ?>

    <?php $icon = ['GET' => 'chevron-left', 'HEAD' => 'purple', 'POST' => 'chevron-right', 'PUT' => 'chevron-up', 'PATCH' => 'orange', 'DELETE' => 'minus']; ?>
          @foreach ($value->getMethods() as $method)
            @if($method == 'HEAD')
            @else
            <span class="chip white-text {{ array_get($methodColours, $method) }}"><i class="fa fa-{{ array_get($icon, $method) }}" aria-hidden="true"></i> {{ $method }}
            </span>
            @endif
            @endforeach
            </td>
            <td> <a class="grey-text text-darken-2">{{$value->getPath()}}</a></td>
            <td>
           @var('pos',strpos($value->getActionName(), '@'))
        
            @if($pos !== false)
               <?php list($controlador, $funcion) = explode('@',$value->getActionName()) ?>
            <?php $methodColours = ['create' => 'blue', 'index'=> 'pink', 'store' => 'green', 'destroy' => 'red', 'update' => 'deep-purple', 'edit' => 'orange', 'show' => 'cyan']; ?>

            <?php $icon = ['create' => 'plus', 'index'=> 'indent', 'store' => 'floppy-o', 'destroy' => 'trash', 'update' => 'hdd-o', 'edit' => 'pencil-square-o', 'show' => 'eye']; ?>
            <?php
$control2 = substr($controlador, 21);
$con = explode('/',$control2);

?>
             <a class="grey-text text-darken-2"><i class="fa fa-file-code-o" aria-hidden="true"></i> {{$con[0]}}</a> 

            @else
                <a class="grey-text text-darken-2">{{$value->getActionName()}}</a>
            @endif
 

            </td>
            <td>
           @var('pos',strpos($value->getActionName(), '@'))
        
            @if($pos !== false)
               <?php list($controlador, $funcion) = explode('@',$value->getActionName()) ?>
            <?php $methodColours = ['create' => 'blue', 'index'=> 'pink', 'store' => 'green', 'destroy' => 'red', 'update' => 'deep-purple', 'edit' => 'orange', 'show' => 'cyan']; ?>

            <?php $icon = ['create' => 'plus', 'index'=> 'indent', 'store' => 'floppy-o', 'destroy' => 'trash', 'update' => 'hdd-o', 'edit' => 'pencil-square-o', 'show' => 'eye']; ?>
            <?php
$control2 = substr($controlador, 21);
$con = explode('/',$control2);

?>
            @if('create' == $funcion or 'store' == $funcion or 'edit' == $funcion or 'put' == $funcion or 'destroy' == $funcion or 'path' == $funcion or 'update' == $funcion or 'show' ==  $funcion or 'index' == $funcion)
                  <span class="chip white-text {{ array_get($methodColours, $funcion) }}"> <i class="fa fa-{{ array_get($icon, $funcion) }}" aria-hidden="true"></i> {{ $funcion }}
                   
                  </span>
                  
               @else
                 <span class="chip gray-text grey lighten-5"><i class="fa fa-keyboard-o" aria-hidden="true"></i> {{ $funcion }}</span>
               @endif    

            @else
            @endif
 

            </td>
          </tr>
        @endforeach
        </tbody>
      </table> 
    </div>
</div>

<script>
     $('.chips').material_chip();
</script>

@endsection