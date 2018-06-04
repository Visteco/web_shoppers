@extends('layouts.app')


@section('content')



<!-- Start Home Page Slider -->
<section id="page-top">
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#main-slide" data-slide-to="0" class="active"></li>
            <li data-target="#main-slide" data-slide-to="1"></li>
            <li data-target="#main-slide" data-slide-to="2"></li>
            <li data-target="#main-slide" data-slide-to="3"></li>
            <li data-target="#main-slide" data-slide-to="4"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="img-responsive" src="images/banner.jpg" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h1 class="animated1">
                            <span><strong>Know your</strong>customers</span>
                        </h1>
                        <h1 class="animated2">
                            <span><strong>Grow your</strong>business</span>
                        </h1>
                        <p class="animated1">Register your business !!</p>
                        <button data-toggle="modal" data-target="#signup" class="page-scroll btn btn-primary animated1">Join Our Community</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="images/banner1.jpg" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h1 class="animated2">
                            <span><strong>Know your</strong>customers</span>
                        </h1>
                        <h1 class="animated3">
                            <span><strong>Grow your</strong>business</span>
                        </h1>
                        <p class="animated2">Register your business !!</p>	
                        <button data-toggle="modal" data-target="#signup" class="page-scroll btn btn-primary animated2">Join Our Community</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="images/banner2.jpg" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h1 class="animated3">
                            <span><strong>Know your</strong>customers</span>
                        </h1>
                        <h1 class="animated4">
                            <span><strong>Grow your</strong>business</span>
                        </h1>
                        <p class="animated3">Register your business !!</p>
                        <button data-toggle="modal" data-target="#signup" class="page-scroll btn btn-primary animated3">Join Our Community</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="images/banner3.jpg" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h1 class="animated4">
                            <span><strong>Know your</strong>customers</span>
                        </h1>
                        <h1 class="animated5">
                            <span><strong>Grow your</strong>business</span>
                        </h1>
                        <p class="animated4">Register your business !!</p>	
                        <button data-toggle="modal" data-target="#signup" class="page-scroll btn btn-primary animated4">Join Our Community</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="images/banner4.jpg" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h1 class="animated5">
                            <span><strong>Know your</strong>customers</span>
                        </h1>
                        <h1 class="animated1">
                            <span><strong>Grow your</strong>business</span>
                        </h1>
                        <p class="animated5">Register your business !!</p>	
                        <button data-toggle="modal" data-target="#signup" class="page-scroll btn btn-primary animated5">Join Our Community</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>

        <!-- Search Box -->
        <div class="sbanner banner_search">
            <div class="bannerbox clearfix">
                <div class="bannerbox1">
                    <input type="" placeholder="Company / User">
                </div>
                <div class="bannerbox2">
                    <select>
                        <option>State</option>
                        <option>Delhi</option>
                        <option>Uttar Pradesh</option>
                        <option>Madhya Pradesh</option>
                        <option>Mharashtra</option>
                    </select>
                </div>
                <div class="bannerbox3">
                    <select>
                        <option>Country</option>
                        <option>Afghanistan</option>
                        <option>Albania</option>
                        <option>Algeria</option>
                        <option>American Samoa</option>
                        <option>England</option>
                        <option>India</option>
                    </select>
                </div>
                <div class="bannerbox4">
                    <button name=""><i class="fa fa-search" aria-hidden="true"></i><span>Search</span></button>
                </div>
            </div>
        </div>

    </div>
    <!-- /carousel -->
</section>
<!-- End Home Page Slider -->

