@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-6">
                <div class="pro_text jobbox">
                    <h3>Add Services </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Service Title</label>
                            <input type="text" class="form-control" placeholder="">
                            <p class="help-block text-danger"></p>

                            <label>Service Image</label>
                            <input type="file" placeId="serimg" class="imgInp form-control" placeholder="">
                            <p class="help-block text-danger"></p>
                        </div>                                            
                        <div class="col-md-6">
                            <img id="serimg" src="" alt="" class="showimg"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Service Description</label>
                            <textarea class="form-control"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row">                               
                        <div class="col-md-12">
                            <input type="submit" class="skybtn" value="Submit">
                        </div>
                    </div>

                    <h3>Add Services List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped tt">
                            <thead>
                                <tr>
                                    <th width="10%">Image</th>
                                    <th width="70%">Service Title</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="10%"><img src="images/projects/it-professional.jpg" class="ssimg" alt="..."></td>
                                    <td width="70%">It Professional</td>
                                    <td width="20%">
                                        <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                        <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/projects/app-developer-london-uk.png" class="ssimg" alt="..."></td>
                                    <td>App Developement</td>
                                    <td>
                                        <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                        <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/projects/lighting.jpg" class="ssimg" alt="..."></td>
                                    <td>Lighting Services</td>
                                    <td>
                                        <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                        <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/projects/flooring.jpg" class="ssimg" alt="..."></td>
                                    <td>Flooring Services</td>
                                    <td>
                                        <a href=""><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                        <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="post-box clearfix">
                    <ul class="post-list">
                        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                        <li><a href="">Webcoir IT Solutions Pvt Ltd </a><span>Monday, 02 june 2016</span>
                            <p>IT Company at <a href="">Noida, IN</a></p></li>
                        <li><a href=""><i class="glyphicon glyphicon-remove"></i></a></li>
                    </ul>
                    <ul class="post-item">
                        <li><p>
                                <a href="">Webcoir IT Solutions Pvt Ltd </a> add new service App Devlopment technology.
                            </p></li>
                        <li><img src="images/projects/app-developer-london-uk.png"></li>
                    </ul>
                    <ul class="post-soc">
                        <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                        <li><i class="glyphicon glyphicon-comment"></i> Comment</li>
                        <li><i class="glyphicon glyphicon-bookmark"></i> Bookmark</li>
                        <li><i class="glyphicon glyphicon-share"></i> Share</li>
                        <li>
                            <div class="star_review_comp">
                                <div class="star_disabled_comp"></div>
                                <div class="star_active_comp" style="width:70px;"></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="post-cmnt clearfix">
                        <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                        <li>
                            <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                            <p>IT Company at <a href="">Noida, IN</a></p> 
                            <p>wcd wqdg ausdai8sd xsiaSI </p>
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
                <div class="post-box clearfix">
                    <ul class="post-list">
                        <li><a href=""><img src="images/logos/1webcoir.png"></a></li>
                        <li><a href="">Webcoir IT Solutions Pvt Ltd </a><span>Monday, 02 june 2016</span>
                            <p>IT Company at <a href="">Noida, IN</a></p></li>
                        <li><a href=""><i class="glyphicon glyphicon-remove"></i></a></li>
                    </ul>
                    <ul class="post-item">
                        <li><p>
                                <a href="">Webcoir IT Solutions Pvt Ltd </a> add new service Data Centers.
                            </p></li>
                        <li><img src="images/projects/data_centers.jpg"></li>
                    </ul>
                    <ul class="post-soc">
                        <li><i class="glyphicon glyphicon-thumbs-up"></i> Like</li>
                        <li><i class="glyphicon glyphicon-comment"></i> Comment</li>
                        <li><i class="glyphicon glyphicon-bookmark"></i> Bookmark</li>
                        <li><i class="glyphicon glyphicon-share"></i> Share</li>
                        <li>
                            <div class="star_review_comp">
                                <div class="star_disabled_comp"></div>
                                <div class="star_active_comp" style="width:70px;"></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="post-cmnt clearfix">
                        <li><a href=""><img src="images/logos/1webcoir.png"/></a></li>
                        <li>
                            <h5><a href="">Webcoir IT Solutions Pvt Ltd</a> &nbsp; <span>Monday, 02 june 2016</span>
                                <i class="glyphicon glyphicon-remove"></i><i class="glyphicon glyphicon-pencil"></i></h5>
                            <p>IT Company at <a href="">Noida, IN</a></p> 
                            <p>wcd wqdg ausdai8sd xsiaSI </p>
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
<!-- End sources Section -->

@endsection
