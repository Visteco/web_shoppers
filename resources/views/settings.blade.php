@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-2 about_box">
                <div class="row">
                    <div class="col-lg-12 setting_tab shadow_box">
                        <ul>
                            <li class="1st">General Settings </li>
                            <li>Security Settings </li>
                            <li>Privacy Settings </li>
                            <li>Manage blocking </li>
                            <li>Mobile Settings</li>
                            <li>Social Links Settings </li>
                            <li>Advertisement Add </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 about_box">
                <div class="row ">
                    <div class="col-lg-12 setting_box 1st_box">
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
                                    <input id="currentPassword" name="currentPassword" type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>                                            
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>New password</label>
                                    <input id="newPassword" name="newPassword" type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>                                            
                                <div class="col-md-6">
                                    <label>Retype New password</label>
                                    <input id="confirmPassword" name="confirmPassword" type="text" class="form-control" placeholder="">
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
                           <!-- <div class="row">
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
                            </div>-->
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
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Privacy Settings</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Who can see my stuff?</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select class="form-control">
                                        <option>Everyone</option>
                                        <option>Friends</option>
                                        <option>Friend's Friends</option>
                                        <option>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Who can contact me?</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select class="form-control">
                                        <option>Everyone</option>
                                        <option>Friends</option>
                                        <option>Friend's Friends</option>
                                        <option>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Who can look me up?</label>
                                    <i class="glyphicon glyphicon-pencil pull-right"></i>
                                </div>                                  
                                <div class="col-md-12">
                                    <select class="form-control">
                                        <option>Everyone</option>
                                        <option>Friends</option>
                                        <option>Friend's Friends</option>
                                        <option>Only Me</option>
                                    </select>
                                    <p class="help-block text-danger">&nbsp;</p>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Manage blocking</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Restricted List</label>
                                </div>                                           
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Block users</label>
                                </div>                                           
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Block messages</label>
                                </div>                                          
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
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
                            </div>
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Mobile Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Your phones</label>
                                </div>                                            
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled placeholder="9971224548">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Add another mobile phone number</label>
                                </div>                                            
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Social Links Settings</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Facebook</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Twitter</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Skype</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Google+</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Youtube</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Linkedin</label>
                                </div>                                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Add Advertisement</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Advertisement Title</label>
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>

                                    <label>Advertisement Image</label>
                                    <input type="file" placeId="adimg" class="imgInp form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>                                            
                                <div class="col-md-6">
                                    <img id="adimg" src="" alt=""  class="showimg"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Advertisement Description</label>
                                    <textarea class="form-control"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <center><label>OR</label></center>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Advertisement URL</label>
                                    <input type="text" class="form-control" placeholder="">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-12">
                                    <input type="submit" class="skybtn" value="Submit">
                                    <p>&nbsp;</p>
                                </div>
                            </div>

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
                                        <tr>
                                            <td width="10%"><img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" class="ssimg" alt="..."></td>
                                            <td width="70%">Advertisement</td>
                                            <td width="20%">
                                                <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                                <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" class="ssimg" alt="..."></td>
                                            <td>Advertisement</td>
                                            <td>
                                                <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                                <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                            </td>
                                        </tr>
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
                <div class="row">
                            @include("include.footer_login")
						</div>
            </div>
        </div>


    </div>
</section>
<!-- End sources Section -->

@endsection