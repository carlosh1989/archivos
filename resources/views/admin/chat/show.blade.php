
@extends('layouts.admin')
@section('content')
@var('avatar',$room->councilor->avatar)
<div class="container">
  <div class="card-panel"><img width="70" src="{{asset('storage/'.$avatar)}}" alt=""/>
    <h4 class="teal-text">Chat con {{ucwords(strtolower($room->councilor->name))}}</h4>
    <div class="divider"></div>
    <p>
      En el lado derecho se encuentra la ventana de chat, en el cual podra chatear con est concejal, los mensajes le llegaran por distintos medios android, explorador. Podra enviar archivos  tambien. 
      
    </p>
  </div>
</div>
<script>
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/{{$room->siteID}}/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  
</script><!--End of Tawk.to Script-->
@endsection