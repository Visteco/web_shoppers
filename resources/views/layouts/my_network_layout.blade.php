<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Network</title>
<link href="{{url('public/asset/plugins/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('public/asset/plugins/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Font Awesome CSS -->
<link href="{{URL::to('css/font-awesome.css')}}" rel="stylesheet">
<link href="{{url('public/asset/plugins/dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" /-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script><script src="{{url('public/asset/plugins/dist/js/jquery.js')}}" type="text/javascript"></script>
<!-- Animate CSS -->
<link href="{{URL::to('css/animate.css')}}" rel="stylesheet" >


<!-- Owl-Carousel -->
<link rel="stylesheet" href="{{URL::to('css/owl.carousel.css')}}" >
<link rel="stylesheet" href="{{URL::to('css/owl.theme.css')}}" >
<link rel="stylesheet" href="{{URL::to('css/owl.transitions.css')}}" >

<!-- Custom CSS -->
<link href="{{URL::to('css/responsive.css')}}" rel="stylesheet">
<link href="{{URL::to('css/icomoon.css')}}" rel="stylesheet">

<!-- Colors CSS -->
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/green.css')}}" title="green">
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/light-red.css')}}" title="light-red">
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/blue.css')}}" title="blue">
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/light-blue.css')}}" title="light-blue">
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/yellow.css')}}" title="yellow">
<link rel="stylesheet" type="text/css" href="{{URL::to('css/color/light-green.css')}}" title="light-green">

<!-- Custom Fonts -->
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

<!-- jQuery Version 2.1.1 -->
<script src="{{URL::to('js/jquery-2.1.1.min.js')}}"></script>

<!-- Modernizer js -->
<script src="{{URL::to('js/modernizr.custom.js')}}"></script>


<script src="{{ URL::to('js/count-to.js') }}"></script>

<!--[if lt IE 9]-->
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<!--[endif]-->

<script type="text/javascript" >
var LINK_CRAWL = "{{ URL::to('strchecklink?link=') }}" ;
var DO_POST = "{{ URL::to('dopost') }}" ;
var DO_COMMENT = "{{ URL::to('docmnt') }}" ;
var UPDATE_REPLY = "{{ URL::to('updaterply') }}" ;
var UPDATE_COMMENT = "{{ URL::to('doupdatecmnt') }}" ;
var NEXT_PAGE_URL  = "{{ session('next_page_url') }}";
var PROJECT_URL    = "{{ URL::to('/')}}"
var TAGGED_USER;
TAGGED_USER = '{"name":"{{Auth::user()->user_name}}","id":"{{Auth::user()->id}}"}'; 
</script>

<?php 
$emoticons = session('emoticons');
$notifications = session('notifications');
?>   
</head>
<body style=" background:#f2f3f5;">
<!-------------------nav----------------->
<nav class="navbar navbar-default main-nav" role="navigation" style="border: none;">
  <div class="container"> <!-- Brand and toggle get grouped for better mobile display --> <!--div class="col-md-1"-->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span                    class="icon-bar"></span><span class="icon-bar"></span> </button>
      <a class="navbar-brand network_logo mobile" href="http://webapplisoft.com/appli/design/shoppers/"><img src="{{url('public/asset/plugins/dist/images/single_logo@3x.png')}}" /></a> </div>
    <!--/div--> <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> <a class="navbar-brand network_logo desk" href="http://webapplisoft.com/appli/design/shoppers/"><img src="{{url('public/asset/plugins/dist/images/single_logo@3x.png')}}" /></a>
      <div class="nav_icon">
        <ul class="nav navbar-nav main-nav-div">
          <li class="search">
            <form class="navbar-form navbar-left" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" />
              </div>
            </form>
          </li>
          <li><a href="{{url('my-network')}}" class="current_page"><span class=""><img src="{{url('public/asset/plugins/dist/images/home.png')}}"></span><br>
            My Network</a></li>
          <li><a href="#"><span class=""><img src="{{url('public/asset/plugins/dist/images/jobs.png')}}"></span><br>
            jobs</a></li>
          <li><a href="#"><span class=""><img src="{{url('public/asset/plugins/dist/images/directory.png')}}"></span><br>
            Search Directory</a></li>
          <li><a href="#"><span class=""><img src="{{url('public/asset/plugins/dist/images/msg.png')}}"></span><br>
            Messaging</a></li>
          <li><a href="#"><span class=""><img src="{{url('public/asset/plugins/dist/images/notification.png')}}"></span><br>
            Notifications</a></li>
        </ul>
      </div>
      <div class="admin">
        <ul class="nav navbar-nav navbar-right nav-right-ul">
          <?php $profilepic= empty(Session::get('profilepic')) ? URL::to('images/user.png') : URL::to('public/userimages/user_'.Auth::user()->id."/medium/".Session::get('profilepic'))  ?>
          <li class="dropdown"><a href="#" class="dropdown-toggle userk" data-toggle="dropdown"> <span><img src="{{$profilepic}}"></span>{{ Auth::user()->user_name }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              @if(Auth::user()->login_role==COMPANY_PROFILE)
                <li><a href="{{ URL::to('company/profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
              @elseif(Auth::user()->login_role==USER_PROFILE)
                 <li><a href="{{ URL::to('user/profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
              @endif

              @if(Auth::user()->login_role==USER_PROFILE)
                <li><a href="{{ URL::to('user/settings') }}"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
              @endif
              <li class="divider"></li>
              <li><a href="{{ URL::to('user/logout') }}"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.navbar-collapse --> </div>
</nav>
<!-------------------nav----------------->
@yield('content')