<?php 
if( strlen($userImg) > 0){
    $profilePic = URL::to('/userimages/user_'.$userID.'/medium/'.$userImg);
}else{
    $profilePic = URL::to('images/user.png');
}

?>

<div class="vcrd">
    
    
    <img src="{{ $profilePic }}">
    
    <div class="uproname">                             
        <div class="uprofilename">{{ $fullname }}</div>	
        <div class="uprofiledes">{{ $designation }}</div>	
        <div class="uprofilecomp">at <a href="">{{ $organisation }}</a></div>	
    </div>
    <div class="vcrd_soc">
        <button class="btn btn-primary">Print</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#share">Share</button>
        <ul class="list-inline">
            <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
            <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
            <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>
            <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
            <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>
        </ul>
    </div>
</div>

<div class="col-lg-12 no-gutter table-responsive">
    <div class="col-lg-6 no-gutter"><h4>Pending Cards</h4></div>
    <div class="col-lg-6 no-gutter"><!--<input type="text" class="form-control" placeholder="Serch Contact">--></div>
    <table class="table table-striped tbl_list">
        <tbody>
            
            @foreach($pendingCards as $pendingCard)
            <?php 
            if(isset($pendingCard->img)) {
                $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->img);
            }else{
                $profile = URL::to("images/user.png");
            }
            
            $name = $pendingCard->fname." ".$pendingCard->lname;
            
            
                
            ?>
            
            <tr>
                
                <td>
                    <img src="{{ $profile }}" alt="...">
                </td>
                
                <td width="50%">
                    <div class="comp_name">{{ $name }}</div>
                    <div class="comp_add">{{ $pendingCard->city }} , {{ $pendingCard->country }}</div>	
                </td>
                
                <td style="text-align:right;">
                    
                    <a class="pointer" data-toggle="modal" data-target="{{'#user_card_'.$pendingCard->card_id}}"><i class="icon-eye">&nbsp;</i></a>
                    
                    <a  onclick="approveCard(this)" id="{{ URL::to("api/aprvusercard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Approve</a>
                    <a onclick="rejectCard(this)" id="{{ URL::to("api/rejectusercard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Reject</a>
                    
                    
                </td>
            </tr>
            @endforeach
            
            
        </tbody>
    </table>
</div>


<div class="col-lg-12 no-gutter table-responsive">
    <div class="col-lg-6 no-gutter"><h4>All Cards</h4></div>
    <div class="col-lg-6 no-gutter"><!--<input type="text" class="form-control" placeholder="Serch Contact">--></div>
    <table class="table table-striped tbl_list">
        <tbody>
            
            @foreach($approvedCards as $pendingCard)
            <?php 
            if(isset($pendingCard->img)) {
                $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->img);
            }else{
                $profile = URL::to("images/user.png");
            }
            
            $name = $pendingCard->fname." ".$pendingCard->lname;
                 
            ?>
            
            <tr>
                
                <td>
                    <img src="{{ $profile }}" alt="...">
                </td>
                
                <td width="50%">
                    <div class="comp_name">{{ $name }}</div>
                    <div class="comp_add">{{ $pendingCard->city }} , {{ $pendingCard->country }}</div>	
                </td>
                
                <td style="text-align:right;">
                    
                    <a class="pointer" data-toggle="modal" data-target="{{'#user_card_'.$pendingCard->card_id}}"><i class="icon-eye">&nbsp;</i></a>
                    
                    <a  onclick="approveCard(this)" id="{{ URL::to("api/aprvusercard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Approve</a>
                    <a onclick="rejectCard(this)" id="{{ URL::to("api/rejectusercard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Reject</a>
                    
                    
                </td>
            </tr>
            @endforeach
            
            
        </tbody>
    </table>
</div>

<!-- Modal -->
@foreach($pendingCards as $pendingCard)
<?php 
   if(isset($pendingCard->img)) {
         $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->img);
     }else{
         $profile = URL::to("images/user.png");
    }
  ?>
<div class="modal fade model_offset in sarv-model" id="{{'user_card_'.$pendingCard->card_id}}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog sarv-model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3>{{ $pendingCard->fname." ".$pendingCard->lname }} 's Card</h3>
            </div>
            <div class="modal-body" style="padding: 0px 55px;">
                <div class="row">
                    <div class="vcrd">
                        <img src="{{ $profile }}">
                        <div class="uproname">  
                            <div class="uprofiledes">{{ $pendingCard->fname." ".$pendingCard->lname }}</div>
                            <div class="uprofilecomp">{{ $pendingCard->pres_desg }}</div>
                            <div class="uprofilecomp">at  <a href="">{{ $pendingCard->pres_org }}</a></div>	
                        </div>
                        <div class="vcrd_soc">
                            <button class="btn btn-primary">Sahre</button>
                            <ul class="list-inline">
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>

@endforeach





@foreach($approvedCards as $pendingCard)
<?php 
   if(isset($pendingCard->img)) {
         $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->img);
     }else{
         $profile = URL::to("images/user.png");
    }
  ?>
<div class="modal fade model_offset in sarv-model" id="{{'user_card_'.$pendingCard->card_id}}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog sarv-model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3>{{ $pendingCard->fname." ".$pendingCard->lname }} 's Card</h3>
            </div>
            <div class="modal-body" style="padding: 0px 55px;">
                <div class="row">
                    <div class="vcrd">
                        <img src="{{ $profile }}">
                        <div class="uproname">  
                            <div class="uprofiledes">{{ $pendingCard->fname." ".$pendingCard->lname }}</div>
                            <div class="uprofilecomp">{{ $pendingCard->pres_desg }}</div>
                            <div class="uprofilecomp">at  <a href="">{{ $pendingCard->pres_org }}</a></div>	
                        </div>
                        <div class="vcrd_soc">
                            <button class="btn btn-primary">Sahre</button>
                            <ul class="list-inline">
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
                                <li><a href="" target="_blank"><span class="fa-stack fa-md"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>

@endforeach












<!-- Modal -->
<div class="modal fade model_offset in sarv-model" id="share" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog sarv-model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3><input type="checkbox">&nbsp; Select All</h3>
            </div>
            <div class="modal-body" style="padding: 0px 15px;">
                <div class="row">
                    <div class="col-lg-12 no-gutter table-responsive">
                        <table class="table table-striped tbl_list">
                            <tbody>
                                <tr>
                                    <td><img src="images/people/p1.jpg" alt="...">
                                    </td>
                                    <td width="60%">
                                        <div class="people_name">Ankur Sharma</div>
                                        <div class="people_des">Web Devloper (Php)</div>	
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p3.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Abhishek Sharma</div>
                                        <div class="people_des">Web Devloper (Php)</div>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p4.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Vimal Kumar Sharma</div>
                                        <div class="people_des">Student</div>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p5.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Kanchan Gautam</div>
                                        <div class="people_des">Student</div>	
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p2.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Nainsi Mehra</div>
                                        <div class="people_des">Student</div>	
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p1.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Kalpana</div>
                                        <div class="people_des">Student</div>	
                                    </td>
                                    <td width="40%" style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="images/people/p3.jpg" alt="..."></td>
                                    <td>
                                        <div class="people_name">Prashant Tiwari</div>
                                        <div class="people_des">Student</div>	
                                    </td>
                                    <td style="text-align:right;">
                                        <a href=""><i class="icon-phone">&nbsp;</i></a>
                                        <a href=""><i class="icon-bubble">&nbsp;</i></a>
                                        <a class="pointer" data-toggle="modal" data-target="#ankur_card"><i class="icon-eye">&nbsp;</i></a>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>



