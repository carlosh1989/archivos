@extends('layouts.app')
<style>
    .parallax-container {
      height: 100px;
    }
</style>
@section('content')
<div class="container">
<br><br>
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card card-panel">
      
                <div class="panel-body">
                    <form autocomplete="false" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
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
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
