
@extends('layouts.concejal')
@section('content')
<br>
<div class="container">
  <div class="card-panel">
    <h5 class="blue-text animated bounceInDown">
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
          <td><a href="{{url('concejal/chat/'.$id)}}"><i aria-hidden="true" class="fa fa-commenting fa-2x"></i></a></td>
        </tr>@endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>@endsection