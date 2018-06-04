@extends('layouts.authorised')
@section('content')
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-2 about_box">
                <div class="row">
                    <div class="col-lg-12 setting_tab shadow_box">
                        <ul>
                            <li class="1st">Top Up</li>
                            <li>Take a Plans </li>
                            <li>Summary </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 about_box">
                <div class="row ">
                    <div class="col-lg-12 setting_box 1st_box">
                        <div class="pro_text">
                            <h3>Add fund to wallet<span class="pull-right">Available Credit : $0</span></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Top Up amount</label>
                                </div>
                                <form name="addAmount" method="GET" id="addAmount" action="{{ URL::to('payment') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_info" value="{{Auth::user()->id}}"/> 
                                <div class="col-md-6">
                                    <select class="form-control" name="amount">
                                        <option value="1">$ 1</option>
                                        <option value="2">$ 2</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i*5 }}">$ {{ $i*5 }}</option>
                                        @endfor
                                        
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div> 
                                     

                            </div>
                            <div class="row paymode">
                                <div class="col-md-12">
                                    <input type="radio" name="paymentMethod" value="creditDebitCard" checked="checked" >
                                    <img src="{{URL::to('images/payment/pay2.png')}}">
                                </div>
                                <div class="col-md-12">
                                    <input type="radio" name="paymentMethod" value="paypal">
                                    <img src="{{URL::to('images/payment/pay1.png')}}">
                                </div>
                                
                                <div class="col-md-12">
                                    <input type="radio" name="paymentMethod" value="a">
                                    <img src="{{URL::to('images/payment/Citrus.jpg')}}">
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-12">
                                    <input type="submit" class="skybtn pull-right" value="Payment">
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                             </form>
                        </div>	
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Choose your Plan</h3>
                            <div class="row clearfix">
                                <div class="col-md-4 text-center">
                                    <div class="panel panel-danger panel-pricing">
                                        <div class="panel-heading">
                                            <i class="fa fa-desktop"></i>
                                            <h3>Plan 1</h3>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p><strong>$50 / Month</strong></p>
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> Unlimited projects</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-block btn-danger" href="#">BUY NOW!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="panel panel-warning panel-pricing">
                                        <div class="panel-heading">
                                            <i class="fa fa-desktop"></i>
                                            <h3>Plan 2</h3>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p><strong>$75 / Month</strong></p>
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> Unlimited projects</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-block btn-warning" href="#">BUY NOW!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="panel panel-success panel-pricing">
                                        <div class="panel-heading">
                                            <i class="fa fa-desktop"></i>
                                            <h3>Plan 3</h3>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p><strong>$100 / Month</strong></p>
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"><i class="fa fa-check"></i> Personal use</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> Unlimited projects</li>
                                            <li class="list-group-item"><i class="fa fa-check"></i> 27/7 support</li>
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-block btn-success" href="#">BUY NOW!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 setting_box">
                        <div class="pro_text">
                            <h3>Your Summary List</h3>
                            <div class="table-responsive">
                                <table class="table table-striped tt ntxt">
                                    <thead>            
                                        <tr>
                                            <th width="25%">Date</th>
                                            <th width="65%">Description</th>
                                            <th width="10%">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>03-05-2017, 13:20:28</td>
                                            <td>Take membership fee one month your payment id O588f54421c453</td>
                                            <td>$ 15</td>
                                        </tr>
                                        <tr>
                                            <td>03-05-2017, 13:20:28</td>
                                            <td>Take membership fee one month your payment id O588f54421c453</td>
                                            <td>$ 15</td>
                                        </tr>
                                        <tr>
                                            <td>03-05-2017, 13:20:28</td>
                                            <td>Take membership fee one month your payment id O588f54421c453</td>
                                            <td>$ 15</td>
                                        </tr>
                                        <tr>
                                            <td>03-05-2017, 13:20:28</td>
                                            <td>Take membership fee one month your payment id O588f54421c453</td>
                                            <td>$ 15</td>
                                        </tr>
                                        <tr>
                                            <td>03-05-2017, 13:20:28</td>
                                            <td>Take membership fee one month your payment id O588f54421c453</td>
                                            <td>$ 15</td>
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
            </div>
        </div>	
    </div>
</section>
<!-- End sources Section -->
@endsection		

