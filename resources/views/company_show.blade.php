
<?php
    if(Auth::check())
        $layout = "layouts.authorised";
    else 
        $layout = "layouts.guest";
    
$all='all';
$followersC=count($getFollowersCompanyList);
$followersU=count($getFollowersUserList);
$followersTotal=$followersC+$followersU;   
?>

@extends($layout)


@section('content')

<section class="profile-section">
    <div class="container-fluid">
        <div class="row uprofilecover">
            <img id="cover_pic" src="{{$coverPic}}"/>
            
        </div>			

        <div class="container no-gutter">	
            <div class="row">
                <div class="uprofile clearfix">
                    <div class="uprofilepic">
                        
                        
                        <img id="profile_pic" src="{{ $profilePic }}">
                        
                        
                    
                    </div>
                    <div class="uprodetail clearfix">
                        <div class="uproname">                            
                            <div class="uprofilename">{{ $company->company_name }}</div>	
                            <div class="uprofiledes">{{ $company->company_type }}</div>	
                            <div class="uprofilecomp">@if($company->company_state || $company->country) at <a href="">{{ $company->company_state }}, {{ $company->country }}</a> @endif</div>	
                            <div class="uprofilecomp comment more">{{ $company->about_us }}</div>	
                        </div>	
                    </div>
                    <div class="uprosocial clearfix">                                
                        <div class="uprosoc">                            
                            <div class="uprofilesoc">
                                <h6>Connect with us:</h6>                                    
                                <ul class="list-inline">
                                    <li><a href="www.facebook.com/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.twitter.com/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.plus.google.com/112145125284435166362" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.youtube.com/channel/UCPUMlBfy1ymuVFg5mN3jfjA" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.secure.skype.com/portal/overview?intsrc=client-_-windows-_-7.29.0.102-_-menu.account" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.linkedin.com/in/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>
                                </ul>
                            </div>                          
                            <div class="col-lg-12 no-gutter">
                                <button class="skybtn">Message</button>
                                <button class="skybtn" onclick="doFollow('{{ URL::to('followcompany/'.$company->uid) }}',this)">@if($UserAlreadyFollowing=="1") Following @else Follow @endif</button>
                            </div>
                            <div class="col-lg-12 no-gutter uprofilerate clearfix">
                                <div class="rating">
                                    <div class="star_review_comp">
                                        <div class="star_disabled_comp"></div>
                                        <div class="star_active_comp" style="width:70px;"></div>
                                    </div>
                                    <span class="dropdown">
                                        <span class="caret point" data-toggle="dropdown"></span>
                                        <ul class="dropdown-menu  dropdown-menu-right" role="menu">
                                            <li><a href="">1 Star</a></li>
                                            <li><a href="">2 Star</a></li>
                                            <li><a href="">3 Star</a></li>
                                            <li><a href="">4 Star</a></li>
                                            <li><a href="">5 Star</a></li>
                                        </ul>
                                    </span>
                                </div>
                                <div class="review">
                                    <button class="btn btn-primary">Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="follow_count"><h2>{{$followersTotal}}</h2><p>Followers</p></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Our Services </h4>
                    <div class="clients services">
                        @if( count($services) > 0 )
                        @foreach($services as $service)
                        <div class="col-md-12">
                           <a href="{{ URL::to("company/servicedetail/".$service->id) }}">
                           <img src="{{URL::to('images/services/'.$service->image)}}" class="img-responsive" alt="...">
                           <h4>{{$service->service_title}}</h4></a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>				
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs profile-tab">
                        
                        <li class="active"><a data-toggle="tab" href="#trending">
                                <i class="icon-stats-dots"></i><span>Trending</span></a></li>
                        <li>
                           <a data-toggle="tab" href="#portfolio" onclick="getGallery('{{ URL::to("getgallery/".$company->uid) }}')">
                                <i class="icon-images"></i><span>Gallery</span>
                            </a>
                        </li>
                        <li><a data-toggle="tab" href="#rteam">
                                <i class="icon-users"></i><span>Team</span></a></li>
                        <li><a data-toggle="tab" href="#ad">
                                <i class="icon-bullhorn"></i><span>Come In</span></a></li>
                        <!--<li><a data-toggle="tab" href="#vcards">
                                <i class="icon-profile"></i><span>vLetters</span></a></li>
                        <li><a data-toggle="tab" href="#bookmark">
                                <i class="icon-bookmarks"></i><span>Bookmarks</span></a></li>
                        <li><a data-toggle="tab" href="#profile">
                                <i class="icon-user"></i><span>Profile</span></a></li>-->
                        
                    </ul>
                    <div class="tab-content">
                        <div class="col-md-12 tab-pane fade in active" id="trending">

                            @foreach($trendingPosts as $post)
                                @include('posts.post')
                            @endforeach

                        </div>

                        <div class="col-md-12 tab-pane fade" id="portfolio">
                            <ul class="projects-list">
                                
                                
                                
                                @if(count($profilePics))
                                    @foreach($profilePics as $pic)
                                    <li>
                                        <div class="projects-item">
                                            <img src="{{ $pic }}" class="img-responsive" alt="" />
                                            <div class="projects-caption">
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/3/".$company->uid) }}','portfolio')">Profile Pics</h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                
                                @if(count($coverPics))
                                    @foreach($coverPics as $pic)
                                    <li>
                                        <div class="projects-item">
                                            <img src="{{ $pic }}" class="img-responsive" alt="" />
                                            <div class="projects-caption">
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/4/".$company->uid) }}','portfolio')" >Cover Pics</h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                
                                
                                @if(count($serviceImages))
                                    @foreach($serviceImages as $pic)
                                    <li>
                                        <div class="projects-item">
                                            <img src="{{ $pic }}" class="img-responsive" alt="" />
                                            <div class="projects-caption">
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/2/".$company->uid) }}','portfolio')">Services</h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                
                                @if(count($postImages))
                                    @foreach($postImages as $pic)
                                    <li>
                                        <div class="projects-item">
                                            <img src="{{ $pic }}" class="img-responsive" alt="" />
                                            <div class="projects-caption">
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/1/".$company->uid) }}','portfolio')">Uploads</h4>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                
                                
                                
                                
                            </ul>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="rteam">
                            <!-- Start people items -->
                            <h4>Our Team</h4>
                            <ul id="people-list">
                                <li>
                                    <div class="people-img">
                                        <img src="images/people/p1.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name">Sarvesh Kumar Yadav</div>
                                        <div class="people_des">Web Designer</div>
                                        <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                                        <div class="people_add">Noida, IN</div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>
                                <li>
                                    <div class="people-img">
                                        <img src="images/people/p2.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name">Ankur Sharma</div>
                                        <div class="people_des">Web Devloper (Php)</div>
                                        <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                                        <div class="people_add">Noida, IN</div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>
                                <li>
                                    <div class="people-img">
                                        <img src="images/people/p3.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name">Abhishek Sharma</div>
                                        <div class="people_des">Web Devloper (Php)</div>
                                        <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                                        <div class="people_add">Noida, IN</div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>
                            </ul>
                            <!-- End sources items -->
                            <h4>Our Client</h4>
                            <ul id="sources-list">
                                <li>
                                    <div class="sources-img">
                                        <img src="images/logos/1webcoir.png" class="img-responsive" alt="">
                                    </div>
                                    <div class="sources-item">
                                        <div class="comp_name">Webcoir It Solutions Pvt Ltd</div>
                                        <div class="comp_add">Noida, IN</div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active" style="width:70px;"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>
                                <li>
                                    <div class="sources-img">
                                        <img src="http://brandongaille.com/wp-content/uploads/2014/04/Google-Company-Logo.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="sources-item">
                                        <div class="comp_name">Google</div>
                                        <div class="comp_add">Chatham, UK</div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>
                                <li>
                                    <div class="sources-img">
                                        <img src="http://cdn-3.famouslogos.us/images/hp-logo.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="sources-item">
                                        <div class="comp_name">Hewlett-Packard</div>
                                        <div class="comp_add">Noida, IN</div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>     
                                <li>
                                    <div class="sources-img">
                                        <img src="http://3.bp.blogspot.com/-DoIQqthA8vc/VHu_rsyOeFI/AAAAAAAADkI/CJ73TYfxtYg/s1600/Amazon.PNG" class="img-responsive" alt="">
                                    </div>
                                    <div class="sources-item">
                                        <div class="comp_name">Amazone india</div>
                                        <div class="comp_add">Noida, IN</div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>  
                            </ul>
                        </div>

                        <div class="col-md-12 tab-pane fade about_box" id="ad">
                            <?php /*include("include/come_in.php")*/ ?>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="vcards">
                            <?php include("include/vletter.php") ?>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="bookmark">
                            <div class="post-box clearfix">
                                <ul class="post-list clearfix clearfix">
                                    <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                    <li class="post-name"><a href="" class="people_name"> Webcoir IT Solutions Pvt Ltd </a><time>Monday, 02 june 2016</time>
                                        <span class="people_des">IT Company at <a href="">Noida, IN</a></span>
                                    </li>
                                    <span class="dropdown">
                                        <span class="glyphicon dropdown-toggle glyphicon-globe" type="button" data-toggle="dropdown">
                                        </span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-globe"></span> Show post to everyone</a>
                                            </li>
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-user"></span> Show post to followers</a>
                                            </li>
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-lock"></span> Show post to only me</a>
                                            </li>
                                            <li>
                                                <a class="pointer"> <span class="glyphicon glyphicon-remove"></span> Delete this post</a>                                 
                                            </li>
                                        </ul>
                                    </span>
                                </ul>
                                <ul class="post-item">
                                    <li><p>
                                            Visteco business network helps introduce your business to other businesses around you locally, nationally and internationally. You can now see and interconnect with businesses surrounding you in your local area much easier. Search for partnerships or introduce your services and receive feedback. Simply exchange your contacts by using Vcard technology.
                                        </p></li>
                                    <li><img src="images/logos/1webcoir.png"></li>
                                </ul>
                                <ul class="post-soc">
                                    <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                                    <li><i class="glyphicon glyphicon-comment"></i><span>Comment</span></li>
                                    <li><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
                                    <li><i class="glyphicon glyphicon-share"></i><span>Share</span></li>
                                </ul>
                                <div class="post-cmnt clearfix">
                                    <ul class="post-list clearfix">
                                        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                        <li class="post-name"> 
                                            <p class="form-control cmnt_p" contenteditable="true" required=""></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="post-box clearfix">
                                <ul class="post-list clearfix clearfix">
                                    <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                    <li class="post-name"><a href="" class="people_name"> Webcoir IT Solutions Pvt Ltd </a><time>Monday, 02 june 2016</time>
                                        <span class="people_des">IT Company at <a href="">Noida, IN</a></span>
                                    </li>
                                    <span class="dropdown">
                                        <span class="glyphicon dropdown-toggle glyphicon-globe" type="button" data-toggle="dropdown">
                                        </span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-globe"></span> Show post to everyone</a>
                                            </li>
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-user"></span> Show post to followers</a>
                                            </li>
                                            <li>
                                                <a class="pointer"><span class="glyphicon glyphicon-lock"></span> Show post to only me</a>
                                            </li>
                                            <li>
                                                <a class="pointer"> <span class="glyphicon glyphicon-remove"></span> Delete this post</a>                                 
                                            </li>
                                        </ul>
                                    </span>
                                </ul>
                                <ul class="post-item">
                                    <li><p>
                                            Visteco business network helps introduce your business to other businesses around you locally, nationally and internationally. You can now see and interconnect with businesses surrounding you in your local area much easier. Search for partnerships or introduce your services and receive feedback. Simply exchange your contacts by using Vcard technology.
                                        </p></li>
                                    <li><img src="images/logos/1webcoir.png"></li>
                                </ul>
                                <ul class="post-soc">
                                    <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                                    <li><i class="glyphicon glyphicon-comment"></i><span>Comment</span></li>
                                    <li><i class="glyphicon glyphicon-bookmark"></i><span>Bookmark</span></li>
                                    <li><i class="glyphicon glyphicon-share"></i><span>Share</span></li>
                                </ul>
                                <div class="post-cmnt clearfix">
                                    <ul class="post-list clearfix">
                                        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                        <li class="post-name"><a href="" class="people_name"> Webcoir IT Solutions Pvt Ltd </a><time>Monday, 02 june 2016</time>
                                            <span class="people_des">IT Company at <a href="">Noida, IN</a></span>
                                            <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI
                                                <img src="images/people/p2.jpg" class="img-responsive" alt="">
                                            </p>
                                            <ul class="post-soc">
                                                <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                                                <li><i class="glyphicon glyphicon-pencil"></i><span>Reply</span></li>
                                            </ul>
                                            <div class="post-cmnt clearfix">
                                                <ul class="post-list clearfix">
                                                    <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                                    <li class="post-name"> 
                                                        <p class="form-control cmnt_p" contenteditable="true" required=""></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <span class="dropdown">
                                            <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown">
                                            </span>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a class="pointer"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="pointer"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </span>
                                    </ul>
                                </div>
                                <div class="post-cmnt clearfix">
                                    <ul class="post-list clearfix">
                                        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                        <li class="post-name"> 
                                            <p class="form-control cmnt_p" contenteditable="true" required=""></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
               <div class="col-md-3 about_box">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5>Followers <a href="{{ URL::to('company/followers/'.$company->uid.'/'.$all) }}" class="pull-right">See All</a></h5>
                            <ul id="sources-list">
                                <?php
                                $followerCompCount=0;
                                ?>
                                @foreach($getFollowersCompanyList as $follow)
                                <li>
                                    <div class="sources-img">
                                        
                                        <?php if($follow->image) {?>
                                            <td><img src="{{ URL::to('userimages/user_'.$follow->followingUser.'/medium/'.$follow->image ) }}" class="img-responsive" alt=""></td>
                                            <?php } else { ?>
                                            <td><img src="{{ URL::to('/images/user.png')}}"></td>
                                            <?php } ?>
                                        </div>
                                    <div class="sources-item">
                                        <div class="comp_name"><a href="{{ URL::to('showcompany/'.$follow->followingUser) }}">{{$follow->name}} </a></div>
                                        <div class="comp_add"><a href="{{ URL::to('showcompany/'.$follow->followingUser) }}">{{$follow->city}} </a></div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active" style="width:70px;"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                   <button class="followbtn" onclick="doFollow('{{ URL::to('followcompany/'.$follow->followingUser) }}',this)">@if($follow->alreadyFollowing=="1")Following @else Follow @endif</button>
                                </li>
                                <?php
                                $followerCompCount++;
                                if($followerCompCount==4)
                                    break;
                                ?>
                                @endforeach
                                
                            </ul>
                            <ul id="people-list">
                                <?php
                            $followerUserCount=0;
                            ?>
                            @foreach($getFollowersUserList as $follow)
                                <li>
                                    <div class="people-img">
                                        <?php if($follow->image) {?>
                                            <td><img src="{{ URL::to('userimages/user_'.$follow->followingUser.'/medium/'.$follow->image ) }}" class="img-responsive" alt=""></td>
                                            <?php } else { ?>
                                            <td><img src="{{ URL::to('/images/user.png')}}"></td>
                                            <?php } ?>
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name"><a href="{{ URL::to('user/profile/'.$follow->followingUser) }}">{{$follow->fname}}  {{$follow->lname}} </a></div>
                                        <div class="people_des"><a href="{{ URL::to('user/profile/'.$follow->followingUser) }}">{{$follow->designation}} </a></div>
                                        <div class="pcmp_name"><a href="{{ URL::to('user/profile/'.$follow->followingUser) }}">{{$follow->user_company}} </a></div>
                                        
                                    </div>
                                    <button class="followbtn" onclick="doFollow('{{ URL::to('followuser/'.$follow->followingUser) }}',this)">@if($follow->alreadyFollowing=="1")Following @else Follow @endif</button>
                                </li>
                                <?php
                                $followerUserCount++;
                                if($followerUserCount==4)
                                    break;
                                ?>
                                @endforeach
                            </ul>
                        </div>
                    </div>		      
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5>Following <a href="{{ URL::to('company/followings/'.$company->uid.'/'.$all) }}" class="pull-right">See All</a></h5>
                            <ul id="sources-list">
                                <?php
                                $followingUserCount=0;
                                ?>
                                @foreach($getFollowingsCompanyList as $following)
                                <li>
                                    <div class="sources-img">
                                        <?php if($following->image) {?>
                                            <td><img src="{{ URL::to('userimages/user_'.$following->followingUser.'/medium/'.$following->image ) }}" class="img-responsive" alt=""></td>
                                            <?php } else { ?>
                                            <td><img src="{{ URL::to('/images/user.png')}}"></td>
                                            <?php } ?> 
                                    </div>
                                    <div class="sources-item">
                                        <div class="comp_name"><a href="{{ URL::to('showcompany/'.$following->followingUser) }}">{{$following->name}} </a></div>
                                        <div class="comp_add"><a href="{{ URL::to('showcompany/'.$following->followingUser) }}">{{$following->city}}</a></div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active" style="width:70px;"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                   <button class="followbtn" onclick="doFollow('{{ URL::to('followcompany/'.$following->followingUser) }}',this)">@if($following->alreadyFollowing=="1")Following @else Follow @endif</button>
                                </li>
                                <?php
                                $followingUserCount++;
                                if($followingUserCount==4)
                                    break;
                                ?>
                                @endforeach
                            </ul>
                            <ul id="people-list">
                               @foreach($getFollowingsUserList as $following)
                                <li>
                                    <div class="people-img">
                                        <?php if($following->image) {?>
                                            <td><img src="{{ URL::to('userimages/user_'.$following->followingUser.'/medium/'.$following->image ) }}" class="img-responsive" alt=""></td>
                                            <?php } else { ?>
                                            <td><img src="{{ URL::to('/images/user.png')}}"></td>
                                            <?php } ?>
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->fname}}  {{$following->lname}} </a></div>
                                        <div class="people_des"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->designation}} </a></div>
                                        <div class="pcmp_name"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->user_company}} </a></div>
                                        
                                    </div>
                                    <button class="followbtn" onclick="doFollow('{{ URL::to('followuser/'.$following->followingUser) }}',this)">@if($following->alreadyFollowing=="1")Following @else Follow @endif</button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 about_box">
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Working Day</h5> 
                            <p>Mon-Fri 10:00 to 07:00</p>  
                            <p>Saturday 10:00 to 02:00</p>  
                            <p>Weekly Sunday off</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Advertisement</h5>     
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Sponsored Bussiness</h5>     
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Sponsored Jobs</h5>
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Sponsored Event</h5>
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">
                            <p>Responding to customer needs through innovative product design, quality manufacturing and excellent value is, and always has been , the primary focus at Arcadia.</p>
                        </div>
                    </div>
                    <div class="row">
                        @include("include.footer_login") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End sources Section -->
<script type="text/javascript">
    
    $(document).ready(function(){
        <?php if( count ($errors->update) > 0) : ?>
            activaTab("profile");
        <?php endif ?>    
    });
    
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
    
    $(document).ready(function() {
 
  $(".clients").owlCarousel({
        pagination: false,
        navigation : true,
        slideSpeed : 2500,
		stopOnHover: true,
    	autoPlay: 3000,
    	singleItem:false,
        itemsMobile : [550,1],
        itemsDesktopSmall : [991,2],
        items: 5,
		transitionStyle : "fade",
		navigationText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>']
  });
 
});

//SHOW MORE LINK

$(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});

// SHOW MORE LINK SCRIPT END

function getAllImages(link,tabId){
    $.get(link,function(data){
        $("#"+tabId).html(data);
    });
}

function getGallery(link){
    
    $.get(link,function(data){
        $("#portfolio").html(data);
    });
}

</script>

@endsection
