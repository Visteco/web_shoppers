@extends('layouts.password_layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <h3><img src="{{url('public/asset/img/Forgot-password-icon.png')}}"><!--i class="fa fa-lock fa-4x"></i--></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>Please send email for reset your password here.</p>
              <div class="panel-body">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if (Session::has('alert-'.$msg))
                    <div class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}</div>
                  @endif
                @endforeach
                <form id="register-form" action="{{url('sendpasswordmail')}}" role="form" autocomplete="off" class="form" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                      <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <input class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
