<?php
$cmntBox = "cmnt_" . $comment->cmnt_id . "_" . $post->post_id;

$cmntReplyText = "cmnt_reply" . $comment->cmnt_id . "_" . $post->post_id;

$idofcmnt =  $comment->cmnt_id;

$likeId  = 'like_text_'.$post->post_id."_".$idofcmnt;

$likeUrl = URL::to('like/'.$idofcmnt."/".COMMENT_LIKE);

$likeCountId = 'like_count_'.$post->post_id."_".$idofcmnt;

$cmntId = 'cmnt_text_' . $post->post_id . "_" . $comment->cmnt_id;

$replyParent = $post->post_id."_".$idofcmnt."_"."reply";

$cmntUid = $comment->uid;

$profilePic = $comment->profilepic;
 
$userLink   = $comment->user_link;

$replyBoxUniqueId = "box_".$post->post_id."_".$idofcmnt;
$replyBoxUniqueIdP = "parent_".$post->post_id."_".$idofcmnt;


?>
<ul class="post-list clearfix" id="{{$cmntBox}}">
    
    <li><a href=""><img src="{{ $profilePic }}"></a></li>
    <li class="post-name">
        @if($comment->role == USER_PROFILE )
        <a href="{{ $userLink }}" class="people_name">{{$comment->user_name}} </a><time>{{$comment->formatted_date}}</time>

        <span class="people_des">{{ $comment->user_desig }} at <a href="">{{ $comment->working_org }}</a></span>

        @elseif($comment->role == COMPANY_PROFILE)
        <a href="{{$userLink}}" class="people_name"> {{$comment->posted_company_name}} </a><time>{{$comment->formatted_date}}</time>

        <span class="people_des">{{$comment->posted_company_type}}<a href="">@if(!empty($post->posted_company_country))<img class="flag_img" src="{{ URL::to("flags/".strtolower($post->posted_company_country.".png")) }}">@endif</a></span>

        @endif   

        
        <p class='show_cmnt' cmnt_id="{{ $comment->cmnt_id }}" id="{{ $cmntId }}"><?php echo $comment->cmnt_text ?></p>

        <ul class="post-soc">

            <li>
                @if($comment->likedByMe)     
                <a class="pointer active_like" id="{{ $likeId }}" onclick="likeObject('{{ $likeUrl }}','{{ $likeId }}','{{ $likeCountId }}')">
                    <i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span>
                </a> 
                <a class="pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$idofcmnt."/".COMMENT_LIKE) }}")'><comment id='{{$likeCountId}}'>{{$comment->like_count}}</comment><i class="fa fa-caret-down"></i></a>
                @else  
                <a class="pointer" id="{{ $likeId }}" onclick="likeObject('{{ $likeUrl }}','{{ $likeId }}','{{ $likeCountId }}')">
					<i class="glyphicon glyphicon-thumbs-up"></i><span>Like</span>
                </a>
                <a class="pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$idofcmnt."/".COMMENT_LIKE) }}")'><comment id='{{$likeCountId}}'>{{$comment->like_count}}</comment><i class="fa fa-caret-down"></i></a>
                @endif
            </li>
                     
             <li><a class="pointer" onclick="showBoxToReply('{{$replyBoxUniqueId}}','{{$cmntReplyText}}')" ><i class="glyphicon glyphicon-pencil "></i><span>Reply</span></a></li>  
            
             @if($comment->cmntRepliesCount > 0)
                <li><a class="pointer" onclick="viewAllReplies('{{ URL::to('getallreplies/'.$post->post_id."/".$comment->cmnt_id) }}','{{$replyParent}}' )"><span class="pointer">View all {{ $comment->cmntRepliesCount }} Replies</span></a></li>  
             @endif
        </ul>

        <div id='{{ $replyParent }}'>
         @if(isset($comment->cmntReplies))   
           @foreach($comment->cmntReplies as $commentReply) 
                @include('posts.commentreply')
           @endforeach 
         @endif  
        </div>

        <div class="post-cmnt-box clearfix" id="{{$cmntReplyText}}" style="display:none;">
                <ul class="post-list clearfix"><?php $profilepic= empty(Session::get('profilepic')) ? URL::to('images/user.png') : URL::to('userimages/user_'.Auth::user()->id."/medium/".Session::get('profilepic'))  ?>
                        <li><a href=""><img src="{{$profilepic}}"></a></li>
                        <li class="post-name"> 
                             <p id="{{$replyBoxUniqueId}}" autofocus="true" class="rply_description form-control cmnt_p" link='{{ URL::to('docmntreply') }}' post_id="{{$post->post_id}}"  cmnt_id="{{$idofcmnt}}" parent_id="{{$replyParent}}" cmnt_user_id="{{$cmntUid}}"  contenteditable="true" required="" ></p>
                        </li>
                </ul>
        </div>
    </li> 

    <span class="dropdown">
        <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown" aria-expanded="false">
        </span>
        <ul class="dropdown-menu dropdown-menu-right">
            @if($cmntUid == Auth::user()->id )
            <li>
                <a class="pointer" cmnt_id ="{{ $comment->cmnt_id }}" onclick="showEditComment('<?php echo $cmntId ?>')" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            </li>
            @endif
            
            @if( $post->uid == Auth::user()->id || $cmntUid == Auth::user()->id )
            <li>
                <a class="pointer" onclick="deleteComment('{{ URL::to('delcmnt/'.$comment->cmnt_id) }}','{{ $cmntBox }}')"> <i class="glyphicon glyphicon-trash"></i> Delete</a>
                
            </li>
            @endif
        </ul>
    </span>

</ul>

