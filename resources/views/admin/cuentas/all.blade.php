
@extends('layouts.admin')
@section('content')
<div class="container"><br/>
  <div class="card-panel">
    <div class="row animated bounceInDown">

      <div class="col s12">
        <h5 class="teal-text center"><i class="fa fa-user fa-2x teal-text" aria-hidden="true"></i> Cuentas</h5>
      </div>
    </div>
    <div class="divider"></div><br/>
    <table>
      <thead>
        <tr class="grey-text">
          <th data-field="nombre">Nombre</th>
          <th data-field="tipo">Email</th>
          <th data-field="Opciones">Eliminar</th>
        </tr>
      </thead>
      <tbody>
      @foreach($resultados as $re)
       <tr>
         <td>
           {{ucwords($re->name)}}
         </td>
         <td>
           {{$re->user->email}}
         </td>
         <td>
    <form action="{{url('/admin/cuentas')}}/{{$re->user->id}}" method="post">
          {{ method_field('delete')}}
          {{csrf_field()}}
           <button class="btn red" type="submit">Eliminar</button>
         </form>
         </td>
       </tr>
        </tr>
      @endforeach   
      </tbody>
    </table>
  </div>
</div>@endsection