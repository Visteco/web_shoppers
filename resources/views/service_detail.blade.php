@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-6">
                <div class="post-box clearfix">
                    <ul class="post-list clearfix clearfix">
                        <li><a href="{{ $profile }}"><img src=""></a></li>
                        
                        <li class="post-name">
                            <a href="{{ URL::to("showcompany/".$service->uid) }}" class="people_name">{{ $service->company_name }}</a><time></time>
                            <span class="people_des">{{ $service->company_type }}<a href="">{{ $service->company_city }}, {{ $service->country }}</a></span>
                        </li>
                        
                    </ul>
                    <ul class="post-item">
                        <li><p>&nbsp;</p></li>
                        <li class="clearfix">
                            <div class="service_box col-md-8 no-gutter">
                             <div class="service_image">
                              <img src="{{ URL::to("images/services/".$service->image) }}" class="img-responsive">
                              <ul class="service_soc">
                               <li>
                                <a href=""><i class="glyphicon glyphicon-thumbs-up"></i> <span> Like</span></a>
                               </li>
                               <li>
                                <div class="star_review">
                                  <div class="star_disabled"></div>
                                  <div class="star_active"></div>
                                </div>
                               </li> 
                              </ul>
                             </div>
                             <div class="service_content">
                              <a href=""><h4>{{ $service->service_title }}</h4></a>
                              <p>{{ $service->service_description }}</p>
                             </div>
                            </div>
                        </li>
                    </ul>                   
                </div>
            </div>
            <div class="col-lg-3 about_box">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Suggested Services</h5>							
                        <a href=""><h4>Accessories Services</h4></a>
                        <a href=""><img src="images/projects/accessories.jpg" width="100%" alt="..."></a>

                        <a href=""><h4>IT Professional Services</h4></a>
                        <a href=""><img src="images/projects/it-professional.jpg" width="100%" alt="..."></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Resent Add Services</h5>						
                        <a href=""><h4>Online Furniture Store</h4></a>
                        <p>add by : <a href="">Webcoir IT Solutions Pvt Ltd </a></p>
                        <a href=""><img src="images/projects/desks.jpg" width="100%" alt="..."></a>
                        <a href=""><h4>Lighting Services</h4></a>
                        <p>add by : <a href="">Sarvtech India</a></p>
                        <a href=""><img src="images/projects/lighting.jpg" width="100%" alt="..."></a>
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
@endsection 