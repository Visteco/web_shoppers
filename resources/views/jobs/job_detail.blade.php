@extends('layouts.authorised')
@section('content')

<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
            <div class="row about_box">
                <div class="col-md-9">
                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="{{ URL::to('images/Golden.png')}}" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="{{ URL::to("userimages/user_".$job->cmp_id."/medium/".$job->logo_img) }}" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href=""><h2>{{ $job->title }}</h2></a>
                                <h6>{{ $job->company_name }}</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>{{ $job->experience }} Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>{{$job->jobsalaries}}</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>{{ $job->joblocation }}</span>
                                    </li>
                                </ul>
                                <div class="jobshare">
                                    <span class="dropdown pointer">
                                        <i class="fa fa-share-alt" data-toggle="dropdown"></i>
                                        <ul class="dropdown-menu  dropdown-menu-right" role="menu">
                                            <li><a href=""><img src="images/social/visteco.png"> Visteco</a></li>
                                            <li><a href=""><img src="images/social/facebook.png"> Facebook</a></li>
                                            <li><a href=""><img src="images/social/instagram.png"> Instagram</a></li>
                                            <li><a href=""><img src="images/social/twitter.png"> Twitter</a></li>
                                            <li><a href=""><img src="images/social/linkedin.png"> Linked In</a></li>
                                            <li><a href=""><img src="images/social/google+.png"> Google +</a></li>
                                            <li><a href=""><img src="images/social/pinterest.png"> Pinterest</a></li>
                                        </ul>
                                    </span>
                                    <i>&nbsp;&nbsp;|&nbsp;&nbsp;</i>
                                    <a class="skybtn" href="{{ URL::to('applytothejob/'.$job->cmp_id.'/'.$job->job_id) }}">Apply</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Job Description</h5>
                        </div>
                        <div class="row">
                            <h6>About the Company :</h6>
                            <p>{{ $job->about_us }}</p>
                        </div>
                        <div class="row">
                            <h6>Website :</h6><span> www.wingify.com</span>
                        </div>
                        <div class="row">
                            <h6>Profile :</h6><span>{{ $job->title }}</span>
                        </div>
                        <div class="row">
                            <h6>Desired Experience :</h6><span>{{ $job->experience }}</span>
                        </div>
                        <div class="row">
                            <h6>Job Location :</h6><span>{{ $job->joblocation }}</span>
                        </div>
                        <div class="row">
                            <h6>Course Specialization :</h6><span>{{ $job->specialization }}</span>
                        </div>
                        <div class="row">
                            <h6>Salary :</h6><span>{{ $job->jobsalaries }}</span>
                        </div>
                        <div class="row">
                            <h6>Bond :</h6><span>None</span>
                        </div>
                        <div class="row">
                            <h6>Tentative date of joining :</h6>
                            <span> will be communicated post registration window</span>
                        </div>
                        <div class="row">
                            <h6>Job Description :</h6>
                            <p>{{ $job->description }}</p>
                        </div>
                        <div class="row">
                            <h6>Job Description :</h6>
                            <p>-Research, diagnose, troubleshoot and identify solutions to resolve customer issues.</p>

                            <p>-Regular and proactive follow ups with customers with recommendations, workarounds, updates, and action plans.</p>

                            <p>-Log software defects using a bug tracking system and work closely with software developers to analyze the defects and track them to resolution.</p>

                            <p>-Create internal or external knowledgebase articles/whitepapers.</p>

                            <p>-Work with the product management team to continuously evolve the product based on customer feedback, reported issues and new trending technologies.</p>
                        </div>
                        <div class="row">
                            <h6>Professional Competencies :</h6>
                            <p>-Prior experience of supporting enterprise customers.</p>

                            <p>-Demonstrated excellence in working with high tech, cross-functional, and multidisciplinary teams. </p>

                            <p>-Outstanding communication, understanding and writing skills.</p>

                            <p>-Good understanding of web applications, HTML, JavaScript, and CSS.</p>

                            <p>-Ability to analyze logs to understand the issues, and have a thorough flair of learning new technologies.</p>

                            <p>-Well organized with utmost care to details, along with good comprehending skills to address issues.</p>

                            <p>-Proactive and results-oriented, with strong prioritization skills and ability to work with multiple customers</p>
                        </div>
                        <div class="row">
                            <h6>Skills & Experience :</h6>
                            <p>-Bachelor’s degree, Computer Science related.</p>

                            <p>-Minimum 1 years in customer support role.</p>

                            <p>-Strong problem solving skills.</p>

                            <p>-Organized and reliable self starter who can work independently.</p>

                            <p>-Strong written and verbal skills.</p>

                            <p>-Willing to work in rotating shifts.</p>
                        </div>
                        <div class="row">
                            <h6>Interview Process :</h6>
                            <p>-Assignment Round</p>

                            <p>-Telephonic Round</p>

                            <p>-Technical Interview</p>
                        </div>
                        <div class="row">
                            <h6>Job Responsibilities :</h6><span>Technical Support Consultant/Product Support</span>
                        </div>
                        <div class="row">
                            <h6>Education :</h6><span>B.Tech/B.E.</span>
                        </div>
                        <div class="row">
                            <h6>Work Experience :</h6><span>1 - 3 Years</span>
                        </div>
                        <div class="row">
                            <h6>Salary :</h6><span>4 - 6 LPA</span>
                        </div>
                        <div class="row">
                            <h6>Industry :</h6><span>IT</span>
                        </div>
                        <div class="row jobshare">
                            <span class="dropdown pointer">
                                <i class="fa fa-share-alt" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu  dropdown-menu-right" role="menu">
                                    <li><a href=""><img src="images/social/visteco.png"> Visteco</a></li>
                                    <li><a href=""><img src="images/social/facebook.png"> Facebook</a></li>
                                    <li><a href=""><img src="images/social/instagram.png"> Instagram</a></li>
                                    <li><a href=""><img src="images/social/twitter.png"> Twitter</a></li>
                                    <li><a href=""><img src="images/social/linkedin.png"> Linked In</a></li>
                                    <li><a href=""><img src="images/social/google+.png"> Google +</a></li>
                                    <li><a href=""><img src="images/social/pinterest.png"> Pinterest</a></li>
                                </ul>
                            </span>
                            <i>&nbsp;&nbsp;|&nbsp;&nbsp;</i>
                            <button class="skybtn">Apply</button>
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

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>  
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<div class="row">
    @include("include.footer_login")
</div>
<script>
// With JQuery
    $("#ex2").slider({});

    /*$(document).ready(function() {
     $(window).scroll(function(){
     //var divHeight=$(".filter").height();
     if($(window).scrollTop()>100){
     //console.log("window_height:"+$(window).scrollTop()+",follow_Div_Height:"+followDiv); 				
     $(".filter").addClass("filterfix");
     }
     else{
     $(".filter").removeClass("filterfix");
     }
     });
     });*/
</script>
@endsection