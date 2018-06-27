@extends('layouts.authorised')
@section('content')
<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
            <div class="row about_box">
                <div class="col-md-2">
                    <div class="row"> 
                        <div class="col-md-12 shadow_box filter">
                            <h5>Refine Results</h5>
                            <div class="panel-group" id="accordion">
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Job Type</a>
                                    <ul id="collapse1" class="panel-collapse in filtent">
                                        <li><input type="checkbox">&nbsp;Premium Jobs (14)</li>
                                        <li><input type="checkbox">&nbsp;Parmanent (50)</li>
                                        <li><input type="checkbox">&nbsp;project Based  (8)</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">Location</a>
                                    <ul id="collapse2" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Bangalore, Karnataka (33)</li>
                                        <li><input type="checkbox">&nbsp;Chennai, Tamil Nadu (10)</li>
                                        <li><input type="checkbox">&nbsp;Hyderabad, Telangana (7)</li>
                                        <li><input type="checkbox">&nbsp;Kolkata, West Bengal (7)</li>
                                        <li><input type="checkbox">&nbsp;Mumbai, Maharashtra (11)</li>
                                        <li><input type="checkbox">&nbsp;New Delhi, Delhi (23)</li>
                                        <li><input type="checkbox">&nbsp;Agartala, Tripura</li>
                                        <li><input type="checkbox">&nbsp;Ahmedabad, Gujarat (1)</li>
                                        <li><input type="checkbox">&nbsp;Aizwal, Mizoram</li>
                                        <li><input type="checkbox">&nbsp;Amritsar, Punjab</li>
                                        <li><input type="checkbox">&nbsp;Bhopal, Madhya Pradesh (2)</li>
                                        <li><input type="checkbox">&nbsp;Bhubaneshwar, Orissa (2)</li>
                                        <li><input type="checkbox">&nbsp;Coimbatore, Tamil Nadu (5)</li>
                                        <li><input type="checkbox">&nbsp;Dehradun, Uttarakhand</li>
                                        <li><input type="checkbox">&nbsp;Faridabad, Haryana (1)</li>
                                        <li><input type="checkbox">&nbsp;Gandhinagar, Gujarat</li>
                                        <li><input type="checkbox">&nbsp;Gangtok, Sikkim</li>
                                        <li><input type="checkbox">&nbsp;Ghaziabad, Uttar Pradesh</li>
                                        <li><input type="checkbox">&nbsp;Gurgaon, Haryana (16)</li>
                                        <li><input type="checkbox">&nbsp;Guwahati, Assam</li>
                                        <li><input type="checkbox">&nbsp;Imphal, Manipur</li>
                                        <li><input type="checkbox">&nbsp;Indore, Madhya Pradesh (3)</li>
                                        <li><input type="checkbox">&nbsp;Itanagar, Arunachal Pradesh</li>
                                        <li><input type="checkbox">&nbsp;Jaipur, Rajasthan (4)</li>
                                        <li><input type="checkbox">&nbsp;Kanpur, Uttar Pradesh</li>
                                        <li><input type="checkbox">&nbsp;Kochi, Kerala</li>
                                        <li><input type="checkbox">&nbsp;Lucknow, Uttar Pradesh (3)</li>
                                        <li><input type="checkbox">&nbsp;Nagpur, Maharashtra</li>
                                        <li><input type="checkbox">&nbsp;Navi Mumbai, Maharashtra</li>
                                        <li><input type="checkbox">&nbsp;Noida, Uttar Pradesh (27)</li>
                                        <li><input type="checkbox">&nbsp;Panji, Goa</li>
                                        <li><input type="checkbox">&nbsp;Patna, Bihar</li>
                                        <li><input type="checkbox">&nbsp;Pune, Maharashtra (5)</li>
                                        <li><input type="checkbox">&nbsp;Ranchi, Jharkhand</li>
                                        <li><input type="checkbox">&nbsp;Shillong, Meghalaya</li>
                                        <li><input type="checkbox">&nbsp;Shimla, Himachal Pradesh</li>
                                        <li><input type="checkbox">&nbsp;Surat, Gujarat</li>
                                        <li><input type="checkbox">&nbsp;Thiruvananthapuram, Kerala</li>
                                        <li><input type="checkbox">&nbsp;Vadodara, Gujarat</li>
                                        <li><input type="checkbox">&nbsp;Visakhapatnam, Andhra Pradesh</li>
                                        <li><input type="checkbox">&nbsp;Abhayapuri, Assam</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed">Experience Type</a>
                                    <ul id="collapse3" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Fresher</li>
                                        <li><input type="checkbox">&nbsp;Experienced</li>
                                        <li><input type="checkbox">&nbsp;Internship</li>
                                        <li><input type="checkbox">&nbsp;Apprenticeship</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="collapsed">Salary</a>
                                    <ul id="collapse4" class="collapse filtent range-field">
                                        <input type="range" id="test5" min="0" max="100" />
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="collapsed">Education</a>
                                    <ul id="collapse5" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;B.Com.</li>
                                        <li><input type="checkbox">&nbsp;B.Sc.</li>
                                        <li><input type="checkbox">&nbsp;B.A.</li>
                                        <li><input type="checkbox">&nbsp;B.Tech/B.E.</li>
                                        <li><input type="checkbox">&nbsp;BBA</li>
                                        <li><input type="checkbox">&nbsp;Nursing</li>
                                        <li><input type="checkbox">&nbsp;B.Ed</li>
                                        <li><input type="checkbox">&nbsp;BBM</li>
                                        <li><input type="checkbox">&nbsp;B.Sc.(Hotel Management)</li>
                                        <li><input type="checkbox">&nbsp;BAF</li>
                                        <li><input type="checkbox">&nbsp;BHM 4 Yr.</li>
                                        <li><input type="checkbox">&nbsp;BHM 3 Yr.</li>
                                        <li><input type="checkbox">&nbsp;BCM</li>
                                        <li><input type="checkbox">&nbsp;MCM</li>
                                        <li><input type="checkbox">&nbsp;LL.B</li>
                                        <li><input type="checkbox">&nbsp;M.Sc. (Tech.)</li>
                                        <li><input type="checkbox">&nbsp;BBI</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="collapsed">Industry</a>
                                    <ul id="collapse6" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Business and Management</li>
                                        <li><input type="checkbox">&nbsp;Customer Service</li>
                                        <li><input type="checkbox">&nbsp;Education and Training</li>
                                        <li><input type="checkbox">&nbsp;Electronics</li>
                                        <li><input type="checkbox">&nbsp;Finance</li>
                                        <li><input type="checkbox">&nbsp;Hospitality and Tourism</li>
                                        <li><input type="checkbox">&nbsp;Information Technology</li>
                                        <li><input type="checkbox">&nbsp;Logistics</li>
                                        <li><input type="checkbox">&nbsp;Manufacturing</li>
                                        <li><input type="checkbox">&nbsp;Marketing</li>
                                        <li><input type="checkbox">&nbsp;Retail</li>
                                        <li><input type="checkbox">&nbsp;Science and Technology</li>
                                        <li><input type="checkbox">&nbsp;Telecommunication</li>
                                        <li><input type="checkbox">&nbsp;Academia</li>
                                        <li><input type="checkbox">&nbsp;Advertising</li>
                                        <li><input type="checkbox">&nbsp;Agriculture</li>
                                        <li><input type="checkbox">&nbsp;Architecture and Construction</li>
                                        <li><input type="checkbox">&nbsp;Arts</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="collapsed">Date Posted</a>
                                    <ul id="collapse7" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;1 day ago</li>
                                        <li><input type="checkbox">&nbsp;3 day ago</li>
                                        <li><input type="checkbox">&nbsp;Last week</li>
                                        <li><input type="checkbox">&nbsp;Last 15 days</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="collapsed">Employer Type</a>
                                    <ul id="collapse8" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Parmanent</li>
                                        <li><input type="checkbox">&nbsp;Part Time</li>
                                        <li><input type="checkbox">&nbsp;Work From Home</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="collapsed">Top Companies</a>
                                    <ul id="collapse9" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Tata Consultancy Services</li>
                                        <li><input type="checkbox">&nbsp;Wipro</li>
                                        <li><input type="checkbox">&nbsp;Wevcoir</li>
                                        <li><input type="checkbox">&nbsp;Visteco Ltd</li>
                                        <li><input type="checkbox">&nbsp;Vodafone</li>
                                        <li><input type="checkbox">&nbsp;Airtel</li>
                                        <li><input type="checkbox">&nbsp;Sarvtech india</li>
                                        <li><input type="checkbox">&nbsp;HCL</li>
                                        <li><input type="checkbox">&nbsp;Talentica</li>
                                    </ul>
                                </div>
                                <div class="panel">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse10" class="collapsed">Skills</a>
                                    <ul id="collapse10" class="collapse filtent">
                                        <li><input type="checkbox">&nbsp;Java Devloper</li>
                                        <li><input type="checkbox">&nbsp;C & C++ Devloper</li>
                                        <li><input type="checkbox">&nbsp;IOS Devloper</li>
                                        <li><input type="checkbox">&nbsp;Web Designer</li>
                                        <li><input type="checkbox">&nbsp;PHP Devloper</li>
                                        <li><input type="checkbox">&nbsp;Android Devloper</li>
                                        <li><input type="checkbox">&nbsp;Game Devloper</li>
                                        <li><input type="checkbox">&nbsp;Digital Marketing</li>
                                        <li><input type="checkbox">&nbsp;Graphic Designer</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-lg-12 jobsearch sbanner clearfix">
                        <div class="js1">
                            <input type="text" placeholder="Job role, keywords or company name">
                            <span class="sicon">
                                <i class="icon-briefcase"></i>
                            </span>
                        </div>
                        <div class="js2">
                            <input type="text" placeholder="Location">
                            <span class="sicon">
                                <i class="icon-location2"></i>
                            </span>
                        </div>
                        <button>FIND JOBS</button>
                    </div>
                    
                    <!--start job div -->
                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/webcoir.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="{{URL::to('user/jobdetail')}}"><h2>Technical Support Consultant/Product Support</h2></a>
                                <h6>Webcoir IT Solutions Pvt Ltd</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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
                   <!--end --> 
                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/visteco.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="job_detail.php"><h2>Software Engineer(Frontend)</h2></a>
                                <h6>Visteco Ltd</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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

                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/Sarvtech_logo.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="job_detail.php"><h2>Junior Engineer</h2></a>
                                <h6>Sarvtech India</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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
                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/webcoir.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="job_detail.php"><h2>Technical Support Consultant/Product Support</h2></a>
                                <h6>Webcoir IT Solutions Pvt Ltd</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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

                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/visteco.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="job_detail.php"><h2>Software Engineer(Frontend)</h2></a>
                                <h6>Visteco Ltd</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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

                    <div class="col-lg-12 jobbox">
                        <div class="row dopost">
                            <img src="images/Golden.png" alt=""/>
                            <span>2 days ago</span>
                        </div>
                        <div class="row">
                            <div class="joblogo">
                                <img src="images/logos/Sarvtech_logo.png" alt=""/>
                            </div>
                            <div class="jobtitle">
                                <a href="job_detail.php"><h2>Junior Engineer</h2></a>
                                <h6>Sarvtech India</h6>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>1 - 3 Years</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                        <span>5 - 7 LPA</span>
                                        <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>Mumbai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <p>About the Company: Wingify is an India based fast-growing software company that makes technology products that are globally admired such as Visual Website Optimizer and PushCrew. O... <a href="job_detail.php">read more</a></p>
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

<script>
    var slider = document.getElementById('test5');
    noUiSlider.create(slider, {
        start: [20, 80],
        connect: true,
        step: 1,
        range: {
            'min': 0,
            'max': 100
        },
        format: wNumb({
            decimals: 0
        })
    });
</script>

@endsection