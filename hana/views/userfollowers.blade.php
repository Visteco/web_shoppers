@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
            <div class="row about_box">
                <div class="col-md-2">
                    <div class="row"> 
                        <div class="col-md-12 shadow_box mypro">
                            <img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg">
                            <h3>Sarvesh kumar yadav</h3>
                            <h4>Web Designer</h4>
                            <hr>
                            <h4>Followers</h4>
                            <div class="conct">
                                <img src="images/people/p1.jpg" alt="...">
                                <img src="images/people/p2.jpg" alt="...">
                                <img src="images/people/p3.jpg" alt="...">
                                <img src="images/people/p4.jpg" alt="...">
                                <img src="images/people/p5.jpg" alt="...">
                            </div>
                            <h2>350</h2>
                            <a href="followers.php">See All</a>
                            <hr>
                            <h4>Following</h4>
                            <div class="conct">
                                <img src="images/people/p1.jpg" alt="...">
                                <img src="images/people/p2.jpg" alt="...">
                                <img src="images/people/p3.jpg" alt="...">
                                <img src="images/people/p4.jpg" alt="...">
                                <img src="images/people/p5.jpg" alt="...">
                            </div>
                            <h2>50</h2>
                            <a href="following.php">See All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-lg-12 jobbox">
                        <h5>Followers <input type="text" placeholder="Search Keyword" class="pull-right"></h5>
                        <div class="row">
                            <div class="col-lg-12 no-gutter table-responsive">
                                <table class="table table-striped tbl_list">
                                    <tbody>
                                        @foreach($followerCompany as $follow)
                                        <tr>
                                            <td><img src="{{ URL::to('userProfilePic/user_'.$userID.'/small/'.$follow->image ) }}" alt="...">
                                            </td>
                                            <td width="45%">
                                                <a href=""><div class="people_name">{{$follow->name}}</div></a>
                                                <div class="people_des">{{$follow->city}}</div>	
                                            </td>
                                            <td width="45%" style="text-align:right;">
                                                <button class="skybtn">Message</button>
                                                <button class="skybtn">Unfollow</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                         @foreach($followerUser as $follow)
                                        <tr>
                                            <td><img src="{{ URL::to('userProfilePic/user_'.$userID.'/small/'.$follow->image ) }}" alt="...">
                                            </td>
                                            <td width="45%">
                                                <a href=""><div class="people_name">{{$follow->fname}}  {{$follow->lname}}</div></a>
                                                <div class="people_des">{{$follow->designation}}</div>	
                                            </td>
                                            <td width="45%" style="text-align:right;">
                                                <button class="skybtn">Message</button>
                                                <button class="skybtn">Unfollow</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                     </tbody>
                                </table>
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
    </div>
</section>
<!-- End sources Section -->

@endsection