<?php
include("include/header_login.php");?>
<section class="profile-section">
    <div class="container">
	<div class="row clearfix">
		<div class="col-lg-9 about_box">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="pro_text">
                                    <form name="paymentForm" method="POST" id="paymentForm" action="{{ URL::to('creditPayment') }}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                            <h3>Personal Details</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>First Name</label>
                                                    <input name="firstname" type="text" class="form-control" value="" /> 
                                                    <p class="help-block text-danger"></p>	 
                                                </div>
						<div class="col-md-6">
                                                    <label>Last Name</label>
                                                    <input name="lastname" type="text" class="form-control" value="" /> 
                                                    <p class="help-block text-danger"></p>	 
						</div>
						<div class="col-md-6">
                                                    <label>Email</label>
                                                    <input name="email" type="text" class="form-control" value="" /> 
                                                    <p class="help-block text-danger"></p>	
                                                </div>
						<div class="col-md-6">
                                                    <label>Address</label>
                                                    <input name="address" type="text" class="form-control" value=""/> 
                                                    <p class="help-block text-danger"></p>	
						</div>
						<div class="col-md-6">
                                                    <div class="row" style="padding:0;">
							<div class="col-md-6">
                                                            <label>City</label>
                                                            <input name="city" type="text" class="form-control" value=""/>
                                                            <p class="help-block text-danger"></p>	
							</div>
							<div class="col-md-6">
                                                            <label>Zip</label>
                                                            <input name="zip" type="text" class="form-control" value=""/>
                                                            <p class="help-block text-danger"></p>		
							</div>
                                                    </div>	
						</div>	
						<div class="col-md-6">
                                                    <label>State</label>
                                                    <input name="state" type="text" class="form-control" value=""/>
                                                    <p class="help-block text-danger"></p>	
						</div>
                                            </div>
                                            <h3>Payment Details</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Card Type</label>
                                                    <select name="cardtype" class="form-control"> 
							<option value="" selected disabled>Select Card</option>
							<option value="visa" >Visa</option>
							<option value="MasterCard" >Master Card</option>
							<option value="AmericanExpress" >American Express</option>
                                                    </select>
                                                    <p class="help-block text-danger"></p>
						</div>
						<div class="col-md-6">
                                                    <label>Name On Card</label>
                                                    <input name="cardholder" type="text" class="form-control" value=""/> 
                                                    <p class="help-block text-danger"></p>
                                                </div>  
						<div class="col-md-6">
                                                    <label>Card Number</label>
                                                    <input name="cardnumber" type="text" class="form-control" value=""/>
                                                    <p class="help-block text-danger"></p>
						</div>             											
						<div class="col-md-6">
                                                    <label>Expiration </label>
                                                    <span style=" font:7pt arial; color:gray;">[ mm / yyyy ]</span>
                                                    <div class="row" style="padding:0;">
                                                        <div class="col-md-6">
                                                            <input name="cardmonth" class="sel form-control" type="text" value=""/> 
                                                            <p class="help-block text-danger"></p>
							</div>
							<div class="col-md-6">
                                                            <input type="text" name="cardyear" class="sel form-control" value=""/>  
                                                            <p class="help-block text-danger"></p>
							</div>
                                                    </div>
						</div>             											
						<div class="col-md-6">
                                                    <label>CVV Number</label>
                                                    <input name="cardcvv" type="text" class="form-control" value=""/>  
                                                    <p class="help-block text-danger"></p> 
                                                    <input type="hidden" name="amount" value="{{$amount}}"/>    
                                                    <input type="hidden" name="user_id" value="{{$userID}}"/>     
						</div>
                                            </div>
                                            <div class="row">
						<div class="col-md-12"> 
                                                    <button type="submit" class="btn btn-primary btn-md responsive-width"> 
                                                    <i class="fa fa-btn fa-user"></i>Continue</button>
						</div>
                                            </div>
                                    </form>
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
                        <?php include("include/footer.php");?>
                    </div>
                </div>
	</div>	
    </div>
</section>
        <!-- End sources Section -->