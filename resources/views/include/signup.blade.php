<!-- Modal -->
<div class="modal fade model_offset in sarv-model" id="signup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog sarv-model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3>Register</h3>
                <label>Join Us, Its Free</label>
            </div>

            <form id="registerForm" data-toggle="validator" class="" role="form" method="POST" action="{{ URL::to('user/register') }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->register->has('role') ? ' has-error' : '' }}">
                                <label>You are :</label>
                                
                                <select class="form-control" name="role">
                                    
                                    <option value="">You are regiter for </option>
                                    
                                    <option <?php if(old('role')== USER_PROFILE ): echo "selected"; endif ?> value="{{USER_PROFILE}}">User</option>
                                    
                                    <option <?php if(old('role')== COMPANY_PROFILE ): echo "selected"; endif ?> value="{{COMPANY_PROFILE}}">Business</option>
                                    
                                </select>
                                
                                @if ($errors->register->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->register->first('role') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->register->has('name') ? ' has-error' : '' }}">
                        <label>Name / Business Name:</label>
                        <input value="{{ old('name') }}"name="name" type="text" class="form-control" placeholder="Enter Name / Business Name">
                        @if ($errors->register->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->register->first('name') }}</strong>
                        </span>
                        @endif
                    </div>	


                    <div class="form-group{{ $errors->register->has('email') ? ' has-error' : '' }}">

                        <label for="usr">Email Id :</label>

                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="Enter Email Id">

                        @if ($errors->register->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->register->first('email') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->register->has('password') ? ' has-error' : '' }}">
                        <label for="pwd">Password :</label>
                        <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>

                    <div class="row">
                        <div class="col-md-12 {{ $errors->register->has('turms') ? ' has-error' : '' }}">
                            <input type="checkbox" name="turms"> <label for="usr">Accept 
                                <a href="terms.php" target="_blank">Terms & Conditions</a>  Of Use *</label>
                                @if ($errors->register->has('turms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->register->first('turms') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>				
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <input id="" type="submit" class="btn btn-primary" value="Register"/>

                    <div class="login_alternate clearfix">
                        <div class="alternate">
                            <span>or connect via</span>
                        </div>
                        <a href=""><img src="images/login_fb.png"></a>
                        <a href=""><img src="images/login_g.png"></a>
                    </div>                
                    <p class="alternatep">Are you member? <span>
                       <a href="#" data-toggle="modal" data-target="#login"  data-dismiss="modal">Login Now</a></span>- It's Free and easy </p>  
                </div>			
            </form>
        </div>
    </div>
</div>