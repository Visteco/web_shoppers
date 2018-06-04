<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shoppers</title>
    <link href="{{url('public/asset/plugins/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/asset/plugins/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/asset/plugins/dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!--link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" /-->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="{{url('public/asset/plugins/dist/js/jquery.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
    </script>
  </head>

<body class="{{(count($errors->register) > 0)?'modal-open':''}}" style="{{(count($errors->register) > 0)?'padding-right: 17px':''}}">

<div class="main_bg">
  <div id="headder">
    <div class="container">
      <div class="row">
        <div class="col-md-3"><a class="navbar-brand" href="index.html"><img src="{{url('public/asset/plugins/dist/images/logo.png')}}" /></a> </div>
        <div class="col-md-9">
        <div class="modals">
          <a href="#">Register as a Business</a>
          <li class="dropdown {{(count($errors->login)>0 && $errors->login->has('autherror') )?'open':''}}"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
              <form class="form" role="form" method="post" action="{{ URL::to('guest/dologin') }}" accept-charset="UTF-8" id="login-nav">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul>
                  <li>
                    <?php if( count($errors->login)>0 && $errors->login->has('autherror') ): ?>
                      <div class="alert alert-danger">
                          @if ($errors->login->has('autherror'))
                            {{ $errors->login->first('autherror') }}
                          @endif
                      </div>
                    <?php endif ?>   
                  </li>
                </ul>
                <div class="form-group">
                 <label class="sr-only" for="exampleInputEmail2">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                </div>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputPassword2">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block button_red">Login</button>
                    <!--  <a href="{{ URL::route('auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Log in With Facebook</a> -->
                    <a href="{{url('/forgot-password')}}">Forgot password ?</a>
                  </div>
                </div>
              </form>
            </ul>
          </li>
          <?php 
              $style = (count($errors->register) > 0)?'style=display:block':'';
              $dialog_height = (count($errors->register) > 0)?(547+((count($errors->register)*25)+count($errors->register))):'';
              $style2 = (count($errors->register) > 0)?'style=height:100%':'';
              $image_height = (count($errors->register) > 0)?(547+((count($errors->register)*25)+count($errors->register))-2):'';
            ?>
          <div class="reg_popup">
            <button id='modal-launcher' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login-modal">Register</button>
            <div class="overlay">
            <div class="modal fade {{(count($errors->register) > 0)?'in':''}}" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" {{$style}}>
              <div class="modal-dialog" style="height: {{$dialog_height}}px;">
                <div class="modal-content" {{$style2}}>
                  <div class="modal-header login_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title" id="myModalLabel"></h2>
                  </div>
                  <div class="modal-body login-modal">
                    <div class="clearfix"></div>
                    <div id='social-icons-conatainer'>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="modal-social-icons" style="height:{{$image_height}}px">
                            <h1>Shoppers</h1>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sir amet adipisci velit</p>
                          </div> 
                        </div>
                         <form id="user-signup-form" data-toggle="validator" class="" role="form" method="POST" action="{{ URL::to('user/register') }}">
                          <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class='modal-body-right'>
                              <div class='modal-body-left'>
                                <h6><strong>Register</strong> Join Us. Its Free</h6>
                                <p>Are you member? <a href="index.html">Login Now</a> It's Free and easy</p>

                                <div class="form-group {{ $errors->register->has('role') ? ' has-error' : '' }}">
                                  <select size="0" class="form-control-dropdown" name="role">
                                    <option value=" ">Choose account type</option>
                                    <option <?php if(old('role')== USER_PROFILE ): echo "selected"; endif ?> value="{{USER_PROFILE}}">Personal</option>
                                    <option <?php if(old('role')== COMPANY_PROFILE ): echo "selected"; endif ?> value="{{COMPANY_PROFILE}}">Business</option></option>
                                  </select>
                                  @if ($errors->register->has('role'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->register->first('role') }}</strong>
                                    </span>
                                  @endif
                                </div>

                                <div class="form-group {{ $errors->register->has('name') ? ' has-error' : '' }}"">
                                  <input type="text" name="name" id="first_name" class="form-control-register" placeholder="Enter Name / Business Name" tabindex="1" value="{{old('name')}}">
                                  @if ($errors->register->has('name'))
                                    <span class="help-block">
                                        <strong class="error-class">{{ $errors->register->first('name') }}</strong>
                                    </span>
                                  @endif
                                </div>

                                  <div class="form-group {{ $errors->register->has('email') ? ' has-error' : '' }}">
                                    <input type="email" name="email" id="email" class="form-control-register" placeholder="Enter Email ID" tabindex="4" value="{{old('email')}}">
                                    @if ($errors->register->has('email'))
                                      <span class="help-block">
                                          <strong class="error-class">{{ $errors->register->first('email') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group {{ $errors->register->has('password') ? ' has-error' : '' }}">
                                    <input type="password" name="password" id="login-pass" placeholder="Enter Password" value="{{old('password')}}" class="form-control-register">
                                    @if ($errors->register->has('password'))
                                        <span class="help-block">
                                            <strong class="error-class">{{ $errors->register->first('password') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div class="checkbox {{ $errors->register->has('turms') ? ' has-error' : '' }}">
                                    <label><input type="checkbox" name="turms"> Accept Terms & Conditions Of Use * </label>
                                     @if ($errors->register->has('turms'))
                                        <span class="help-block">
                                            <strong class="error-class">{{ $errors->register->first('turms') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <h5>
                                    <input type="submit" class="btn btn-success modal-login-btn" value="Register">
                                  </h5>
                                  <div class="regis_media">
                                    <p>Register with social media</p>
                                    <ul>
                                      <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                      <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                      <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
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
        </div>
      </div>
    </div>
    <div class="hr"></div>
  </div>
</div>
<!-- end headder-->