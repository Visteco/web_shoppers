@extends('layouts.authorised')
@section('content')

<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
			@if(Auth::user()->status == 0)			
			<div class="alrt alert-success">Please go to your registered email account  <b>{{ Auth::user()->email }}</b> and verify your account thank you  </div>			
            @else
            
            <div class="row">
                <div class="col-md-6">
                    <div class="network_post">
                        <div class="col-md-12 no-gutter">
                            
                            @if(!$singlepostview)
							@include('posts.createpost')
                            @endif
                            
                            <div id='main_content'>
								@include('posts.showposts')
							</div>
                            <div class="col-md-12" id='loader_post_id' style='display:none;text-align:center'>
                                <img src="{{ URL::to('public/images/postloader.gif')}}" style="width:10%" />
							</div>
							
							
							
						</div>
					</div>
				</div>
                <div class="col-md-3 about_box">
                    <div class="col3">
                        <div class="row">
                            <div class="col-md-12 ">
                                
                                @if(count($suggestedCompanies) > 0)
								<h5>Suggested Bussiness</h5>
                                @endif
                                <ul id="sources-list">
									@foreach($suggestedCompanies as $company)
									
                                    <li>
                                        <div class="sources-img">
                                            @if( isset($company->logo_img) && $company->logo_img > 0 )
											<img src="{{ URL::to('public/userimages/user_'.$company->uid."/medium/".$company->logo_img) }}" class="img-responsive" alt="">
                                            @else    
											<img src="{{ URL::to('images/user.png') }}" class="img-responsive" alt="">
                                            @endif
                                            
										</div>
                                        
                                        <div class="sources-item">
                                            <div class="comp_name"><a href="{{ URL::to("showcompany/".$company->uid) }}">{{ $company->company_name }}</a></div>
                                            <div class="comp_add">{{ $company->company_city }}, {{ $company->country }} </div>
                                            <div class="star_review">
                                                <div class="star_disabled"></div>
                                                <div class="star_active" style="width:70px;"></div>
											</div>
                                            <div class="comp_name"></div>
										</div>
                                        
                                        <button class="followbtn" onclick="doFollow('{{ URL::to('followcompany/'.$company->uid) }}',this)">Follow</button>
                                        
									</li>
									
									@endforeach
								</ul>
							</div>
						</div>	      
                        <div class="row">
                            <div class="col-md-12 ">	
                                @if(count($suggestedUsers) > 0)
								<h5>Suggested People</h5>
                                @endif
								<ul id="people-list">
									@foreach($suggestedUsers as $usr)
									
                                    <li>
                                        <div class="people-img">
                                            @if( isset($usr->img) && count($usr->img) > 0 )
                                            <a href="{{ URL::to("user/profile".$usr->uid) }}"><img src="{{ URL::to('public/userimages/user_'.$usr->uid."/medium/".$usr->img) }}" class="img-responsive" alt=""></a>
                                            @else    
                                            <a href="{{ URL::to("user/profile/".$usr->uid) }}"><img src="{{ URL::to('images/user.png') }}" class="img-responsive" alt=""></a>
                                            @endif
										</div>
                                        <div class="people-item">
                                            <div class="people_name"><a href="{{ URL::to("user/profile/".$usr->uid) }}">{{ $usr->fname }}</a></div>
                                            <div class="people_des">{{$usr->pres_desg }}</div>
                                            <!--<div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>-->
                                            <div class="people_add">{{ $usr->country  }}</div>
										</div>
                                        <button class="followbtn" onclick="doFollow('{{ URL::to('followuser/'.$usr->uid) }}',this)">Follow</button>
									</li>
									
									@endforeach
								</ul>
							</div>
						</div>
					</div>	
				</div>
                <div class="col-md-3 about_box">
                    <div class="col3">
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
			
			@endif
		</div>
	</div>
	
	
    
</section>
<!-- End sources Section -->
<!--<link href="//code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->

<script>
    /*$(document).ready(function () {
        $(window).scroll(function () {
		var colfix = ($(".col3").height()) / 2;
		if ($(window).scrollTop() > colfix) {
		$(".col3").addClass("col3fix");
		} else {
		$(".col3").removeClass("col3fix");
		}
        });
	});*/
</script>
<style>
    .col3fix {
	position: fixed;
	width: 270px;
	bottom:55px;
    }
</style>
@if(Auth::user()->status == 0)
    <script src="{{ URL::to('asset/js/bootstrap.min.js') }}"></script>
@endif  
<script type="text/javascript" src="{{ URL::to('public/js/post.js') }}"></script>

@endsection

