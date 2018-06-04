
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
        
        
        
        <div id="timelineContainer" class="container-fluid no-gutter">
    <div class="col-md-12 no-gutter">
        <div id="timelineBackground" class="row uprofilecover">
            <img id="timelineBGload1" src="{{$coverPic}}"/>
            <span class="imgicon"> 
        <input type="button" value="Upload Cover" style="background: #ccc; border: none; padding-left: 30px;">
        <span class="glyphicon glyphicon-camera dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="width: 100%; background: none; padding-left: 5px;"> 
        </span>
        <ul class="dropdown-menu dropdown-menu-right" style="bottom: 130%; top:auto;">
          <li> <a class="pointer">Upload Picture
            <form id="bgimageform" method="post" enctype="multipart/form-data" action="{{ URL::to('company/updatecover')}}">
              <input class="token" name="_token" type="hidden" value="{{  csrf_token() }}">
              <input type="file" name="cover" id="bgphotoimg1" class=" custom-file-input" original-title="Change Cover Picture" onchange="return showPreview('timelineBGload1', this)" style="position:absolute; top:5px;">
            </form>
            </a> </li>
          <li> <a onclick="rearrangePic()" class="pointer">Reposition</a> </li>
        </ul>
        </span> 
        </div>
        <div id="load_banner" class="load_banner" style="display:none;"> <img src="{{ URL::to('images/loading_new.gif') }}"> </div>
    </div>
  </div>
        
        
        
        
        
        <!--<div class="row uprofilecover">
            <img id="cover_pic_img" src="{{$coverPic}}"/>
            <a id="uX1" onclick="updatePosition()" class="bgSave wallbutton blackButton">Save Cover</a>
            <span class="imgicon"> 
                <span class="glyphicon glyphicon-camera"></span>
                <input type="file" name="cover" id="cover_pic" required="">
            </span>
        </div>-->			

        <div class="container no-gutter">	
            <div class="row">
                <div class="uprofile clearfix">
                    
                    
                    <div class="uprofilepic">
                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div id='profile_pic_place'>
                            
                        <img class="img-responsive" id="blah"  src="{{ $profilePic }}">
                        
                        </div>
                     
                        <span class="imgicon"> 
                            <span class="glyphicon glyphicon-camera"></span>
                            <input type="file" name="profile" id="image_src" required>
                        </span>
                        <button class='btn-xs' id='picc' style="display:none;" onclick='return myPic(event)'>Save</button>
                        <div id="load_profile" class="loding" style="display:none;">
                            <span class="load_img"> <img src="{{URL::to("images/loading_new.gif")}}"></span> 
                        </div>
                        
                    </form>
                    
                    </div>
                    
                    
                    
                    <!--<div class="uprofilepic">
                        
                        
                        <img id="profile_pic" src="{{ $profilePic }}">
                        
                        <span class="imgicon"> 
                            <span class="glyphicon glyphicon-camera"></span>
                            <input type="file" name="file" id="" required="">
                        </span>
                    
                    </div>-->
                    <div class="uprodetail clearfix">
                        <div class="uproname">                            
                            <div class="uprofilename">{{ $company->company_name }}</div>	
                            <div class="uprofiledes">{{ $company->company_type }}</div>	
                            <div class="uprofilecomp"> @if($company->company_state || $company->country) at <a href="">{{ $company->company_state }}, {{ $company->country }}</a> @endif</div>	
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
                            <!--<div class="col-lg-12 no-gutter">
                                <button class="skybtn">Message</button>
                                <button class="skybtn">Follow</button>
                            </div>-->
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
                    <a href="{{ URL::to("service/showadd") }}"><h4>Our Services <span class="pull-right skybtn">Add Services</span></h4></a>
                    <div class="clients services">
                        
                        
                        
                        @if( count($services) > 0 )
                        
                        @foreach($services as $service)
                        <div class="col-md-12">
                           <a href="{{ URL::to("company/servicedetail/".$service->id) }}">
                           <img src="{{URL::to('images/services/'.$service->image)}}" class="img-responsive" alt="...">
                           <h4>{{$service->service_title}}</h4></a>
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-12">
                            <h4>You can add your company's services here</h4>
                        </div>
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
                        
                         <li><a data-toggle="tab" href="#vcards">
                                <i class="icon-profile"></i><span>vLetters</span>
                                
                             </a>
                             @if( count($pendingCards) > 0)
                                <span class="badge">{{ count($pendingCards) }}</span>
                                @endif 
                         </li>
                                
                        <li><a data-toggle="tab" href="#bookmark">
                                <i class="icon-bookmarks"></i><span>Bookmarks</span></a></li>
                        <li><a data-toggle="tab" href="#profile">
                                <i class="icon-user"></i><span>Profile</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="col-md-12 no-gutter tab-pane fade in active" id="trending">

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
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/3") }}','portfolio')">Profile Pics</h4>
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
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/4") }}','portfolio')" >Cover Pics</h4>
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
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/2") }}','portfolio')">Services</h4>
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
                                                <h4 class="pointer" onclick="getAllImages('{{ URL::to("getgalleryimages/1") }}','portfolio')">Uploads</h4>
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
                               @foreach($staff as $user) 
                               <?php
                               if( empty($user->img) ){
                                   $profilePic = URL::to("images/user.png");
                               }else{
                                   $profilePic = URL::to("userimages/user_".$user->uid."/medium/".$user->img);
                               }
                               ?>
                               <li>
                                    <div class="people-img">
                                        <img src="{{ $profilePic }}" class="img-responsive" alt="">
                                    </div>
                                    <div class="people-item">
                                        <div class="people_name">{{$user->fname}}</div>
                                        <div class="people_des">{{$user->pres_desg}}</div>
                                        <!--<div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>-->
                                        <div class="people_add">{{ $user->city }},{{ $user->company }}</div>
                                    </div>
                                    <!--<button class="followbtn">Follow</button>-->
                               </li>
                               @endforeach
                                
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
                                
                            </ul>
                        </div>

                        <div class="col-md-12 tab-pane fade about_box" id="ad">
                            <?php /*include("include/come_in.php")*/ ?>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="vcards">
                            @include("include.vletter")
                        </div>

                        <div class="col-md-12 no-gutter tab-pane fade" id="bookmark">
                           
                            @foreach($bookmarks as $post)
                                @include('posts.post')
                            @endforeach

                        </div>

                        <div class="col-md-12 tab-pane fade" id="profile">
                            <div class="pro-text">

                                <h3>Basic Information</h3>
                                <form method="POST" action="{{ URL::to('company/update') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Company Name</label>

                                                <?php $companyName = (count($company->company_name) > 0) ? $company->company_name : old('company_name') ?>

                                            <input type="text" value="{{ $companyName }}" name="company_name" class="form-control error" placeholder="Company Name *">
                                            @if ($errors->update->has('company_name')) <p class="help-block text-danger">{{ $errors->update->first('company_name') }}</p> @endif
                                        </div> 
                                        <div class="col-md-6">
                                            <label>Incorporation Date</label>
                                            <?php $incorporationDate = (count($company->incorporation_date) > 0) ? $company->incorporation_date : old('incorporation_date') ?>
                                            <input name="incorporation_date" value="{{ $incorporationDate }}"type="date" format="YYYY-MM-DD" class="form-control" placeholder="eg: 1992-12-24">
                                            @if ($errors->update->has('incorporation_date')) <p class="help-block text-danger">{{ $errors->update->first('incorporation_date') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label>City</label>
                                            <?php $companyCity = (count($company->company_city) > 0) ? $company->company_city : old('company_city') ?>
                                            <input name="company_city" value="{{ $companyCity }}"type="text" class="form-control" placeholder="City *">
                                            @if ($errors->update->has('company_city')) <p class="help-block text-danger">{{ $errors->update->first('company_city') }}</p> @endif
                                        </div>
                                        <div class="col-md-2"><label>State</label>
                                            <?php $companyState = (count($company->company_state) > 0) ? $company->company_state : old('company_state') ?>
                                            <input name="company_state" value="{{ $companyState }}" type="text" class="form-control" placeholder="State *">
                                            @if ($errors->update->has('company_state')) <p class="help-block text-danger">{{ $errors->update->first('company_state') }}</p> @endif
                                        </div>                                           
                                        <div class="col-md-2"><label>Zip</label>
                                            <?php $companyZip = (count($company->company_zip) > 0) ? $company->company_zip : old('company_zip') ?>
                                            <input name="company_zip" value="{{ $companyZip }}" type="text" class="form-control" placeholder="Zip *">
                                            @if ($errors->update->has('company_zip')) <p class="help-block text-danger">{{ $errors->update->first('company_zip') }}</p> @endif
                                        </div>
                                        <div class="col-md-2"><label>Country</label>
                                            <?php $companyCountry = (count($company->country) > 0) ? $company->company_state : old('country') ?>
                                            <input name="country" value="{{ $company->country }}" type="text" class="form-control" placeholder="Country *">
                                            @if ($errors->update->has('country')) <p class="help-block text-danger">{{ $errors->update->first('country') }}</p> @endif
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><label>Phone Number</label>
                                            <?php $contactNumber = (count($company->contact_number) > 0) ? $company->contact_number : old('contact_number') ?>
                                            <input type="text" value="{{ $contactNumber }}" name="contact_number" class="form-control" placeholder="Phone Number *">
                                            @if ($errors->update->has('contact_number')) <p class="help-block text-danger">{{ $errors->update->first('contact_number') }}</p> @endif
                                        </div> 
                                        <div class="col-md-6"><label>Email Id</label>
                                            <?php $contactEmail = (count($company->contact_email) > 0) ? $company->contact_email : old('contact_email') ?>
                                            <input name="contact_email" value="{{ $company->contact_email }}" type="text" class="form-control" placeholder="Email Id *">
                                            @if ($errors->update->has('contact_email')) <p class="help-block text-danger">{{ $errors->update->first('contact_email') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><label>Primary Track (Select up to two)</label></div> 
                                        <div class="col-md-12"><p>*Helps other users find you in the People Search</p></div>
                                        <div class="col-md-12  form-group">
                                            <div class="col-md-6">
                                                <div><input type="checkbox"> Administrator</div>
                                                <div><input type="checkbox"> Architect/ Designer</div>
                                                <div><input type="checkbox"> Information Technology</div>
                                                <div><input type="checkbox"> Dealer</div>
                                                <div><input type="checkbox"> Facility Manager</div>
                                                <div><input type="checkbox"> Health & Safety</div>
                                                <div><input type="checkbox"> Human Resources</div>
                                                <div><input type="checkbox"> Installer/Mover</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div><input type="checkbox"> Manufacturer</div>
                                                <div><input type="checkbox"> Marketing</div>
                                                <div><input type="checkbox"> Purchasing</div>
                                                <div><input type="checkbox"> Representatives</div>
                                                <div><input type="checkbox"> Sales</div>
                                                <div><input type="checkbox"> Shop</div>
                                                <div><input type="checkbox"> Tech Support</div>
                                                <div><input type="checkbox"> Other</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12  form-group">
                                            <label>About Us</label>
                                            <?php $aboutUs = (count($company->about_us) > 0) ? $company->about_us : old('about_us') ?>
                                            <textarea name="about_us" class="form-control" placeholder="Your Messages *"  style="height:150px;">{{ $aboutUs }}</textarea>
                                            @if ($errors->update->has('about_us')) <p class="help-block text-danger">{{ $errors->update->first('about_us') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12  form-group center" style="text-align:center;">
                                            <input type="submit" class="btn btn-primary" value="Update Profile" name="submit">
                                        </div>
                                    </div>
                                </form>    
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
                                        <div class="comp_add"><a href="{{ URL::to('showcompany/'.$following->followingUser) }}">{{$following->city}} </a></div>
                                        <div class="star_review">
                                            <div class="star_disabled"></div>
                                            <div class="star_active" style="width:70px;"></div>
                                        </div>
                                        <div class="comp_name"></div>
                                    </div>
                                   <button class="followbtn" onclick="doFollow('{{ URL::to('followcompany/'.$following->followingUser) }}',this)">Following</button>
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
                                        <div class="people_name"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->fname}}  {{$following->lname}}</a></div>
                                        <div class="people_des"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->designation}} </a></div>
                                        <div class="pcmp_name"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->user_company}} </a></div>
                                        
                                    </div>
                                    <button class="followbtn" onclick="doFollow('{{ URL::to('followuser/'.$following->followingUser) }}',this)">Following</button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-3 about_box">
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Post Your Jobs Free...</h5>
                            <button class="skybtn form-control" data-toggle="modal" data-target="#postjob"> Post Jobs Free !!!</button>
                        </div>
                    </div>
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
                            <h5>Approval for Employment</h5> 
                            <table class="table table-striped tbl_list">
                                <tbody>
                                    
                                    @foreach($approvels as $user)
                                    <?php
                                    if( empty($user->img) ){
                                        $profilePic = URL::to("images/user.png");
                                    }else{
                                        $profilePic = URL::to("userimages/user_".$user->uid."/medium/".$user->img);
                                    }
                                    ?>
                                    <tr>
                                        <td><img src="{{ $profilePic }}" alt="..."></td>
                                        <td>
                                            <div class="people_name">{{ $user->fname }}</div>
                                            <div class="people_des">{{ $user->pres_desg }}</div>	
                                        </td>
                                        <td style="text-align:right;">
                                            <a href="{{ URL::to("approve/".$user->apr_id) }}" class="btn btn-primary">Approve</a>
                                        </td>
                                    </tr>
                                  
                                    @endforeach                                    
                                    
                                </tbody>								
                            </table>
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
                        @include("include.footer_login")
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
</section>

