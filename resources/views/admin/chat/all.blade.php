
@extends('layouts.admin')
@section('content')
<br>
<div class="container">
  <div class="card-panel">
    <h5 class="teal-text">
<i class="fa fa-commenting fa-2x" aria-hidden="true"></i>
    Chat</h5>
    <div class="divider"></div>
    <table> 
      <thead>
        <tr>
          <th>Avatar</th>
          <th>Comisión</th>
          <th>Nombre</th>
          <th>Chat</th>
        </tr>
      </thead>
      <tbody>
        @foreach($salas as $co)
        @var('id',$co->id)
        @var('avatar',$co->councilor->avatar)
        @if(Auth::user()->email != $co->councilor->user->email)
        <tr>
          <td><img class="materialboxed" width="70" src="{{asset('storage/'.$avatar)}}" alt=""/></td>
          <td>{{ucfirst($co->councilor->comision)}}</td>
          <td>{{$co->councilor->name}}</td>
          <td>@if($co->siteID)<a href="{{url('admin/chat/'.$id)}}"><i aria-hidden="true" class="fa fa-commenting fa-2x teal-text"></i></a>@else<a href="{{url('admin/chat/'.$id.'/edit')}}"><i aria-hidden="true" class="fa fa-commenting fa-2x grey-text"></i></a>@endif</td>
        </tr>@endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>@endsection