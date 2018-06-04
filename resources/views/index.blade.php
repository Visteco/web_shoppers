@extends('layouts.home_layout')
@section('content')
  <div id="banner">
    <div class="container">
      <h2>Know your customers</h2>
      <h1>Grow your business </h1>
      <div class="border"></div>
      <!--<p>Register your business !!</p>-->
      <a href="#">Join Our Community</a>
      <div class="banner_form">
        <form role="search">
          <input type="text" class="input_filed" placeholder="Search for shops, people, deals and more." />
          
          <select name="Country">
            <option value="Himachal">India</option>
            <option value="Himachal">India</option>
          </select>
          <a href="#"><i class="fa fa-search" aria-hidden="true"></i> <span>Search</span></a>
          
          <!--button type="submit" class="btn btn-default">Submit</button-->
        </form>
      </div>
    </div>
  </div>
  <!--end banner-->
  </div>
  <div id="company">
    <div class="container">
      <div class="sponsored">
        <h2 class="sub_heading">Sponsored <span>Company</span></h2>
        <div class="border_red"></div>
          @if(count($company_data) != 0)
            <div class="our_company">
              @foreach($company_data as $company)
                <div class="company simple_border_red">
                  <div class="company_logo">
                    @if(!empty($company->logo_img))
                      <img class ="company_logo home-company-img" src="{{url('public/userimages/user_'.$company->id.'/medium/'.$company->logo_img)}}" alt="#" class="img-responsive" />
                    @else
                      <img clas="company_logo" src="{{url('public/asset/plugins/dist/images/webapplisoft.png')}}" alt="business" class="img-responsive" />
                    @endif
                  </div>
                  <!-- <div class="company_logo"> <img src="{{url('public/asset/plugins/dist/images/webapplisoft.png')}}" alt="#" /> </div> -->
                  <!--company_logo-->
                  <div class="company_content">
                    <div class="company_content_left">
                      <h3>{{ucwords($company->company_name)}} </h3>
                      <p>{{ucwords($company->company_city).','.ucwords($company->company_state)}}</p>
                    </div>
                    <!--company_content_left-->
                    <div class="company_content_right">
                      <ul>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
                      </ul>
                      <a href="javascript:void(0)" class="button_red">follow</a> </div>
                    <!--company_content_right--> 
                  </div>
                  <!--company_content--> 
                </div>
              @endforeach
            </div>
          @else
            No company record found here!
          @endif
          @if(!empty($user_data))
            <div class="our_company">
              @foreach($user_data as $user)
                <div class="company simple_border_red">
                  <div class="company_logo vertical1"> 
                    @if(!empty($user->img))
                      <img class ="company_logo vertical1 home-company-img" src="{{url('public/userimages/user_'.$user->id.'/medium/'.$user->img)}}" alt="#" />
                    @else
                      <img class="company_logo vertical1" src="{{url('public/asset/plugins/dist/images/people.png')}}" alt="business" class="img-responsive" />
                    @endif 
                    <!-- <div class="company_logo vertical1"> <img src="{{url('public/asset/plugins/dist/images/people.png')}}" alt="#" /> -->
                   <a href="javascript:void(0)" class="button_red">follow</a> </div>
                  <!--company_logo-->
                  <div class="company_content vertical2">
                    <div class="company_content_left">
                      <h3>{{ucwords($user->user_name)}}</h3>
                      
                    </div>
                    <!--company_content_left-->
                    <div class="company_content_right">
                      <h4>{{ucwords($user->pres_desg)}}</h4>
                      <h5>{{ucwords($user->pres_org)}}</h5>
                      <p>{{ucwords($user->city).', '.ucwords($user->state)}}</p>
                     </div>
                    <!--company_content_right--> 
                  </div>
                  <!--company_content--> 
                </div>
              @endforeach
            </div>
            <!--our_company--> 
          @else
            No user record found here!
          @endif
      </div>
      <!--end sponsored-->
      <div class="shoppers">
        <h2 class="sub_heading">Welcome to <span>Shoppers</span></h2>
        <div class="border_red"></div>
        <div class="shoppe"> <img src="{{url('public/asset/plugins/dist/images/shoppe_logo.png')}}" alt="#" />
          <p>The Network which connects users with business more efficiently.</p>
          <!-- <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p> -->
          <a href="#" class="active">How it Works</a> </div>
      </div>
      <!--end shoppers--> 
    </div>
  </div>
  <!--end Company-->
  <div id="recently">
    <div class="container">
      <h2 class="sub_heading">Recently Registered <span>Companys</span></h2>
        <p>Duis aute irure dolor in reprehenderit in voluptate</p>
          <div class="border_red"></div>
          <div class="recent_row company_row">
            @if(count($recent_company_data) != 0)
              @foreach($recent_company_data as $recent_company)
                <div class="company simple_border_red">
                  <div class="company_logo"> 
                    @if(!empty($recent_company->logo_img))
                      <img class="company_logo home-company-img" height="50" src="{{url('public/userimages/user_'.$recent_company->id.'/medium/'.$recent_company->logo_img)}}" alt="#" />
                    @else
                      <img clas="company_logo" src="{{url('public/asset/plugins/dist/images/webapplisoft.png')}}" alt="#" />
                    @endif 
                  </div>
                  <!--company_logo-->
                  <div class="company_content">
                    <div class="company_content_left">
                      <h3>{{ucwords($recent_company->company_name)}} </h3>
                      <p>{{ucwords($recent_company->company_city).','.ucwords($recent_company->company_state)}}</p>
                    </div>
                    <!--company_content_left-->
                    <div class="company_content_right">
                      <ul>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
                      </ul>
                      <a href="javascript:void(0)" class="button_red">follow</a> </div>
                    <!--company_content_right--> 
                  </div>
                  <!--company_content--> 
                </div>
              @endforeach
              @if(empty($_REQUEST['company']))
                <div class="all_company all-company" onclick="get_all_user('cmppr','company_row','all-company')">
                  <a href="javascript:void(0)">View all Companys</a>
                </div>
              @endif
            @else
              Recently no company found
            @endif
          </div>
    </div>
  </div>
  <!--end recently-->

  <div id="recently">
    <div class="container peoples">
      <h2 class="sub_heading">Recently Registered <span>People</span></h2>
        <p>Duis aute irure dolor in reprehenderit in voluptate</p>
          <div class="border_red"></div>
          <div class="recent_row user_row">
            @if(count($recent_users) != 0)
              @foreach($recent_users as $recent_user)
                <div class="company simple_border_red">
                  <div class="company_logo vertical1">
                    @if(!empty($recent_user->img))
                      <img class ="company_logo vertical1 home-company-img" src="{{url('public/userimages/user_'.$recent_user->id.'/medium/'.$recent_user->img)}}" alt="#" />
                    @else 
                      <img class="company_logo vertical1" src="{{url('public/asset/plugins/dist/images/people.png')}}" alt="#" />
                    @endif 
                    <a href="javascript:void(0)" class="button_red">follow</a> 
                  </div>
                  <!--company_logo-->
                  <div class="company_content vertical2">
                    <div class="company_content_left">
                      <h3>{{ucwords($recent_user->user_name)}}</h3>
                      
                    </div>
                    <!--company_content_left-->
                    <div class="company_content_right">
                      <h4>{{ucwords($recent_user->pres_desg)}}</h4>
                      <h5>{{ucwords($recent_user->pres_org)}}</h5>
                      <p>{{ucwords($recent_user->city).', '.ucwords($recent_user->state)}}</p>
                     </div>
                    <!--company_content_right--> 
                  </div>
                  <!--company_content--> 
                </div>
              @endforeach
              @if(empty($_REQUEST['user']))
                <div class="all_company all_users" onclick="get_all_user('usrpr','user_row','all_users')">
                  <a href="javascript:void(0)" id="recent_users">View all People</a>
                  <!-- <a href="{{URL::to('/').'?user=all_users'}}" id="recent_users">View all People</a> -->
                </div>
              @endif
            @else
              No recent users found!
            @endif
          </div>
    </div>
  </div>
  <!--end recently-->
@endsection