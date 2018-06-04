@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-6">
                
                <div class="pro_text jobbox">
                <form method="post" action="{{ url('company/createservice') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}    
                    
                    @if(isset($fetchToUpdate) && $fetchToUpdate)
                    <input type="hidden" name="service_id" value="{{$oldService->id}}">
                    @endif
                    <h3>Add Services </h3>
                    <div class="row">
                        <div class="col-md-6">
                            
                            @if( isset($success) )
                                <div class="alert alert-success">{{ $success }}</div>
                            @endif
                            
                            
                            
                            <label>Service Title</label>
                            <?php $st= isset($oldService->service_title) ? $oldService->service_title : old('service_title');?>
                            <input name="service_title" type="text" class="form-control" placeholder="what is the title of your servce ?" value="{{ $st }}">
                            @if ($errors->update->has('service_title')) <p class="help-block text-danger">{{ $errors->update->first('service_title') }}</p> @endif
                            
                            <label>Service Image</label>
                            <input type="file"  name="image" placeId="serimg" class="imgInp form-control" placeholder="" >
                            @if ($errors->update->has('image')) <p class="help-block text-danger">{{ $errors->update->first('image') }}</p> @endif
                            
                        </div>                                            
                        <div class="col-md-6">
                            
                            @if(isset($oldService->image))
                                    <img id="serimg" src="{{ URL::to("images/services/".$oldService->image) }}" alt="" class="showimg"/>
                            @else
                                    <img id="serimg" src="" alt="" class="showimg"/>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Service Description</label>
                            <?php $sd= isset($oldService->service_description) ? $oldService->service_description : old('service_description');?>
                            <textarea name="service_description" class="form-control" placeholder="write your service description here!">{{$sd}}</textarea>
                            @if ($errors->update->has('service_description')) <p class="help-block text-danger">{{ $errors->update->first('service_description') }}</p> @endif
                        </div>
                    </div>
                    <div class="row">                               
                        <div class="col-md-12">
                            <br>
                            <input type="submit" class="skybtn" value="Submit">
                        </div>
                    </div>
                    
                </form>
                    <h3>Add Services List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped tt">
                            <thead>
                                <tr>
                                    <th width="70px">Image</th>
                                    <th>Service Title</th>
                                    <th  width="70px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($services as $service)    
                                <tr id="{{ "service_".$service->id }}">
                                    <td><img src="{{ URL::to("images/services/".$service->image) }}" class="ssimg" alt="..."></td>
                                    <td>{{ $service->service_title }}</td>
                                    <td>
                                        <a href="{{ URL::to("service/edit/".$service->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                        <a onclick="deleteService('{{URL::to("service/delete/".$service->id)}}','{{ "service_".$service->id }}')" ><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach    
                            </tbody>
                        </table>
                    </div>
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
                        <h5>Recentely Added Services</h5>						
                        <?php 
                        if(count($services) > 5 ){
                            $c=5;
                        }else{
                            $c=count($services);
                        }
                        ?>
                        
                        @for($i=0;$i<$c;$i++)
                        <?php $service = $services[$i]; ?>
                        <a href=""><h4>{{$service->service_title}}</h4></a>
                        <p>add by : <a href="">{{ "Added by you!!"}}</a></p>                        
                        <a href=""><img src="{{ URL::to("images/services/".$service->image) }}" width="100%" alt="..."></a>
                        @endfor
                        
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
                <div class="row">
                    @include("include.footer_login")
                </div>
            </div>
        </div>


    </div>
</section>

<script type="text/javascript">
function deleteService(link,service_id){
    
    var txt;
    var r = confirm("Are You sure to delete this service!!");
    if (r == true) {
        $.get(link, function(data, status){
               if(data){
                    var me = document.getElementById(service_id);
                    me.parentNode.removeChild(me);   
               }else{
                   bootbox.alert('Sorry, error while deleting this service!');
               }
                
            });  
    } 
    
    /*
    
    
    
    
    confirm({
    message: "Are you sure to delete this service ?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        if(result){
          $.get(link, function(data, status){
               if(data){
                    var me = document.getElementById(service_id);
                    me.parentNode.removeChild(me);   
               }else{
                   bootbox.alert('Sorry, error while deleting this service!');
               }
                
            });  
        }
    }
});*/
}
</script>
<!-- End sources Section -->

@endsection
