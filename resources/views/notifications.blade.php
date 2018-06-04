@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
            <div class="row about_box">
                <div class="col-md-2">
                    <div class="row"> 
                        <div class="col-md-12 shadow_box filter">
                            <h5>Notifications</h5>
                            <p class="col-md-12">You’re all caught up! Check back later for new notifications</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-lg-12 jobbox">
                        <div class="row">
                            <div class="col-lg-12 no-gutter table-responsive">
                                <h5>Your Notifications</h5>

                                <table class="table table-striped tbl_list">
                                    <tbody>


                                        @if(count($notifications) > 0)
                                        @foreach($notifications as $notification )
                                        <tr>
                                            <td><img src="images/people/p9.jpg" alt="..."></td>
                                            <td width="95%">
                                                <div class="ntxt">
                                                    
                                                    @if($notification->role == COMPANY_PROFILE)
                                                    <strong>{{ $notification->company_name }}</strong>
                                                    @elseif($notification->role == USER_PROFILE)      
                                                    <strong>{{ $notification->user_name }}</strong>
                                                    @endif
                                                    <a href="{{ $notification->action }}">{{ $notification->text }}</a> 
                                                    <!--<button class="skybtn pull-right">Accept</button>-->
                                                </div>
                                                <div class="ntime">{{ $notification->time }}</div>
                                            </td>
                                        </tr>
                                        
                                        @endforeach
                                        
                                        @else
                                        <tr>
                                            <td width="95%">
                                                <div class="ntime">No notification to show</div>
                                            </td>
                                        </tr>
                                        @endif




                                    </tbody>
                                </table>

                                <div class="ntxt">
                                    {{ $notifications->links() }}
                                </div>

                            </div>
                        </div>
                    </div>		
                </div>

                <div class="col-md-3">  
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Hot Opportunities</h5>   
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Visteco Certified?</h5>
                            <p> Post your Visteco Credentials on Visteco Profile</p>
                            <button class="skybtn">Add to profile</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>New to Visteco?</h5>   
                            <p>Get the AMCAT Advantage:</p>
                            <p>Is AMCAT for you?</p>
                            <p>Where does AMCAT takes you?</p>
                            <p>Hear success stories from AMCAT takers</p>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5> Visteco Blog</h5>
                            <p>#8216;Problem-solving skills would lead to jobs after college&#8217;
                                Ever wondered what is that one thing that most com...
                                May 29 2017</p>
                            <p>Understanding Aptitude Tests: How &#8216;Divergent&#8217; Are You?
                                ‘In a society divided into 5 different factions ba...
                                May 29 2017</p>
                            <p>Focus on your communication skills, shares AMCAT achiever
                                What’s the least that you can gain after giving th...
                                May 25 2017</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                            @include("include.footer_login")
                        </div>
    </div>
</section>
<!-- End sources Section -->

@endsection