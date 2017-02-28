
@extends('layouts.concejal')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row">
      <div class="col l2 s2">
        @var('tipo',$post->file->type)
        @if($tipo == 'word')<i aria-hidden="true" class="fa fa-file-word-o fa-3x blue-text"></i>@endif
        @if($tipo == 'excel')<i aria-hidden="true" class="fa fa-file-excel-o fa-3x green-text"></i>@endif
        @if($tipo == 'pdf')<i aria-hidden="true" class="fa fa-file-pdf-o fa-3x red-text"></i>@endif
        @if($tipo == 'point')<i aria-hidden="true" class="fa fa-file-powerpoint-o fa-3x orange-text"></i>@endif
        @if($tipo == 'imagen')<i aria-hidden="true" class="fa fa-file-image-o fa-3x purple-text"></i>@endif
      </div>
      <div class="col l8 s10">
        <h5 class="blue-text animated pulse">{{$post->file->name}}</h5>
      </div>
      <div class="col l2 s10">
        <a href="{{asset(''.$post->file->url)}}" download>Descargar</a>      
        </div>
    </div>
    <div class="divider"></div>
    <p>{{$post->file->description}}</p>
    <div class="divider"></div><iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://img.labnol.org/di/PowerPoint.ppt' width='500px' height='350px' frameborder='0'></iframe>
    <object type="text/html" data="https://view.officeapps.live.com/op/embed.aspx?src=http://img.labnol.org/di/PowerPoint.ppt" width="400" height="400"> </object>
  </div>
</div>@endsection