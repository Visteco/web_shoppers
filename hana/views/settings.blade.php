@extends('layouts.authorised')
@include('adUpdateModal')
@include('listForBlockUserModal')
@section('content')
@foreach($userPrivacySetting as $data)
<?php $contact = $data->contact;
$post_Display = $data->PostDisplay;
//echo $contact."-".$post_Display;die;
?>
@endforeach
@foreach($userRecord as $userdata)
<?php 
$facebook = $userdata->facebook;
$twitter = $userdata->twitter;
$skype=$userdata->skype;
$googleplus=$userdata->googleplus;
$youtube=$userdata->youtube;
$linkedin=$userdata->linkedin;
$contact1=$userdata->contact;
$contact2=$userdata->contact2;
?>
@endforeach
<?php 
 if(session()->has('generalSetting'))
 echo "hiii";
 ?>
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-2 about_box">
                <div class="row">
                    <div class="col-lg-12 setting_tab shadow_box">
                        <ul>
                            <li @if(session()->has('generalSetting')) echo class="1st" @endif >General Settings </li>
                            <li @if(session()->has('securitySetting')) class="1st" @endif >Security Settings </li>
                            <li @if(session()->has('privacySetting')) class="1st" @endif >Privacy Settings </li>
                            <li @if(session()->has('manageBlockingSetting')) class="1st" @endif >Manage blocking </li>
                            <li @if(session()->has('mobileSetting')) class="1st" @endif >Mobile Settings</li>
                            <li @if(session()->has('socialLinksSetting')) class="1st" @endif >Social Links Settings </li>
                            <li @if(session()->has('advertisementAdd')) class="1st" @endif">Advertisement Add </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 about_box">
                <div class="row ">
                    <div @if(session()->has('generalSetting')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif>
                        <div class="pro_text">
                            <form method="post" action="{{ URL::to('/settings/resetpassword') }}">
                            {{ csrf_field() }}
                            <h3>General Account Settings</h3>
                            <div class="row">
                                
                                @if (Session::has('success'))
				    <div  class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
                                @if( Session::has('cerror'))
                                    <div class="alert alert-danger">{{ Session::get('cerror') }}</div>
                                @endif
                                <div class="col-md-12">
                                    <label>Change password</label>
                                    <p>
                                        It's a good idea to use a strong password that you don't use elsewhere</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <label>Current password</label>
                                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>                                            
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>New password</label>
                                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>                                            
                                <div class="col-md-6">
                                    <label>Retype New password</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-12">
                                    <input type="submit" class="skybtn" value="Submit">
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name </label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <input type="text" class="form-control" disabled placeholder="" value="Sarvesh Kumar Yadav">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Username </label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <input type="text" class="form-control" disabled placeholder="" value="sarveshyadavcs">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <h3>LANGUAGE SETTINGS</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Language do you want to use </label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>English</option>
                                        <option>Hindi</option>
                                        <option>Panjabi</option>
                                        <option>Bangla</option>
                                        <option>Marathi</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                           
                            
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Recognised Devices</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <input type="text" class="form-control" disabled placeholder="" value="Review which browsers you've saved as ones you often use.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your trusted contacts</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <input type="text" class="form-control" disabled placeholder="" value="Choose Followers who you can call to help you get back into your account if you are locked out.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Where You're Logged In</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                            
                                <div class="col-md-12">
                                    <input type="text" class="form-control" disabled placeholder="" value="Review and manage where you're currently logged in">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Deactivate your account</label>
                                    <p><a href="">Deactivate your account.</a></p>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div @if(session()->has('securitySetting')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif >
                    <form name="privacySetting" method="POST" id="privacySetting" action="{{ URL::to('settings/privacySetting') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}   
                        <div class="pro_text">
                            <h3>Privacy Settings</h3>
                            <div class="row">
                                @if (Session::has('successPrivacySetting'))
				    <div  class="alert alert-success">{{ Session::get('successPrivacySetting') }}</div>
				@endif
                                @if( Session::has('updateError'))
                                    <div class="alert alert-danger">{{ Session::get('updateError') }}</div>
                                @endif
                                <div class="col-md-12">
                                    <label>Who can see my stuff?</label>
                                    <i id="stuff" class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select name="stuffItem" id="stuffItem" class="form-control stuffItem" disabled="disabled">
                                        <option value="1" <?php if ($post_Display==1) echo 'selected="selected"'; ?>>Everyone</option>
                                        <option value="2" <?php if ($post_Display==2) echo 'selected="selected"'; ?>>Friends</option>
                                        <option  value="3" <?php if ($post_Display==3) echo 'selected="selected"'; ?>>Friend's Friends</option>
                                        <option  value="4" <?php if ($post_Display==4) echo 'selected="selected"'; ?>>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Who can contact me?</label>
                                    <i id="contactMe" class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select name="contactMeItem" id="contactMeItem" class="form-control contactMeItem" disabled="disabled">
                                        <option value="1" <?php if ($contact==1) echo 'selected="selected"'; ?>>Everyone</option>
                                        <option value="2" <?php if ($contact==2) echo 'selected="selected"'; ?>>Friends</option>
                                        <option value="3" <?php if ($contact==3) echo 'selected="selected"'; ?>>Friend's Friends</option>
                                        <option value="4" <?php if ($contact==4) echo 'selected="selected"'; ?>>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col-md-12">
                                    <label>Who can look me up?</label>
                                    <i id="lookMeUp" class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select name="lookMeUpItem" id="lookMeUpItem" class="form-control lookMeUpItem" disabled="disabled">
                                        <option>Everyone</option>
                                        <option>Friends</option>
                                        <option>Friend's Friends</option>
                                        <option>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>-->
                            <input class="btn btn-primary" type="submit" name="updateStuff" ID="updateStuff" value="Save Changes" name="submit" style='display:none;'/>
                        </div>	
                    </form>
                    </div>
                    <div @if(session()->has('manageBlockingSetting')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif>
                        <div class="pro_text">
                        <form name="blockSetting" method="POST" id="blockSetting" action="{{ URL::to('settings/blockSetting') }}" enctype="multipart/form-data">
                            {{ csrf_field() }} 
                            <h3>Manage blocking</h3>
                           <!-- <div class="row">
                                <div class="col-md-6">
                                    <label>Restricted List</label>
                                </div>                                           
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div> -->
                            <div class="row">
                               <div class="col-md-6">
                                    <label>Block users</label>
                                </div>                                           
                                <div class="col-md-4">
                                    <input id="blockUsers" name="blockUsers" type="text" class="form-control"  placeholder="">
                               </div>
                                <div class="col-md-2">
                                   <a data-toggle="modal" data-target="#blockuser" id='blockusers'  data-id=""> <input class="btn btn-primary" type="submit" name="updateBlockUser" ID="updateBlockUser" value="Block" name="submit" /></a>
                                    <p class="help-block text-danger"></p>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Block messages</label>
                                </div>                                          
                                <div class="col-md-4">
                                    <input id="blockMessages" name="blockMessages" type="text" class="form-control"  placeholder="">
                                 </div>
                                <div class="col-md-2">
                                    <input class="btn btn-primary" type="submit" name="updateBlockUser" ID="updateBlockUser" value="Block" name="submit" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <label>Block event invitations</label>
                                </div>                                            
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Block apps</label>
                                </div>                                            
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Block app invites</label>
                                </div>                                           
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>-->
                            <input class="btn btn-primary" type="submit" name="updateBlockUser" ID="updateBlockUser" value="Update" name="submit" style='display:none;'/>
                        </form>
                            <div class="col-md-12 tab-pane fade" id="blockUserDiv">
                            
                        </div>
                        </div>	
                    </div>
                    <div @if(session()->has('mobileSetting')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif>
                        <div class="pro_text">
                            <form name="mobileSetting" method="POST" id="mobileSetting" action="{{ URL::to('settings/mobileSetting') }}" enctype="multipart/form-data">
                            {{ csrf_field() }} 
                            <h3>Mobile Settings</h3>
                            <div class="row">
                                @if (Session::has('successmobileSetting'))
				    <div  class="alert alert-success">{{ Session::get('successmobileSetting') }}</div>
				@endif
                                @if( Session::has('updatemobileError'))
                                    <div class="alert alert-danger">{{ Session::get('updatemobileError') }}</div>
                                @endif
                                <div class="col-md-6">
                                    <label>Your phones</label>
                                </div>                                            
                                <div class="col-md-5">
                                    <input type="text" name="contact1" id="contact1" class="form-control" disabled placeholder="" @if($contact1 != '') value="{{trim($contact1)}}" @endif>
                                </div>
                                <div class="col-md-1">
                                   <i id="editcontact1" class="glyphicon glyphicon-pencil pull-right"></i>
                                   <p class="help-block text-danger"></p>
                                </div> 
                            </div>
                            <?php if($contact2==NULL)
                            {
                            ?>    
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Add another mobile phone number</label>
                                </div>                                            
                                <div class="col-md-5">
                                    <input type="text" name="newcontact" id="newcontact" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <?php }  
                            else { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Second Contact </label>
                                </div>                                            
                                <div class="col-md-5">
                                    <input type="text" name="contact2" id="contact2" class="form-control" disabled placeholder="" @if($contact2 != '') value="{{trim($contact2)}}" @endif>
                                </div>
                                <div class="col-md-1">
                                   <i id="editcontact2" class="glyphicon glyphicon-pencil pull-right"></i>
                                   <p class="help-block text-danger"></p>
                                </div> 
                            </div>
                            <?php } ?>
                           <input class="btn btn-primary" type="submit" name="updateMobile" ID="updateMobile" value="Save Changes" name="submit" @if($contact2!=NULL) style='display:none;' @endif/> 
                        </form>
                        </div>	
                    </div>
                    <div @if(session()->has('socialLinksSetting')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif>
                        <form name="socialLinksSetting" method="POST" id="socialLinksSetting" action="{{ URL::to('settings/socialLinksSetting') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}   
                          <div class="pro_text">
                            <h3>Social Links Settings</h3>
                             @if (Session::has('successsocialLinksSetting'))
				    <div  class="alert alert-success">{{ Session::get('successsocialLinksSetting') }}</div>
				@endif
                                @if( Session::has('updateSocialLinkError'))
                                    <div class="alert alert-danger">{{ Session::get('updateSocialLinkError') }}</div>
                                @endif
                                 <i id="socialLinkSetting" class="glyphicon glyphicon-pencil pull-right"></i>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Facebook</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="facebook" id="facebook" class="form-control" placeholder="" @if($facebook != '') value="{{trim($facebook)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Twitter</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="twitter" id="twitter" class="form-control" placeholder="" @if($twitter != '') value="{{trim($twitter)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Skype</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="skype" id="skype" class="form-control" placeholder="" @if($skype != '') value="{{trim($skype)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Google+</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="googleplus" id="googleplus" class="form-control" placeholder="" @if($googleplus != '') value="{{trim($googleplus)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Youtube</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="youtube" id="youtube" class="form-control" placeholder="" @if($youtube != '') value="{{trim($youtube)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Linkedin</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="" @if($linkedin != '') value="{{trim($linkedin)}}" @endif disabled="disabled">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>	
                            <input class="btn btn-primary" type="submit" name="updateLink" ID="updateLink" value="Save Changes" name="submit" style='display:none;'/>
                      </form>
                    </div>
                    <div @if(session()->has('advertisementAdd')) class="col-lg-12 setting_box 1st_box" @else class="col-lg-12 setting_box" @endif>
                        <div class="pro_text">
                          @if(session()->has('status'))
                            <div class="alert alert-success">
                               {{ session()->get('status') }}
                            </div>
                          @endif
                            <h3>Add Advertisement</h3>
                            <form name="adboard" method="POST" id="adboard" action="{{ URL::to('adboard') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Advertisement Title</label>
                                        <input type="text" class="form-control"  placeholder="Title *" id="title" name="title" required data-validation-required-message="Please enter Title.">
                                        <p class="help-block text-danger"></p>

                                        <label>Advertisement Time</label>
                                        <select name="time" id="time" class="form-control" required>
                                            <option value="">Time</option>
                                            @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}">{{ $i }} Day</option>
                                            @endfor

                                        </select>
                                        <p class="help-block text-danger"></p>
                                         
                                        <label>Upload Image/Paste </label>
                                        <select name="codeitem" id="codeitem" class="form-control" required>
                                             <option value="">Select Option</option>
                                             <option value="1">Upload Image</option>
                                             <option value="2">Paste Code</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                        
                                        
                                    <div id="imageShow">    
                                        <label>Advertisement Image</label>
                                        <input type="file" placeId="adimg" class="imgInp form-control" placeholder="" name="image" id="image">
                                        <p class="help-block text-danger"></p>
                                    </div>                                            
                                    <div class="col-md-6">
                                        <img id="adimg" src="" alt=""  class="showimg"/>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="imageDesc">
                                        <label>Advertisement Description</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                
                                <div class="row" id="codeUrlShow">
                                    <div class="col-md-12">
                                        <label>Advertisement URL</label>
                                        <input type="text" class="form-control" placeholder="URL" id="url" name="url">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">                               
                                    <div class="col-md-12">
                                        <input type="submit" class="skybtn" value="Submit">
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </form>
                            <h3>Add Advertisement List</h3>
                            <div class="table-responsive">
                                <table class="table table-striped tt">
                                    <thead>
                                        <tr>
                                            <th width="10%">Image</th>
                                            <th width="70%">Ad Title</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        @foreach($myAds as $myAd)
                                        <tr>
                                            @if($myAd->image)
                                                <td width="10%"><img src="{{ URL::to('/') }}/images/adboard/{{ $myAd->image }}" class="ssimg" alt="{{ $myAd->title }}"></td>
                                            @else
                                                <td width="10%"><img src="{{ $myAd->url }}" class="ssimg" alt="{{ $myAd->title }}"></td>
                                            @endif    
                                            <td width="70%">{{$myAd->title}}</td>
                                            <td width="20%">
                                                <a data-toggle="modal" data-target="#updateAds" id='updateAdss'  data-id="{{$myAd->Advertisement_id}}">
                                                    
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                
                                                </a>&nbsp;
                                                <a onclick= "confirmFor({{$myAd->Advertisement_id}})"  data-token="{{ csrf_token() }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </td>
                                        </tr>
                                        
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>	 
                    </div>
                </div>
            </div>
            <div class="col-lg-3 about_box">
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
            </div>
        </div>


    </div>
</section>
<!-- End sources Section -->
<script src="{{ URL::to('js/bootbox.min.js') }}"></script>
<script>

    $(document).ready(function () {
            $('#imageShow').hide();
            $('#imageDesc').hide();
            $('#codeUrlShow').hide();
        $('#codeitem').change(function () {
            var e = document.getElementById("codeitem");
            var strUser = e.options[e.selectedIndex].value;
            if (strUser == 1)
            {
                $('#imageShow').show();
                $('#imageDesc').show();
                $('#codeUrlShow').hide();
                uploadImageFunction();
            } else if (strUser == 2)
            {
                $('#imageShow').hide();
                $('#imageDesc').hide();
                $('#codeUrlShow').show();
                codePasteFunction();
            }
            else
            {
                $('#imageShow').hide();
                $('#imageDesc').hide();
                $('#codeUrlShow').hide();
                
            }
        });
    });
    function uploadImageFunction() {
        document.getElementById("image").required = true;
    }
    function codePasteFunction() {
        document.getElementById("url").required = true;
    }
    function confirmFor(adsId){
        var id=adsId;
        var url="deleteAds/"+id;
      bootbox.confirm({
    message: "Are you sure?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        if(result==true)
        {
        $.get(url, function(status){
        //alert("\nStatus: " + status);
    });
   }
       if(result==false)
        {
            alert("shit"); 
        }
    }
});
   }
  function  updateFor(id)
  {
      var id=adsId;
      alert(id);
        //var url="updateAds/"+id;
      // $.get(url, function(status){
        //alert("\nStatus: " + status);
   // });
      
  }
  
  $(document).on("click", "#updateAdss", function() {
    var adId = $(this).data('id');
 // alert("Test"+adId);
 var url="updateAds/"+adId;
$.get(url, function(data){
        $("#ad_place").html(data);
    });
});

$("#stuff").click(function(event){
   event.preventDefault();
   $('.stuffItem').prop("disabled", false); 
   
 $('#updateStuff').show();// Element(s) are now enabled.
});

$("#contactMe").click(function(event){
   event.preventDefault();
   $('.contactMeItem').prop("disabled", false); 
   
   $('#updateStuff').show();// Element(s) are now enabled.
});

$("#lookMeUp").click(function(event){
   event.preventDefault();
   $('.lookMeUpItem').prop("disabled", false); 
   
  $('#updateStuff').show();// Element(s) are now enabled.
});

$("#socialLinkSetting").click(function(event){
   event.preventDefault();
   document.getElementById("facebook").disabled = false;
   document.getElementById("twitter").disabled = false;
   document.getElementById("skype").disabled = false;
   document.getElementById("googleplus").disabled = false;
   document.getElementById("youtube").disabled = false;
   document.getElementById("linkedin").disabled = false;
   $('#updateLink').show();// Element(s) are now enabled.
});

$("#editcontact1").click(function(event){
   event.preventDefault();
   document.getElementById("contact1").disabled = false;
   $('#updateMobile').show();// Element(s) are now enabled.
});
$("#editcontact2").click(function(event){
   event.preventDefault();
   document.getElementById("contact2").disabled = false;
   $('#updateMobile').show();// Element(s) are now enabled.
});

/*$("#userBlock").click(function(event){
   event.preventDefault();
   document.getElementById("blockUsers").disabled = false;
   document.getElementById("blockMessages").disabled = false;
   $('#updateBlockUser').show();// Element(s) are now enabled.
});*/

$(document).on("click", "#blockusers", function() {
    var userName = document.getElementById("blockUsers").value;
     var url="/settings/blockUsernames/"+userName;
$.get(url, function(data){
        $("#ad_list").html(data);
    });
});
</script>


@endsection
