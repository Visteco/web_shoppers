@extends('layouts.password_layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="text-center">
            <h3><img src="{{url('public/asset/img/Forgot-password-icon.png')}}"><!--i class="fa fa-lock fa-4x"></i--></h3>
            <div class="panel-body">
                @if($errors->default->has('password'))
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{$errors->default->first('password')}}
                  </div>
                @endif
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if (Session::has('alert-'.$msg))
                    <div class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}</div>
                  @endif
                @endforeach
              @if(!Session::has('alert-success'))
                <p>You can reset your password here.</p>
                <form id="register-form" role="form" autocomplete="off" class="form" action="{{url('createresetpassword/'.$id)}}" method="post">
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue reset-field"></i></span>
                      <!-- <input id="email" name="email" placeholder="email address" class="form-control"  type="email"> -->
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                    <input type="hidden" name="fp_code" value="{{$_REQUEST['t']}}"/>
                  </div>
                </form>
              @else
                <p>Go to <a href="{{url('/')}}">Login</a></p>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection