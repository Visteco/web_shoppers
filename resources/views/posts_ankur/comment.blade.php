     
<?php 
$cmntBox = "cmnt_".$comment->cmnt_id."_".$post->post_id; 

$cmntReplyText = "cmnt_reply".$comment->cmnt_id."_".$post->post_id; 

?>
<br>
<ul class="post-list clearfix" id="{{$cmntBox}}">
            
            <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
            
            
            
            
            <li class="post-name">
                @if($comment->role == USER_PROFILE )
                    <a href="" class="people_name">{{$comment->user_name}} </a><time>{{$comment->formatted_date}}</time>
                
                    <span class="people_des">{{ $comment->user_desig }} at <a href="">{{ $comment->working_org }}</a></span>
                
                @elseif($comment->role == COMPANY_PROFILE)
                     <a href="" class="people_name"> {{$comment->posted_company_name}} </a><time>{{$comment->formatted_date}}</time>
                
                     <span class="people_des">{{$comment->posted_company_type}}<a href="">{{$comment->posted_company_country}}</a></span>
                   
                @endif   
                
                <?php $cmntId = 'cmnt_text_'.$post->post_id."_".$comment->cmnt_id; ?>
                <p class='show_cmnt' cmnt_id="{{ $comment->cmnt_id }}" id="{{ $cmntId }}"><?php echo $comment->cmnt_text ?></p>
                
                <ul class="post-soc">
                    <li ><i class="glyphicon glyphicon-thumbs-up pointer"></i><span>Like</span></li>
                    <!--<li><a class="pointer" onclick="cmntReply('{{$cmntReplyText}}')"><i class="glyphicon glyphicon-pencil "></i><span>Reply</span></a></li>-->
                </ul>
                
                <!--<br>-->
                <!--<ul class="post-list clearfix">
                    <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
                    <li class="post-name"><a href="" class="people_name">Sarvesh Kr Yadav </a><time>Monday, 02 june 2016</time>
                        <span class="people_des">Web Designer at <a href="">Webcoir IT Solutions Pvt Ltd</a></span>
                        <p>wcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg ausdai8sd xsiaSI UAHAGSXwcd wqdg
                        </p>
                        <ul class="post-soc">
                            <li><i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span></li>
                            
                        </ul>
                    </li>
                    <span class="dropdown">
                        <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown" aria-expanded="false">
                        </span>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a class="pointer"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                            </li>
                            <li>
                                <a class="pointer"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                            </li>
                        </ul>
                    </span>
                </ul>-->
                
                <!--<div class="post-cmnt clearfix" id="{{$cmntReplyText}}" style="display:none;">
                    <ul class="post-list clearfix">
                        <li><a href=""><img src="https://yt3.ggpht.com/-c5DJGtWXAPc/AAAAAAAAAAI/AAAAAAAAAAA/udj2dzUQz-k/s900-c-k-no-mo-rj-c0xffffff/photo.jpg"></a></li>
                        <li class="post-name"> 
                            <p class="form-control cmnt_p"  contenteditable="true" required="" ></p>
                        </li>
                    </ul>
                </div>-->
                
            </li> 
            
            
            <span class="dropdown">
                <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown" aria-expanded="false">
                </span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a class="pointer" cmnt_id ="{{ $comment->cmnt_id }}" onclick="showEditComment('<?php echo $cmntId ?>')" ><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                    </li>
                    <li>
                        <a class="pointer" onclick="deleteComment('{{ URL::to('delcmnt/'.$comment->cmnt_id) }}','{{ $cmntBox }}')"> <i class="glyphicon glyphicon-trash"></i>Delete</a>
                    </li>
                </ul>
            </span>
            
        </ul>

            