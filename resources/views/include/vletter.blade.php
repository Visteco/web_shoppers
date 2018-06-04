<div class="vletter">
	<img src="{{ $profilePic }}">
	<div class="uproname">                             
        <div class="uprofilename">{{ $company->company_name }}</div>	
        <div class="uprofiledes">{{ $company->company_type }}</div>	
        <div class="uprofilecomp">at <a href="">{{ $company->company_city }}, {{ $company->country }}</a></div> 
        <div class="uprofilecomp">{{ $company->about_us }}</div>		
	</div>
	<div class="uproname"> 
		
                <h4>Our Services :</h4>
                
                @foreach($services as $key => $service)
                    <div><strong>*</strong> <a href="">{{ $service->service_title }}</a></div>
                @endforeach
                
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
    <div class="col-lg-12 no-gutter"><h4>Pending Cards</h4></div>
    
    <table class="table table-striped tbl_list">
        <tbody>
        
            @foreach($pendingCards as $pendingCard)
            <?php 
            if(isset($pendingCard->logo_img)) {
                $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->logo_img);
            }else{
                $profile = URL::to("images/user.png");
            }
            
                
            ?>
            
            <tr>
                
                <td>
                    <img src="{{ $profile }}" alt="...">
                </td>
                
                <td width="50%">
                    <div class="comp_name">{{ $pendingCard->company_name }}</div>
                    <div class="comp_add">{{ $pendingCard->company_city }} , {{ $pendingCard->country }}</div>	
                </td>
                
                <td style="text-align:right;">
                    
                    <a class="pointer" data-toggle="modal" data-target="{{'#webcoir_card_'.$pendingCard->card_id}}"><i class="icon-eye">&nbsp;</i></a>
                    
                    <a  onclick="approveCard(this)" id="{{ URL::to("api/aprvbusinesscard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Approve</a>
                    <a onclick="rejectCard(this)" id="{{ URL::to("api/rejectcompanycard/?card_id=".$pendingCard->card_id."&user_id=".Auth::user()->id) }}" class="btn btn-primary">Reject</a>
                    
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    
</div>

<div class="col-lg-12 no-gutter table-responsive">
    <div class="col-lg-6 no-gutter"><h4>All Cards</h4></div>
    <div class="col-lg-6 no-gutter"><input type="text" class="form-control" placeholder="Serch Contact"></div>
    
    <table class="table table-striped tbl_list">
        <tbody>
           @foreach($approvedCards as $approvedCard)
            <?php 
            if(isset($approvedCard->logo_img)) {
                $profile= URL::to("userimages/user_".$approvedCard->uid."/"."medium/".$approvedCard->logo_img);
            }else{
                $profile = URL::to("images/user.png");
            }
            
                
            ?>
            
            <tr>
                
                <td>
                    <img src="{{ $profile }}" alt="...">
                </td>
                
                <td width="50%">
                    <div class="comp_name">{{ $approvedCard->company_name }}</div>
                    <div class="comp_add">{{ $approvedCard->company_city }} , {{ $approvedCard->country }}</div>	
                </td>
                
                <td style="text-align:right;">
                    
                    <a class="pointer" data-toggle="modal" data-target="{{'#webcoir_card_'.$approvedCard->card_id}}"><i class="icon-eye">&nbsp;</i></a>
                    <a  onclick="approveCard(this)" id="{{ URL::to("api/aprvbusinesscard/?card_id=".$approvedCard->card_id) }}" class="btn btn-primary">Approve</a>
                    <a onclick="rejectCard(this)" id="{{ URL::to("api/rejectcompanycard/?card_id=".$approvedCard->card_id) }}" class="btn btn-primary">Reject</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>




<!-- Modal -->

@foreach($pendingCards as $pendingCard)
<?php 
   if(isset($pendingCard->logo_img)) {
         $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->logo_img);
     }else{
         $profile = URL::to("images/user.png");
    }
  ?>
<div class="modal fade model_offset in sarv-model" id="{{'webcoir_card_'.$pendingCard->card_id}}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog sarv-model" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h3>Visteco Letter</h3>
			</div>
			<div class="modal-body" style="padding: 0px 24px;">
				<div class="row">
					<div class="vletter">
						<img src="{{ $profile}}">
						<div class="uproname">                             
							<div class="uprofilename">{{ $pendingCard->company_name }}</div>	
							<div class="uprofiledes">{{ $pendingCard->company_type }}</div>	
							<div class="uprofilecomp">at <a href="">{{ $pendingCard->company_city }}, {{ $pendingCard->country }}</a></div> 
							<div class="uprofilecomp">{{ $pendingCard->about_us }}</div>		
						</div>
						<div class="uproname"> 
							<h4>Our Services :</h4>
							<div><strong>1.</strong> <a href="">It Professional</a></div>
							<div><strong>2.</strong> <a href="">App Developement</a></div>
							<div><strong>3.</strong> <a href="">Ergonomics Services</a></div>
							<div><strong>4.</strong> <a href="">Lighting Services</a></div>
							<div><strong>5.</strong> <a href="">Flooring Services</a></div>
						</div>
						<div class="vcrd_soc">
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
				</div>				
			</div>
		</div>
	</div>
</div>
@endforeach

<!-- Modal -->


<!-- Modal -->

@foreach($approvedCards as $pendingCard)
<?php 
   if(isset($pendingCard->logo_img)) {
         $profile= URL::to("userimages/user_".$pendingCard->uid."/"."medium/".$pendingCard->logo_img);
     }else{
         $profile = URL::to("images/user.png");
    }
  ?>
<div class="modal fade model_offset in sarv-model" id="{{'webcoir_card_'.$pendingCard->card_id}}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog sarv-model" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h3>Visteco Letter</h3>
			</div>
			<div class="modal-body" style="padding: 0px 24px;">
				<div class="row">
					<div class="vletter">
						<img src="{{ $profile}}">
						<div class="uproname">                             
							<div class="uprofilename">{{ $pendingCard->company_name }}</div>	
							<div class="uprofiledes">{{ $pendingCard->company_type }}</div>	
							<div class="uprofilecomp">at <a href="">{{ $pendingCard->company_city }}, {{ $pendingCard->country }}</a></div> 
							<div class="uprofilecomp">{{ $pendingCard->about_us }}</div>		
						</div>
						<div class="uproname"> 
							<h4>Our Services :</h4>
							<div><strong>1.</strong> <a href="">It Professional</a></div>
							<div><strong>2.</strong> <a href="">App Developement</a></div>
							<div><strong>3.</strong> <a href="">Ergonomics Services</a></div>
							<div><strong>4.</strong> <a href="">Lighting Services</a></div>
							<div><strong>5.</strong> <a href="">Flooring Services</a></div>
						</div>
						<div class="vcrd_soc">
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
				</div>				
			</div>
		</div>
	</div>
</div>
@endforeach

<!-- Modal -->
