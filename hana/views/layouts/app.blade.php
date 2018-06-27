<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Visteco</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{URL::to('asset/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Font Awesome CSS -->
        <link href="{{URL::to('css/font-awesome.css')}}"  rel="stylesheet">
        <link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet">


        <!-- Animate CSS -->
        <link href="{{URL::to('css/animate.css')}}" rel="stylesheet" >

        <!-- Owl-Carousel -->
        <link rel="stylesheet" href="{{URL::to('css/owl.carousel.css')}}" >
        <link rel="stylesheet" href="{{ URL::to('css/owl.theme.css')}}" >
        <link rel="stylesheet" href="{{ URL::to('css/owl.transitions.css')}}" >

        <!-- Custom CSS -->
        <link href="{{URL::to('css/style.css') }}" rel="stylesheet">
        
        <link href="{{URL::to('css/responsive.css')}}" rel="stylesheet">

        <!-- Colors CSS -->
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/color/green.css')}}">



        <!-- Colors CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/green.css') }}" title="green">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/light-red.css')}}" title="light-red">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/blue.css')}}" title="blue">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/light-blue.css')}}" title="light-blue">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/yellow.css')}}" title="yellow">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/color/light-green.css')}}" title="light-green">

        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

        <!-- Modernizer js -->
        <script src="{{URL::to('js/modernizr.custom.js')}}"></script>
        <!-- jQuery Version 2.1.1 -->
        <script src="{{URL::to('js/jquery-2.1.1.min.js')}}"></script>
        <!--[if lt IE 9]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <!--[endif]-->

    </head>

    <body class="index">


        <!-- Styleswitcher-- ================================================== -->
        <div class="colors-switcher">
            <a id="show-panel" class="hide-panel"><i class="fa fa-tint"></i></a>        
            <ul class="colors-list">
                <li><a title="Light Red" onClick="setActiveStyleSheet('light-red'); return false;" class="light-red"></a></li>
                <li><a title="Blue" class="blue" onClick="setActiveStyleSheet('blue'); return false;"></a></li>
                <li class="no-margin"><a title="Light Blue" onClick="setActiveStyleSheet('light-blue'); return false;" class="light-blue"></a></li>
                <li><a title="Green" class="green" onClick="setActiveStyleSheet('green'); return false;"></a></li>

                <li class="no-margin"><a title="light-green" class="light-green" onClick="setActiveStyleSheet('light-green'); return false;"></a></li>
                <li><a title="Yellow" class="yellow" onClick="setActiveStyleSheet('yellow'); return false;"></a></li>

            </ul>

        </div>  
        <!-- Styleswitcher End-- ================================================== -->
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top snavbar">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php"><img src="images/logos/visteco.png"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php include("include/signup.php") ?>
                    
                    <?php include("include/login.php") ?>
                    <ul class="nav navbar-nav navbar-right login signup">  

                        <li>
                            <label> &nbsp; </label>
                            <button id="logon">Log In</button>
                        </li>
                        <li>
                            <label> &nbsp; </label>
                            <button data-toggle="modal" data-target="#signup">Register</button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right login signin">                    
                        <li>
                            <label> Email or Phone </label>
                            <input type="text" name="user_email">
                            <!--<span><a href="" data-toggle="modal" data-target="#signup">New User Register</a></span>-->
                        </li>
                        <li>
                            <label> Password </label>
                            <input type="password" name="user_password">
                            <span><a class="pointer" data-toggle="modal" data-target="#forgotpass">Forgotten account ?</a></span>
                        </li>
                        <li>
                            <label> &nbsp; </label>
                            <button type="submit" name="login">Log In</button>
                        </li>
                    </ul>
                </div>
                
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>




@yield('content')

