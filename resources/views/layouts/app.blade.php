<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8" />
  <title>SIWECAM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="{{asset('bower/components-font-awesome/css/font-awesome.min.css')}}">
  <!-- remember, jQuery is completely optional -->
  <!-- <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script> -->
    <link href="/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/materialize.min.css')}}"> 
      <link rel="stylesheet" href="{{asset('/bower/sweetalert/dist/sweetalert.css')}}">     
   <link rel="stylesheet" href="{{asset('bower/components-font-awesome/css/font-awesome.min.css')}}">
   <link rel="stylesheet" href="{{asset('bower/animate.css/animate.min.css')}}">
<style>
  .emailMessage{
  -webkit-animation-duration: 1s;
  -webkit-animation-delay: 0.7s;
  -webkit-animation-iteration-count: 1;
  }

  .passwordMessage{
  -webkit-animation-duration: 1s;
  -webkit-animation-delay: 0.7s;
  -webkit-animation-iteration-count: 1;
  }

  .logo{

    height: 300px;
  }

  .login
  {
    margin-top: -60px;
  }
</style>
<script>
// A $( document ).ready() block.
$(document).ready ( function(){
   alert('ok');
});​
</script>
</head>

<body>
<script type="text/javascript" src="{{asset('bower/jquery-2.1.1/index.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.particleground.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/demo.js')}}"></script>

<div id="particles">
  <div id="intro">
<div style="text-align:center;" > <img class="logo" src="{{asset('img/logo.png')}}" alt="descripción de imagen" /></div> 
<style>

</style>
@section('content')

<div class="container animated login bounceInDown">
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card card-panel">
      
                <div class="panel-body">
                    <form autocomplete="false" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
<i class="fa fa-envelope-o" aria-hidden="true"></i>
                            E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                              <div class="card-panel red white-text emailMessage animated bounceIn">
                              {{ $errors->first('email') }}
                              <i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i>
                              </div>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">
<i class="fa fa-key" aria-hidden="true"></i>
                            Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                  <div class="card-panel red white-text passwordMessage animated bounceIn">
                                  {{ $errors->first('password') }}
                                  <i aria-hidden="true" class="fa fa-exclamation pull-right fa-2x"></i>
                                  </div>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <div class="switch">
                            <label>
                              <input type="checkbox" name="remember">
                              <span class="lever"></span>
                              Recuerdame
                            </label>
                          </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="col-md-8 col-md-offset-4">
                            <div class="divider"></div>
                            <br>
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
</div>
@yield('content')
</body>
</html>





  