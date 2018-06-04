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
<link href="{{url('public/asset/plugins/dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" /-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="{{url('public/asset/plugins/dist/js/jquery.js')}}" type="text/javascript"></script>
</head>
<body style=" background:#f2f3f5;">
<!--nav-->
<nav class="navbar navbar-default main-nav" role="navigation" style="border: none;">
  <div class="container"> <!-- Brand and toggle get grouped for better mobile display --> <!--div class="col-md-1"-->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
      	<span class="sr-only">Toggle navigation</span> 
      	<span class="icon-bar"></span>
      	<span class="icon-bar"></span>
      	<span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand network_logo mobile" href="http://webapplisoft.com/appli/design/shoppers/">
      	<img src="{{url('public/asset/plugins/dist/images/single_logo@3x.png')}}" />
      </a> 
  	</div>
    <!--/div--> <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <a class="navbar-brand network_logo desk" href="http://webapplisoft.com/appli/design/shoppers/">
    	<img src="{{url('public/asset/plugins/dist/images/single_logo@3x.png')}}" />
      </a>
      <div class="nav_icon">
        <ul class="nav navbar-nav main-nav-div">
          <li class="search">
            <form class="navbar-form navbar-left" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" />
              </div>
            </form>
          </li>
          <li><a href="{{URL::to('/my-network')}}" class="current_page"><span class=""><img src="{{url('public/asset/plugins/dist/images/home.png')}}"></span><br>
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
          <li class="dropdown"><a href="#" class="dropdown-toggle userk" data-toggle="dropdown"> <span><img src="{{url('public/asset/plugins/dist/images/app_user.png')}}"></span>Kittu Rathor <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="profile.html"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
              <li class="divider"></li>
              <li><a href="#"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.navbar-collapse --> </div>
</nav>