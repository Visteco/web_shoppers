@extends('layouts.authorised')
@section('content')
<?php 
$all='all';
$followersC=count($getFollowersCompanyList);
$followersU=count($getFollowersUserList);
$followersTotal=$followersC+$followersU;
?>


@foreach($userRecord as $userdata)
<?php 
$userImg = $userdata->img;
$userID = $userdata->uid;
$fname = $userdata->fname;
$lname = $userdata->lname;
if($lname)
    $fullname=$fname." ".$lname;
else
    $fullname=$fname;
$designation = $userdata->pres_desg;
$previousDesignation = $userdata->prev_org;
$organisation=$userdata->pres_org;
$phoneNumber=$userdata->contact;
$emailID=$userdata->email;
$summary=$userdata->sumry;
$websiteLink=$userdata->website;
$coverPic=$userdata->background_img;
$city=$userdata->city;
$state=$userdata->state;
$country=$userdata->country;
$poscode=$userdata->poscode;
$primaryWorkFields=$userdata->primaryWorkFields;
$WorkFields = explode(',', $primaryWorkFields);
//echo $WorkFields[1];
//if (in_array(" Other", $WorkFields)) echo 'checked';die;
//print_r($WorkFields);
//print_r($WorkFields);  die;
?>
@endforeach

<section class="profile-section">
    <div class="container-fluid">
        <div id="timelineContainer" class="container-fluid no-gutter">
    <div class="col-md-12 no-gutter">
        <div id="timelineBackground" class="row uprofilecover">
            <img id="timelineBGload1" src="{{ URL::to('public/userimages/user_'.$userID.'/profile_background/'.$coverPic ) }}"/>
            <span class="imgicon"> 
        <input type="button" value="Upload Cover" style="background: #ccc; border: none; padding-left: 30px;">
        <span class="glyphicon glyphicon-camera dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="width: 100%; background: none; padding-left: 5px;"> 
        </span>
        <ul class="dropdown-menu dropdown-menu-right" style="bottom: 130%; top:auto;">
          <li> <a class="pointer">Upload Picture
            <form id="bgimageform" method="post" enctype="multipart/form-data" action="{{ URL::to('upusrbgimage')}}">
              <input class="token" name="_token" type="hidden" value="{{  csrf_token() }}">
              <input type="file" name="photoimg" id="bgphotoimg1" class=" custom-file-input" original-title="Change Cover Picture" onchange="return showPreview('timelineBGload1', this)" style="position:absolute; top:5px;">
            </form>
            </a> </li>
          <li> <a onclick="rearrangePic()" class="pointer">Reposition</a> </li>
        </ul>
        </span> 
        </div>
        <div id="load_banner" class="load_banner" style="display:none;"> <img src="{{ URL::to('public/images/loading_new.gif') }}"> </div>
    </div>
  </div>

 
 <div class="container no-gutter">
            <div class="row">
                <div class="uprofile clearfix">
                    
                    <div class="uprofilepic">
                    <form id="uploadimage" action="" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}
                        <div id='profile_pic_place'>
                       @if($userImg != '') <img class="img-responsive" id="blah" src="{{URL::to('public/userimages/user_'.$userID.'/medium/'.$userImg)}}">
                       @else <img class="img-responsive" id="blah" src="{{ URL::to('/images/user.png')}}"> @endif </div>
                        <span class="imgicon"> 
                            <span class="glyphicon glyphicon-camera"></span>
                            <input type="file" name="image_src" id="image_src" required>
                        </span>
                        <button class='btn-xs' id='picc' style="display:none;" onclick='return myPic(event)'>Save</button>
                    <div id="load_profile" class="loding" style="display:none;">
                        <span class="load_img"> <img src="{{ URL::to('public/images/postloader.gif')}}"></span> 
                    </div>
                    </form>
                       </div>
                    
              
                    <div class="uprodetail clearfix">
                        <div class="uproname">                    
                            <div class="uprofilename">{{$fname}} {{$lname}}</div>	
                            <div class="uprofiledes">{{$designation}}</div>	
                            <div class="uprofilecomp"> @if($websiteLink!='') at <a href="{{$websiteLink}}">  {{$organisation}}</a> @endif</div>
                            <div class="uprofilecomp comment more">{{$summary}}</div>
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
                        </div>
                    </div>
                    <div class="follow_count"><h2>{{$followersTotal}}</h2><p>Followers</p></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs profile-tab">
                        <li @if($displayLI!='userProfileDisplay') class="active" @endif><a data-toggle="tab" href="#trending">
                                <i class="icon-stats-dots"></i><span>Trending</span></a></li>
                        <!--<li><a data-toggle="tab" href="#portfolio" onclick="getGallery('{{ URL::to("getgallery") }}')">
                                
                                <i class="icon-images"></i><div displayGalleryFolder()"><span>Gallery</span></div></a></li>-->
                                
                                
                        <li>
                           <a data-toggle="tab" href="#portfolio" onclick="getGallery('{{ URL::to("getgallery/$userID") }}')">
                                <i class="icon-images"></i><span>Gallery</span>
                            </a>
                        </li>     
                                
                                
                                
                        <!--<li><a data-toggle="tab" href="#ad">
                                <i class="icon-bullhorn"></i><span>Ad Board</span></a></li>-->
                         <li><a data-toggle="tab" href="#vcards">
                                <i class="icon-profile"></i><span>V Cards</span>
                                
                             </a>
                             @if( count($pendingCards) > 0)
                                <span class="badge">{{ count($pendingCards) }}</span>
                                @endif 
                         </li>
                        <li><a data-toggle="tab" href="#bookmark">
                                <i class="icon-bookmarks"></i><span>Bookmarks</span></a></li>
                        <li @if($displayLI=='userProfileDisplay') class="active" @endif><a data-toggle="tab" href="#profile">
                                <i class="icon-user"></i><span>Profile</span></a></li>
                    </ul>
                    <div class="tab-content">
                       
                        <div  @if($displayLI=='userProfileDisplay') class="col-md-12 no-gutter tab-pane fade" @else class="col-md-12 tab-pane fade in active" @endif id="trending">
                            @foreach($trendingPosts as $post)
                                @include('posts.post')
                            @endforeach

                            

                        </div>
                        


                        <div class="col-md-12 tab-pane fade" id="portfolio">
                            @include('posts.galleries')
                        </div>

                        <div class="col-md-12 tab-pane fade" id="ad">

                        </div>

                        <div class="col-md-12 tab-pane fade" id="vcards">
                            @include("include.vcard")
                        </div>

                        <div class="col-md-12 tab-pane fade" id="bookmark">
                            @foreach($bookmarks as $post)
                                @include('posts.post')
                            @endforeach
                        </div>

                        <div @if($displayLI=='userProfileDisplay') class="col-md-12 tab-pane fade in active" @else class="col-md-12 tab-pane fade" @endif  id="profile">
                            <div class="pro-text">
                                @if($status)
                                    @if($status=='Successfully Updated!')
                                    <div class="alert alert-success">
                                        {{ $status }}
                                    </div>
                                    @else
                                    <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>{{ $status }}</strong>
                                    </div>
                                    @endif
                                @endif
                          <h3>Basic Information</h3>
                                <form name="userProfile" method="POST" id="userProfile" action="{{ URL::to('userProfile') }}" onsubmit="return validateProfileInfo()" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                                <div class="row">
                                
                                    <div class="col-md-12"><label>Name</label>
                                        
                                        <input type="text" class="form-control" placeholder="Your Name *" id="firstName" name="firstName" @if($fname != '') value="{{trim($fullname)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                    <!--<div class="col-md-6"><label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Your Last Name *" id="lastName" name="lastName" @if($lname != '') value="{{trim($lname)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Job Title</label>
                                        <input type="text" class="form-control" placeholder="Job Title *" id="jobTitle" name="jobTitle" @if($designation != '') value="{{trim($designation)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <input type="hidden" id="company_uid" name="company_uid" value="0" >
                                    <div class="col-md-6"><label>Company/School Name</label>
                                        <input id="company_name_id" oninput="getSuggestion(this,'{{ URL::to('suggestcompany/') }}','suggestion_id2')" type="text" class="form-control" placeholder="Company/School Name *" id="companyName" name="companyName" @if($organisation != '') value="{{trim($organisation)}}" @endif>
                                        <div class="suggestion">
                                            <ul id="suggestion_id2" class="list-group"></ul>
                                        </div>       
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">       
                                    <div class="col-md-6"><label>City</label>
                                        <input type="text" class="form-control" placeholder="City *" id="city" name="city" @if($city != '') value="{{trim($city)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="col-md-2"><label>State</label>
                                        <input type="text" class="form-control" placeholder="State *" id="state" name="state" @if($state != '') value="{{trim($state)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>                                           
                                    <div class="col-md-2"><label>Zip</label>
                                        <input type="text" class="form-control" placeholder="Zip *" id="zip" name="zip" @if($poscode != '') value="{{trim($poscode)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="col-md-2"><label>Country</label>
                                        <input type="text" class="form-control" placeholder="Country *" id="country" name="country" @if($country != '') value="{{trim($country)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Phone Number *" id="phNumber" name="phNumber" @if($phoneNumber != '') value="{{trim($phoneNumber)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                    <div class="col-md-6"><label>Email Id</label>
                                        <input type="text" class="form-control" placeholder="Email Id *" id="emailId" name="emailId" @if($emailID != '') value="{{trim($emailID)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><label>Primary Work (Select up to two)</label></div> 
                                    <div class="col-md-12"><p>*Helps other users find you in the People Search</p></div>
                                    <div class="col-md-12  form-group">
                                        
                                        <div class="col-md-6">
                                            <div><input type="checkbox" name="check1" id="check1" value="Administrator" <?php if (in_array("Administrator", $WorkFields)) echo 'checked' ?>> Administrator</div>
                                            <div><input type="checkbox" name="check2" id="check2" value="Architect/Designer" <?php if (in_array("Architect/Designer", $WorkFields)) echo 'checked' ?>> Architect/Designer</div>
                                            <div><input type="checkbox" name="check3" id="check3" value="CEO" <?php if (in_array("CEO", $WorkFields)) echo 'checked' ?>> CEO</div>
                                            <div><input type="checkbox" name="check4" id="check4" value="Dealer" <?php if (in_array("Dealer", $WorkFields)) echo 'checked' ?>> Dealer</div>
                                            <div><input type="checkbox" name="check5" id="check5" value="Facility Manager" <?php if (in_array("Facility Manager", $WorkFields)) echo 'checked' ?>> Facility Manager</div>
                                            <div><input type="checkbox" name="check6" id="check6" value="Health & Safety" <?php if (in_array("Health & Safety", $WorkFields)) echo 'checked' ?>> Health & Safety</div>
                                            <div><input type="checkbox" name="check7" id="check7" value="Human Resources" <?php if (in_array("Human Resources", $WorkFields)) echo 'checked' ?>> Human Resources</div>
                                            <div><input type="checkbox" name="check8" id="check8" value="Installer/Mover" <?php if (in_array("Installer/Mover", $WorkFields)) echo 'checked' ?>> Installer/Mover</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div><input type="checkbox" name="check9" id="check9" value="Manufacturer" <?php if (in_array("Manufacturer", $WorkFields)) echo 'checked' ?>> Manufacturer</div>
                                            <div><input type="checkbox" name="check10" id="check10" value="Marketing" <?php if (in_array("Marketing",$WorkFields)) echo 'checked' ?>> Marketing</div>
                                            <div><input type="checkbox" name="check11" id="check11" value="Purchasing" <?php if (in_array("Purchasing", $WorkFields)) echo 'checked' ?>> Purchasing</div>
                                            <div><input type="checkbox" name="check12" id="check12" value="Representatives" <?php if (in_array("Representatives", $WorkFields)) echo 'checked' ?>> Representatives</div>
                                            <div><input type="checkbox" name="check13" id="check13" value="Sales" <?php if (in_array("Sales", $WorkFields)) echo 'checked' ?>> Sales</div>
                                            <div><input type="checkbox" name="check14" id="check14" value="Student" <?php if (in_array("Student", $WorkFields)) echo 'checked' ?>> Student</div>
                                            <div><input type="checkbox" name="check15" id="check15" value="Tech Support" <?php if (in_array("Tech Support", $WorkFields)) echo 'checked' ?>> Tech Support</div>
                                            <div><input type="checkbox" name="check16" id="check16" value="Other"  <?php if (in_array("Other",$WorkFields)) echo 'checked' ?> > Other</div>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="row">                
                                    <div class="col-md-12">
                                        <label>Previous Company / School</label>
                                        <input type="text" class="form-control" placeholder="DEF Industries" id="previousComName" name="previousComName" @if($previousDesignation != '') value="{{trim($previousDesignation)}}" @endif>
                                        <p class="help-block text-danger"></p>
                                    </div>                   
                                </div>
                                <div class="row">
                                    <div class="col-md-12  form-group">
                                        <label>About Us</label>
                                        <textarea class="form-control" placeholder="Your Messages *"  style="height:150px;" id="aboutUs" name="aboutUs"> @if($summary != '') {{trim($summary)}} @endif</textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  form-group center" style="text-align:center;">
                                        <input class="btn btn-primary" type="submit"  value="Update Profile" name="submit" />
                                        <!--<button class="btn btn-primary" id="saveProfile" name="saveProfile" >Update Profile</button>-->
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
                            <h5>Followers <a href="{{ URL::to('user/followers/'.$userID.'/'.$all) }}"  class= "pull-right" >See All</a></h5>
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
                                   <button class="followbtn" onclick="doFollow('{{ URL::to('followcompany/'.$follow->followingUser) }}',this)"> @if($follow->alreadyFollowing=="1")Following @else Follow @endif</button>
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
                                        <!--<div class="people_add">Noida, IN</div>-->
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
                            <h5>Following  <a href="{{ URL::to('user/followings/'.$userID.'/'.$all) }}" class="pull-right">See All</a></h5>
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
                                        <div class="people_name"><a href="{{ URL::to('user/profile/'.$following->followingUser) }}">{{$following->fname}}  {{$following->lname}} </a></div>
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
                            <h5>Advertisement</h5>     
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">

                        </div>
                    </div>
                    <!--
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
                    </div>-->
                    
                    <div class="row">
                          @include("include.footer_login")
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End sources Section -->
<script src="{{ URL::to('js/bootbox.min.js') }}"></script>
<script>

