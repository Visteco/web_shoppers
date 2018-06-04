<div class="pro-trending clearfix">
    
    <div class="pro-pic">
        @if(empty(Auth::user()->profile))
        <img src="{{ URL::to('images/user.png') }}">
        @else
        <img src="{{ URL::to('images/user.png') }}">
        @endif
    </div>

    <div class="pro-txt">
        <div id="myModal" class="modal-pre">
            <div id="myModalContent"> 
                
                <span class="close pointer" aria-hidden="false" onclick="closeAsModal()">&times;</span>
                
                
                <div id="post_description" class="msg_p" contenteditable="true" onfocus="unsetPlaceHolder(this)" onblur="setPlaceHolder(this)" oninput="searchTagsForUser(this)">Whats's on your mind ?</div>
                
                
                
                <div class="row" style="padding: 0px;" id='external_content'>
                    
                </div> 
                
                <!--<div class="row" style="padding: 3px;">
                    <div class="col-md-12" >
                        
                        <img style="max-width:97%;min-height:308px;min-width:97%;max-height:308px" id="image_id" src="" style="" />
                        
                    </div>
                    
                    <div class="col-md-12">
                        
                        <div class="btn-group">
                            
                            <a id="prev" type="button" class="btn btn-default"><span class="fa fa-backward"></span></a>
                            <a id="next" type="button" class="btn btn-default"><span class="fa fa-forward"></span></a>
                        </div>
                        
                    </div>
                    
                </div>-->
                
                
                
                <ul class="pro-list">
                    <!--<li><a href=""><i class="glyphicon  lyphicon-pencil"></i> Update Status</a></li>-->
                    
                    
                    <!-- starts code for select image -->
                    
                    
                    <li style="padding: 3px;" id="file_preview"> 
                        
                         <img id="imagePreview" style="display:none;" class="pro-pic" src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" />
                         
                         <!--<img id="load_image" class="" style="display:none;"  src="{{ URL::to('images/postloader.gif') }}" />-->
                         
                    </li>
                    
                    <li></li>
                    
                    
                    <!-- ends code for select image -->
                    
                    
                    <li>
                        <input id="post_file" type="file" onchange="validateFile(this)"> <!--<i class="glyphicon glyphicon-camera"></i> <input type="file" name="file" style="opacity: "/>Add Photo / Video-->
                    </li>
                    <li>
                        <select class="skybtn" id='publish_status' name='publish_status'>
                            <option value='2'>Public</option>
                            <option value='0'>Only Me</option>
                            <option value='1'>Follower</option>
                        </select>
                        <input type="submit" class="skybtn" onclick="doPost()" value="POST">
                    </li>
                    
                </ul>
                
                
                
                
            </div>
        </div>
    </div>
    
</div>