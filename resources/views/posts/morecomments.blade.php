
@foreach($comments as $comment)


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

?>

@include("posts.comment")

@endforeach