<!-- Start Products Section -->
<section id="products" class="products-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>Companies</h3>
                    <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Start sources items -->
                <ul id="sources-list">
                    <li>
                        <div class="sources-img">
                            <img src="images/logos/1webcoir.png" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Webcoir It Solutions Pvt Ltd</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:70px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="sources-img">
                            <img src="http://brandongaille.com/wp-content/uploads/2014/04/Google-Company-Logo.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Google</div>
                            <div class="comp_add">Chatham, UK</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     
                    <li>
                        <div class="sources-img">
                            <img src="http://www.creanara.com/uploads/ckeditor/6rebil280sg00g4sg.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Tata Consultency Services</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:70px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li> 
                    <li>
                        <div class="sources-img">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/TOSHIBA_Logo.png/375px-TOSHIBA_Logo.png" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Toshiba</div>
                            <div class="comp_add">Chatham, UK</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     

                    <li>
                        <div class="sources-img">
                            <img src="https://1.bp.blogspot.com/-Qjamw3erXas/V6DR7-mJalI/AAAAAAAAApM/WlQLYbO2I8sZLtQaEUTxZtucgmZhg6MjQCLcB/s1600/Citigroup-logo.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">City Bank</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     

                    <li>
                        <div class="sources-img">
                            <img src="http://im.rediff.com/money/2011/may/05employers18.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Ford India ltd</div>
                            <div class="comp_add">Chatham, UK</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:40px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     							
                    <li>
                        <div class="sources-img">
                            <img src="images/logos/Sarvtech_logo.png" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Sarv Tech India Pvt Ltd</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:70px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     
                    <li>
                        <div class="sources-img">
                            <img src="http://skyinfotech.in/admin/placement_companies/Cisco-Company-Logo.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Cisco ltd</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:60px;"></div>

                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     
                    <li>
                        <div class="sources-img">
                            <img src="http://cdn-3.famouslogos.us/images/hp-logo.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Hewlett-Packard</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     
                    <li>
                        <div class="sources-img">
                            <img src="http://3.bp.blogspot.com/-DoIQqthA8vc/VHu_rsyOeFI/AAAAAAAADkI/CJ73TYfxtYg/s1600/Amazon.PNG" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Amazone india</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     
                    <li>
                        <div class="sources-img">
                            <img src="https://paintitblue.files.wordpress.com/2007/03/audi-logo.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Audi</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:70px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>     

                    <li>
                        <div class="sources-img">
                            <img src="http://data1.ibtimes.co.in/en/full/591685/dabur-company-logo.png" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">Dabur</div>
                            <div class="comp_add">Noida, IN</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:50px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li> 
                </ul>
                <!-- End sources items -->
            </div>
        </div>
    </div>
</section>
<!-- End Products Section -->


<!-- Start Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>People</h3>
                    <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Start people items -->
                <ul id="people-list">

                    <li>
                        <div class="people-img">
                            <img src="images/people/p1.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Sarvesh Kumar Yadav</div>
                            <div class="people_des">Web Designer</div>
                            <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p2.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Ankur Sharma</div>
                            <div class="people_des">Web Devloper (Php)</div>
                            <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p3.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Abhishek Sharma</div>
                            <div class="people_des">Web Devloper (Php)</div>
                            <div class="pcmp_name">Webcoir It Solutions Pvt Ltd</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p4.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Vimal Kumar Sharma</div>
                            <div class="people_des">Student</div>
                            <div class="pcmp_name">Agra collage of management and technology</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>							
                    <li>
                        <div class="people-img">
                            <img src="images/people/p5.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Kanchan Gautam</div>
                            <div class="people_des">Student</div>
                            <div class="pcmp_name">KITM Kanpur</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p7.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Nainsi Mehra</div>
                            <div class="people_des">Student</div>
                            <div class="pcmp_name">KITM Kanpur</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p6.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Kalpana</div>
                            <div class="people_des">Student</div>
                            <div class="pcmp_name">Din Dyal Upadhyay Gorakhpur Univercity</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                    <li>
                        <div class="people-img">
                            <img src="images/people/p8.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="people-item">
                            <div class="people_name">Prashant Tiwari</div>
                            <div class="people_des">Student</div>
                            <div class="pcmp_name">Din Dyal Upadhyay Gorakhpur Univercity</div>
                            <div class="people_add">Noida, IN</div>
                        </div>
                        <button class="followbtn">Follow</button>
                    </li>
                </ul>
                <!-- End sources items -->
            </div>
        </div>
    </div>
</section>
<!-- End Services Section -->	




@endsection

