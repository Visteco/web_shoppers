<?php

$cmntBoxRp = "cmnt_" . $comment->cmnt_id . "_" . $post->post_id;

$cmntReplyTextRp = "cmnt_reply" . $comment->cmnt_id . "_" . $post->post_id;

$idofcmntRp =  $comment->cmnt_id;

$idofreply = $commentReply->reply_id;

$likeIdRp  = 'like_text_'.$post->post_id."_".$idofcmntRp."_".$idofreply;

$likeUrlRp = URL::to('like/'.$idofreply."/".REPLY_LIKE);

$likeCountIdRp = 'like_count_'.$post->post_id."_".$idofcmntRp."_".$idofreply;

$cmntIdRp = 'cmnt_text_' . $post->post_id . "_" . $comment->cmnt_id."_".$idofreply;

$replyParent = $post->post_id."_".$idofcmntRp."_"."reply";

$cmntUidRp = $commentReply->uid;

$profilePicRp = $commentReply->profilepic;
 
$userLinkRp   = $commentReply->user_link;

$replyBoxUniqueId = "box_".$post->post_id."_".$comment->cmnt_id;
$replyBoxUniqueIdP = "parent_".$post->post_id."_".$comment->cmnt_id;
$cmntReplyText = "cmnt_reply" . $comment->cmnt_id . "_" . $post->post_id;

?>
<ul class="post-list clearfix">
    
    <li><a href="{{ $commentReply->user_link }}">
            <img src="{{ $commentReply->profilepic }}">
        </a>
    </li>

    <li class="post-name"><a href="{{ $commentReply->user_link }}" class="people_name">{{ $commentReply->user_name }}</a> <time>{{ $commentReply->formatted_date }}</time>
        <span class="people_des">{{ $commentReply->user_desig }}<a href="">{{ $commentReply->working_org }}</a></span>
        <p>{{ $commentReply->cmnt_text }}</p>
        <ul class="post-soc">            
            @if($commentReply->likedByMe)     
                <a class="pointer active_like" id="{{ $likeIdRp }}" onclick="likeObject('{{ $likeUrlRp }}','{{ $likeIdRp }}','{{ $likeCountIdRp }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a> 
                <a class="pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$idofcmntRp."/".REPLY_LIKE) }}")'><comment id='{{$likeCountIdRp}}'>{{ $commentReply->like_count }}</comment><i class="fa fa-caret-down"></i></a>
                @else   
                <a class="pointer" id="{{ $likeIdRp }}" onclick="likeObject('{{ $likeUrlRp }}','{{ $likeIdRp }}','{{ $likeCountIdRp }}')"><i class="glyphicon glyphicon-thumbs-up "></i><span>Like</span></a>
                <a class="pointer" onclick='showLikedUsers("{{ URL::to('getlikedusers/'.$idofcmntRp."/".REPLY_LIKE) }}")'><comment id='{{$likeCountIdRp}}'>{{ $commentReply->like_count }}</comment><i class="fa fa-caret-down"></i></a>
                @endif
                <li><a class="pointer" onclick="showBoxToReply('{{$replyBoxUniqueId}}','{{$cmntReplyText}}')" ><i class="glyphicon glyphicon-pencil "></i><span>Reply</span></a></li>          
        </ul>
    </li>
    
    <span class="dropdown">
        <span class="glyphicon dropdown-toggle glyphicon-chevron-down" type="button" data-toggle="dropdown" aria-expanded="false">
        </span>
        <ul class="dropdown-menu dropdown-menu-right">
            @if($cmntUidRp == Auth::user()->id )
            <li>
                <a class="pointer"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
            </li>
            @endif
            
            @if($post->uid == Auth::user()->id || $commentReply->cmnt_user_id == Auth::user()->id  )
            <li>
                <a class="pointer"><i class="glyphicon glyphicon-trash"></i>Delete</a>
            </li>
            @endif
        </ul>
    </span>    
</ul>