@include("include.postjobs")
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



function readPicURL(input,id)
{

if (input.files && input.files[0])
{
    var reader = new FileReader();

    reader.onload = function (e) {

        $('#'+id).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
document.getElementById('picc').style.display='block';
}



$("#image_src").change(function(e){
  readPicURL(this,"blah");
});


$("#cover_pic").change(function(e){
  readPicURL(this,"cover_pic_img");
});


function myPic(e){
e.preventDefault();

/*$(".img-para").append("<img src='{{url::to('images/loading.gif')}}' style='width:40%;' id='ldimg'/>");*/
var formData = new FormData(document.getElementById("uploadimage"));


document.getElementById('picc').style.display='none';

$('#profile_pic_place').addClass('banner');

document.getElementById('load_profile').style.display='block';

$.ajax({
url: PROJECT_URL +"/company/updateprofile",      // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: formData,           // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
//document.write(data);
  document.getElementById('picc').style.display='none';

  $('#profile_pic_place').removeClass('banner');
  document.getElementById('load_profile').style.display='none';
},
error: function(xhr)
{
  document.write(xhr.responseText);
}
});

}



function showPreview(preview_place,thisone){
    
try {
var files = !!thisone.files ? thisone.files : [];

if (!files.length || !window.FileReader){
  return;
}
     // no file selected, or no FileReader support

if (/^image/.test(files[0].type)) {// only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file

    reader.onloadend = function () { // set image data as background of div
        //$("#imagePreview").css("background-image", "url("+this.result+")");
        $("#"+preview_place).attr("src", this.result);
        $("#"+preview_place).addClass('headerimage ui-corner-all ui-draggable');
        //$('#'+preview_place).attr('css','margin-top:0px;');
        
        document.getElementById(preview_place).style.marginTop='0px';
        $(document.getElementById(preview_place).parentNode).append('<a id="uX1" onclick="updateImage()" class="bgSave wallbutton blackButton">Save Cover</a>');
    }
 }

} catch (e) {

}



}

function updateImage(){
$('#timelineBackground').addClass('banner');
document.getElementById('load_banner').style.display='block';
var position = $('#timelineBGload1').css('top');
var file = document.getElementById('bgphotoimg1').files[0];

var formData = new FormData();
formData.append('cover', file);
formData.append('position',position);
formData.append('_token',$('.token').val());

document.getElementById('uX1').parentNode.removeChild(document.getElementById('uX1'));

var action=$("#bgimageform").attr('action');



//$(document.getElementById('timelineContainer')).append('<img style="max-height:100px; max-width:500px;" src="<?php echo URL::to('images/loading.gif') ?>" id="loading_image" >');

$.ajax({

  url : action,
  type: "POST",
  cache: false,
  contentType: false,
  processData: false,
  data : formData,
  success: function(response){
     
    $('#timelineBackground').removeClass('banner');

    document.getElementById('load_banner').style.display='none';


  },
  error: function(e){
     
          document.write(e.responseText);
  }
});

}


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


function approveCard(thisone){

    $.get(thisone.id,function(status){
       
        if(status.success){
            $(thisone).html("Approved");
        }
        
    });
}

function rejectCard(thisone){
    
      $.get(thisone.id,function(status){
        
        if(status.success){
            thisone.parentNode.parentNode.parentNode.removeChild(thisone.parentNode.parentNode);
        }
        
    });
}

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
// SHOW MORE LINK SCRIPT END

</script>

@endsection
