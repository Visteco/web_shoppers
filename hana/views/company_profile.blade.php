@extends('layouts.authorised')
@section('content')
<section class="profile-section">
    <div class="container-fluid">
        <div class="row uprofilecover">
            <img src="images/banner2.jpg"/>
            <span class="imgicon"> 
                <span class="glyphicon glyphicon-camera"></span>
                <input type="file" name="file" id="" required="">
            </span>
        </div>			

        <div class="container no-gutter">	
            <div class="row">
                <div class="uprofile clearfix">
                    <div class="uprofilepic">
                        <img src="images/logos/1webcoir.png">
                        <span class="imgicon"> 
                            <span class="glyphicon glyphicon-camera"></span>
                            <input type="file" name="file" id="" required="">
                        </span>
                    </div>
                    <div class="uprodetail clearfix">
                        <div class="uproname">                            
                            <div class="uprofilename">Webcoir IT Solutions Pvt Ltd</div>	
                            <div class="uprofiledes">Software Devlopment Company</div>	
                            <div class="uprofilecomp">at <a href="">Noida, IN</a></div>	
                            <div class="uprofilecomp">Working on website App's and software devlopment in Delhi NCR</div>	
                        </div>	
                    </div>
                    <div class="uprosocial clearfix">                                
                        <div class="uprosoc">                            
                            <div class="uprofilesoc">
                                <h6>Connect with us:</h6>                                    
                                <ul class="list-inline">
                                    <li><a href="www.facebook.com/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.twitter.com/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.plus.google.com/112145125284435166362" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.youtube.com/channel/UCPUMlBfy1ymuVFg5mN3jfjA" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.secure.skype.com/portal/overview?intsrc=client-_-windows-_-7.29.0.102-_-menu.account" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                                    <li><a href="www.linkedin.com/in/sarveshyadavcs" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>
                                </ul>
                            </div>                          
                            <div class="col-lg-12 no-gutter">
                                <button class="skybtn">Message</button>
                                <button class="skybtn">Follow</button>
                            </div>
                            <div class="col-lg-12 no-gutter uprofilerate clearfix">
                                <div class="rating">
                                    <div class="star_review_comp">
                                        <div class="star_disabled_comp"></div>
                                        <div class="star_active_comp" style="width:70px;"></div>
                                    </div>
                                    <span class="dropdown">
                                        <span class="caret point" data-toggle="dropdown"></span>
                                        <ul class="dropdown-menu  dropdown-menu-right" role="menu">
                                            <li><a href="">sarvesh1</a></li>
                                            <li><a href="">sarvesh2</a></li>
                                            <li><a href="">sarvesh3</a></li>
                                        </ul>
                                    </span>
                                </div>
                                <div class="review">
                                    <button class="btn btn-primary">Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="follow_count"><h2>350</h2><p>Followers</p></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ URL::to('company/services') }}"><h4>Our Services <span class="pull-right skybtn">Add Services</span></h4></a>
                    <div class="clients services">
                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/it-professional.jpg" class="img-responsive" alt="...">
                                <h4>It Professional</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/app-developer-london-uk.png" class="img-responsive" alt="...">
                                <h4>App Developement</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/ergonomics.jpg" class="img-responsive" alt="...">
                                <h4>Ergonomics Services</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/lighting.jpg" class="img-responsive" alt="...">
                                <h4>Lighting Services</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/flooring.jpg" class="img-responsive" alt="...">
                                <h4>Flooring Services</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/panel_systems.jpg" class="img-responsive" alt="...">
                                <h4>Panel Systems</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/flooring.jpg" class="img-responsive" alt="...">
                                <h4>Flooring Services</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/desks.jpg" class="img-responsive" alt="...">
                                <h4>Furniture Store</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/data_centers.jpg" class="img-responsive" alt="...">
                                <h4>Data Centers</h4></a>
                        </div>

                        <div class="col-md-12">
                            <a href="service_detail.php"><img src="images/projects/accessories.jpg" class="img-responsive" alt="...">
                                <h4>Accessories</h4></a>
                        </div>
                    </div>
                </div>
            </div>				
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs profile-tab">
                        <li class="active"><a data-toggle="tab" href="#trending">
                                <i class="icon-stats-dots"></i><span>Trending</span></a></li>
                        <li><a data-toggle="tab" href="#portfolio">
                                <i class="icon-images"></i><span>Gallery</span></a></li>
                        <li><a data-toggle="tab" href="#rteam">
                                <i class="icon-users"></i><span>Team</span></a></li>
                        <li><a data-toggle="tab" href="#ad">
                                <i class="icon-bullhorn"></i><span>Ad Board</span></a></li>
                        <li><a data-toggle="tab" href="#vcards">
                                <i class="icon-profile"></i><span>vLetters</span></a></li>
                        <li><a data-toggle="tab" href="#bookmark">
                                <i class="icon-bookmarks"></i><span>Bookmarks</span></a></li>
                        <li><a data-toggle="tab" href="#profile">
                                <i class="icon-user"></i><span>Profile</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="col-md-12 tab-pane fade in active" id="trending">

                            <div class="post-box clearfix">
                                <ul class="post-list">
                                    <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                    <li><a href="">Webcoir IT Solutions Pvt Ltd </a><span>Monday, 02 june 2016</span>
                                        <p>IT Company at <a href="">Noida, IN</a></p></li>
                                    <li><a href=""><i class="glyphicon glyphicon-remove"></i></a></li>
                                </ul>
                                <ul class="post-item">
                                    <li><p>
                                            Visteco business network helps introduce your business to other businesses around you locally, nationally and internationally. You can now see and interconnect with businesses surrounding you in your local area much easier. Search for partnerships or introduce your services and receive feedback. Simply exchange your contacts by using Vcard technology.
                                        </p></li>
                                    <li><img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg"></li>
                                </ul>
                                <ul class="post-soc">
                                    <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                    <li><i class="glyphicon glyphicon-comment"></i> Comment</li>
                                    <li><i class="glyphicon glyphicon-bookmark"></i> Bookmark</li>
                                    <li><i class="glyphicon glyphicon-share"></i> Share</li>
                                </ul>
                                <ul class="post-cmnt clearfix">
                                    <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                                    <li>
                                        <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                            <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                                        <p>IT Company at <a href="">Noida, IN</a></p> 
                                        <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSX
                                        </p>
                                        <ul class="post-soc">
                                            <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                            <li><i class="glyphicon glyphicon-comment"></i> Comment</li>
                                            <li><i class="glyphicon glyphicon-comment"></i> Reply</li>
                                            <ul class="post-cmnt clearfix">
                                                <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                                <li> 
                                                    <input name="cmnt" type="text">
                                                </li>
                                            </ul>
                                            <ul class="post-cmnt clearfix">
                                                <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                                                <li>
                                                    <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                                        <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                                                    <p>IT Company at <a href="">Noida, IN</a></p>  
                                                    <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSX
                                                    </p>
                                                    <ul class="post-soc">
                                                        <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                                        <li><i class="glyphicon glyphicon-comment"></i> Reply</li>

                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="post-cmnt clearfix">
                                                <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                                                <li>
                                                    <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                                        <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                                                    <p>IT Company at <a href="">Noida, IN</a></p>  
                                                    <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSX
                                                    </p>
                                                    <ul class="post-soc">
                                                        <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                                        <li><i class="glyphicon glyphicon-comment"></i> Reply</li>

                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="post-cmnt clearfix">
                                                <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                                                <li>
                                                    <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                                        <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                                                    <p>IT Company at <a href="">Noida, IN</a></p>  
                                                    <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSX
                                                    </p>
                                                    <ul class="post-soc">
                                                        <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                                        <li><i class="glyphicon glyphicon-comment"></i> Reply</li>

                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="post-cmnt clearfix">
                                                <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                                <li> 
                                                    <input name="cmnt" type="text">
                                                </li>
                                            </ul>

                                        </ul>
                                    </li>
                                </ul>


                                <ul class="post-cmnt clearfix">
                                    <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                                    <li> 
                                        <input type="text" name="cmnt" />
                                    </li>
                                </ul>
                            </div>


                        </div>

                        <div class="col-md-12 tab-pane fade" id="portfolio">
                            <ul class="projects-list">
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/accessories.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Accessories</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/art.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Art</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/data_centers.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Data Centers</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/desks.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Desks</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/ergonomics.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Ergonomics</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/flooring.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Flooring</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/lighting.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Lighting</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="projects-item">
                                        <img src="images/projects/panel_systems.jpg" class="img-responsive" alt="" />
                                        <div class="projects-caption">
                                            <h4>Panel Systems</h4>
                                            <a href="#projects-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                            <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="rteam">
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
                            </ul>
                            <!-- End sources items -->
                        </div>

                        <div class="col-md-12 tab-pane fade" id="ad">

                        </div>

                        <div class="col-md-12 tab-pane fade" id="vcards">
                            <?php include("include/vletter.php") ?>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="bookmark">
                            <div class="post-box clearfix">
                                <ul class="post-list">
                                    <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                                    <li><a href="">Webcoir IT Solutions Pvt Ltd </a><span>Monday, 02 june 2016</span>
                                        <p>IT Company at <a href="">Noida, IN</a></p></li>
                                    <li><a href=""><i class="glyphicon glyphicon-remove"></i></a></li>
                                </ul>
                                <ul class="post-item">
                                    <li><p>
                                            Visteco business network helps introduce your business to other businesses around you locally, nationally and internationally. You can now see and interconnect with businesses surrounding you in your local area much easier. Search for partnerships or introduce your services and receive feedback. Simply exchange your contacts by using Vcard technology.
                                        </p></li>
                                    <li><img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg"></li>
                                </ul>
                                <ul class="post-soc">
                                    <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                                    <li><i class="glyphicon glyphicon-comment"></i> Comment</li>
                                    <li><i class="glyphicon glyphicon-bookmark"></i> Bookmark</li>
                                    <li><i class="glyphicon glyphicon-share"></i> Share</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 tab-pane fade" id="profile">
                            <div class="pro-text">

                                <h3>Basic Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" placeholder="Company Name *">
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                    <div class="col-md-6">
                                        <label>Incorporation Date</label>
                                        <input type="date" class="form-control">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>City</label>
                                        <input type="text" class="form-control" placeholder="City *">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="col-md-2"><label>State</label>
                                        <input type="text" class="form-control" placeholder="State *">
                                        <p class="help-block text-danger"></p>
                                    </div>                                           
                                    <div class="col-md-2"><label>Zip</label>
                                        <input type="text" class="form-control" placeholder="Zip *">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="col-md-2"><label>Country</label>
                                        <input type="text" class="form-control" placeholder="Country *">
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Phone Number *">
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                    <div class="col-md-6"><label>Email Id</label>
                                        <input type="text" class="form-control" placeholder="Email Id *">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><label>Primary Track (Select up to two)</label></div> 
                                    <div class="col-md-12"><p>*Helps other users find you in the People Search</p></div>
                                    <div class="col-md-12  form-group">
                                        <div class="col-md-6">
                                            <div><input type="checkbox"> Administrator</div>
                                            <div><input type="checkbox"> Architect/ Designer</div>
                                            <div><input type="checkbox"> Information Technology</div>
                                            <div><input type="checkbox"> Dealer</div>
                                            <div><input type="checkbox"> Facility Manager</div>
                                            <div><input type="checkbox"> Health & Safety</div>
                                            <div><input type="checkbox"> Human Resources</div>
                                            <div><input type="checkbox"> Installer/Mover</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div><input type="checkbox"> Manufacturer</div>
                                            <div><input type="checkbox"> Marketing</div>
                                            <div><input type="checkbox"> Purchasing</div>
                                            <div><input type="checkbox"> Representatives</div>
                                            <div><input type="checkbox"> Sales</div>
                                            <div><input type="checkbox"> Shop</div>
                                            <div><input type="checkbox"> Tech Support</div>
                                            <div><input type="checkbox"> Other</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  form-group">
                                        <label>About Us</label>
                                        <textarea class="form-control" placeholder="Your Messages *"  style="height:150px;"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  form-group center" style="text-align:center;">
                                        <button class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>

                            </div>	

                        </div>
                    </div>
                </div>
                <div class="col-md-3 about_box">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5>Followers <a href="{{ URL::to('company/followers') }}" class="pull-right">See All</a></h5>
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
                            </ul>
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
                                        <div class="pcmp_name">ACMT Collage Agra</div>
                                        <div class="people_add">Noida, IN</div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>	
                            </ul>
                        </div>
                    </div>		      
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5>Following <a href="{{ URL::to('company/followings') }}" class="pull-right">See All</a></h5>
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
                            </ul>
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
                                        <div class="pcmp_name">ACMT Collage Agra</div>
                                        <div class="people_add">Noida, IN</div>
                                    </div>
                                    <button class="followbtn">Follow</button>
                                </li>	
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 about_box">
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Working Day</h5> 
                            <p>Mon-Fri 10:00 to 07:00</p>  
                            <p>Saturday 10:00 to 02:00</p>  
                            <p>Weekly Sunday off</p>
                        </div>
                    </div>
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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Our Clients</h4>
                    <div class="clients">

                        <div class="col-md-12">
                            <img src="images/logos/themeforest.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/creative-market.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/designmodo.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/creative-market.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/microlancer.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/themeforest.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/microlancer.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/designmodo.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/creative-market.jpg" class="img-responsive" alt="...">
                        </div>

                        <div class="col-md-12">
                            <img src="images/logos/designmodo.jpg" class="img-responsive" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End sources Section -->


@endsection