function validateProfileInfo()
{
    //alert('in javascript');
   
var firstName=document.userProfile.firstName.value;
var lastName=document.userProfile.lastName.value;
var jobTitle=document.userProfile.jobTitle.value;
var companyName=document.userProfile.companyName.value;
var city=document.userProfile.city.value;
var state=document.userProfile.state.value;
var country=document.userProfile.country.value;
var phNumber=document.userProfile.phNumber.value;
var emailId=document.userProfile.emailId.value;
var aboutUs=document.userProfile.aboutUs.value;
var num=isNaN(phNumber);
if(firstName=='')
    {
    alert('First Name can not be blanked');    
    return false;  
    }
else{
         var letters = /^[a-zA-Z ]*$/;  
	if(firstName.match(letters))  {  
            
            }  
	else{  
            alert('User  Name must have alphabet characters only');    
            return false;  
            }  
    }
if(lastName=='')
    {
    alert('Last Name can not be blanked');    
    return false;  
    }
else{
        var letters = /^[a-zA-Z ]*$/;  
	if(lastName.match(letters))  {  
            
            }  
	else{  
            alert('User Last Name must have alphabet characters only');    
            return false;  
            } 
    } 
    if(jobTitle=='' || companyName=='' || city=='' || state=='' || country=='')
    {
        alert("Profile Fields can not be blank");
        return false;
    } 
  if(phNumber=='')
  {
    alert('Contact Number can not be blanked');    
    return false;   
  }
  else
  {
   if(num==true)
   {
     alert('Contact Number should be numbers only');    
            return false;   
   }
  }
   if(emailID=='')
    {
    alert('email ID can not be blanked');    
    return false;  
    }
    else{
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailID))  
            {}  
            else
            {
            alert("You have entered an invalid email address!")  
             return false;
            }
    }
    if(aboutUs=='')
    {
        alert("You have to write few lines about yourself");
        return false;
    }
    
     
      
      
   
    
  
}

function valName(name)
{
    
	var letters = /^[a-zA-Z ]*$/;  
	if(name.match(letters))  
	{  
		return true;  
	}  
	else  
	{  
		alert('User First/Last Name must have alphabet characters only');    
		return false;  
	}  
	
}

function displayGallery(imageType)
{
    $.ajax({
         type: 'GET',
         url:"{{URL::to('/galleryImages')}}/"+imageType,
         success: function(data) {
            $("#portfolio").html(data);
         }
      });
}


function displayGalleryFolder()
{
    
    $.ajax({
         type: 'GET',
         url:"{{URL::to('/galleryFolder')}}",
         success: function(data) {
            $("#portfolio").html(data);
         }
      });
}

function getGallery(link){
    
    $.get(link,function(data){
        $("#portfolio").html(data);
    });
}

function getAllImages(link,tabId){
    $.get(link,function(data){
        $("#"+tabId).html(data);
    });
}

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


</script>



<input type="hidden" id="myid" name="usrd" value="{{ Auth::user()->id }}" />
<script type="text/javascript" src="{{url('public/js/userprofile.js')}}"></script>

@endsection



