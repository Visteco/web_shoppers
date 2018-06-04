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
        <link href="{{URL::to('css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet">


        <!-- Animate CSS -->
        <link href="{{URL::to('css/animate.css')}}" rel="stylesheet" >


        <!-- Owl-Carousel -->
        <link rel="stylesheet" href="{{URL::to('css/owl.carousel.css')}}" >
        <link rel="stylesheet" href="{{URL::to('css/owl.theme.css')}}" >
        <link rel="stylesheet" href="{{URL::to('css/owl.transitions.css')}}" >

        <!-- Custom CSS -->
        <link href="{{URL::to('public/css/style.css')}}" rel="stylesheet">
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
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

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
    </script>
    
       <?php 
       $emoticons = session('emoticons');
       $notifications = session('notifications');
       ?>    
        
    </head>
    <body class="index">
        @if(Auth::user()->status != 0)
            <div id="loader">

                <div class="spinner">

                    <div class="dot1"></div>

                    <div class="dot2"></div>

                </div>

            </div>
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
        @endif 
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
                    
                    <a class="navbar-brand page-scroll" href="index.php"><img src="{{ URL::to('public/images/logos/login_logo.png') }}"></a>
                    
                    <div class="navbar-header sbanner bannerdiv clearfix">
                        <input type="text" placeholder="Search keyword" oninput="getSuggestion(this,'{{ URL::to('suggest/') }}','suggestion_id1')"/>
                        <button name=""><i class="fa fa-search" aria-hidden="true"></i></button>
                        <div class="suggestion">
                            <ul id="suggestion_id1" class="list-group">
                                
                            </ul>
                        </div>
                    </div>

                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right menu_icon">                    
                        <li class="dropdown">
                                <a href="{{ URL::to('my-network') }}">
                                <i class="icon-home3"></i>My Network</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ URL::to('user/jobs') }}">
                                <i class="icon-briefcase"></i>Jobs</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ URL::to('user/directory') }}">
                                <i class="icon-office"></i>Search Directory</a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                <i class="icon-envelop"></i>Messaging</a>
                            <div class="dropdown-menu" role="menu">
                                <div class="list_item">
                                    <ul>
                                        <li><a href=""><img src="{{URL::to('public/images/user.png')}}">Item is place here !!</a></li>
                                        <li><a href=""><img src="{{URL::to('public/images/user.png')}}">Item is place here !!</a></li>
                                        <li><a href=""><img src="{{URL::to('public/images/user.png')}}">Item is place here !!</a></li>
                                        <li><a href=""><img src="{{URL::to('public/images/user.png')}}">Item is place here !!</a></li>
                                    </ul>
                                </div>
                                <div class="c_all"><a href="{{URL::to('user/allmessages')}}">See All</a></div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                <i class="icon-bell"></i>Notifications</a>
                            <div class="dropdown-menu" role="menu">
                                <div class="list_item">
                                    <ul>
                                        @if(count($notifications) > 0)
                                       
                                        <table class="table table-striped tbl_list">
                                        <tbody>
                                            @foreach($notifications as $notification) 
                                            <tr>
                                           
                                            <td>
                                                
                                                <img src="public/images/people/p8.jpg" alt="">
                                                
                                            </td>
                                                
                                            <td>
                                                <div class="ntxt">
                                                    
                                                    @if($notification->role == COMPANY_PROFILE)
                                                        <strong>{{ $notification->company_name }}</strong>
                                                    @elseif($notification->role == USER_PROFILE)      
                                                        <strong>{{ $notification->user_name }}</strong>
                                                    @endif
                                                    
                                                    <a href="{{ $notification->action }}">{{ $notification->text }}</a> 
                                                </div>
                                                <div class="ntime">{{ $notification->time }}</div>
                                                
                                            </td>
                                            
                                            </tr>
                                           @endforeach 
                                    
                                    
                                    </tbody>
                                </table>   
                                                                                
                                        @else
                                            <li> <a href="">No new notifications </a></li>
                                        
                                        @endif
                                        
                                    </ul>
                                </div>
                                <div class="c_all"><a href="{{URL::to('user/allnotification')}}">See All</a></div>
                            </div>
                        </li>


                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                <?php $profilepic= empty(Session::get('profilepic')) ? URL::to('images/user.png') : URL::to('public/userimages/user_'.Auth::user()->id."/medium/".Session::get('profilepic'))  ?>
                                <img src="{{ $profilepic }}"><span class="caret"></span></a>
                            <div class="dropdown-menu" role="menu">
                                <ul>
                                    
                                    
                                    
                                    @if(Auth::user()->login_role==COMPANY_PROFILE)
                                    <li><a href="{{ URL::to('company/profile') }}"><span class="icon-user">&nbsp;</span>{{ Auth::user()->user_name }}</a></li>
                                    @endif
                                    
                                    @if(Auth::user()->login_role==USER_PROFILE)
                                    <li><a href="{{ URL::to('user/profile') }}"><span class="icon-user">&nbsp;</span>{{ Auth::user()->user_name }}</a></li>
                                    @endif
                                    
                                    
                                    <li><a href="{{ URL::to('user/wallet') }}"><span class="icon-book">&nbsp;</span> Wallet</a></li>
                                    
                                    @if(Auth::user()->login_role==COMPANY_PROFILE)
                                    <li><a href="{{ URL::to('company/settings') }}"><span class="icon-cog">&nbsp;</span>Settings</a></li>
                                    @endif
                                    
                                    @if(Auth::user()->login_role==USER_PROFILE)
                                    <li><a href="{{ URL::to('user/settings') }}"><span class="icon-cog">&nbsp;</span>Settings</a></li>
                                    @endif
                                    
                                   
                                    <li><a href="{{ URL::to('user/logout') }}"><span class="icon-switch">&nbsp;</span> Log Out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        
        @yield('content')
        
        