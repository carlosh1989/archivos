
@extends('layouts.concejal')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row animated bounceInDown">

      <div class="col s12">
        <h5 class="blue-text center"><i class="fa fa-folder-open-o fa-2x blue-text" aria-hidden="true"></i> Archivos</h5>
      </div>
    </div>
    <div class="divider"></div><br/>
    <table>
      <thead>
        <tr class="grey-text">
          <th data-field="nombre">Nombre</th>
          <th data-field="tipo">Tipo </th>
          <th data-field="Opciones">Visto</th>
        </tr>
      </thead>
      <tbody>@foreach($resultados as $re)
        <tr>
          <td>{{$re->file->name}}</td>
          <td width="45%">
        @var('tipo',$re->file->type)
        @if($tipo == 'word')<i aria-hidden="true" class="fa fa-file-word-o fa-3x blue-text"></i>@endif
        @if($tipo == 'excel')<i aria-hidden="true" class="fa fa-file-excel-o fa-3x green-text"></i>@endif
        @if($tipo == 'pdf')<i aria-hidden="true" class="fa fa-file-pdf-o fa-3x red-text"></i>@endif
        @if($tipo == 'point')<i aria-hidden="true" class="fa fa-file-powerpoint-o fa-3x orange-text"></i>@endif
        @if($tipo == 'imagen')<i aria-hidden="true" class="fa fa-file-image-o fa-3x purple-text"></i>@endif
          </td>
          <td>@var("id",$re->id)
        @if($re->visto == 'si')
         <a class="btn green" href="{{url('/concejal/archivos/'.$id)}}"> <i class="fa fa-check"></i></a>
        @else
          <a class="btn blue" href="{{url('/concejal/archivos/'.$id)}}"> <i class="fa fa-eye"></i></a>
        @endif

          </td>
        </tr>@endforeach
      </tbody>
    </table>
  </div>{{ $resultados->links() }}
</div>@endsection