<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Post;
use App\Userlike;
use App\Comment;
use App\BookMark;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;




class CommentController extends Controller {

    private $imageExt = [];
    
    private static $service;
    
    private $emojies;
    
    private $notification;
    
    private $follow;
    
    private  $userId;
    
    private $comment;

    
    
    public function __construct($userId=null) {

        if(is_null($userId)){
            $this->userId = Auth::user()->id;
        }else{
           $this->userId = $userId;
        }
        
        $this->comment = new Comment($this->userId);
        
    }

    
    
    public function doCmntToPost(Request $request) {
        $validator = Validator::make($request->all(), [
                    'cmnt_text' => 'required',
                    'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while comment!!']);
        }
       
        
        $cmntId = Comment::doComment($request->all());
        
        $getSingleComment = Comment::getCommentById($cmntId);
        $post = Post::getPostById($request->post_id);
        
        return view('posts.comment')->with('comment', $getSingleComment)->with('post',$post); /* Response::json(['success'=>true,'data'=>$getSingleComment]); */
    }
    
    public function updateCmntToPost(Request $request) {
        
        $validator = Validator::make($request->all(), [
                    'cmnt_text' => 'required',
                    'cmnt_id'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while comment!!']);
        }
        
        $cmntText = $this->getEmojies(trim($request->cmnt_text));
        
        $update = \App\Comment::where('cmnt_id','=',$request->cmnt_id)
                        ->update(['cmnt_text'=>$cmntText])
                    ;
        $cmntId = $request->cmnt_id;
        
        $getSingleComment = Comment::getCommentById($cmntId);
        
        return Response::json(['success'=>true,'data'=>$getSingleComment]);
        
    }
    
    
    public function deleteComment($cmntId){
        
        $delete = $this->comment->deleteComment($cmntId);
                
        
        if($delete)
            return Response::json(['success'=>true]);
        else 
            return Response::json(['success'=>false]);
        
    }

    public function getAllComments($postId,$loadMore=false,$limit=null,$offset=null) {
        
        $countAll = Comment::where("post_id",$postId)->count();
        
        $skip     = 0;
        
        if($loadMore==false){
            
        
             if($countAll > 3){
                $skip  = $countAll-3;
                $limit = 3; 
            }
        }
        
        
        $datas = \App\Comment::leftJoin('userprofiles', 'userprofiles.uid', '=', 'comments.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'comments.user_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('comments.post_id', '=', $postId)
                ->orderBy("comments.cmnt_id","ASC")
                
                ->select(
                        'comments.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                        'userprofiles.pres_org as working_org', 'userprofiles.pres_desg as user_desig',
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'users.login_role  as role', 
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'comments.*'
                )
                ->offset($skip)
                ->limit($limit)
                ->take($countAll)
                ->get()
                ;
        
        if($loadMore==false){
            
            if($countAll>3){
                $datas->hasMorePages = true;
                $datas->nextPageUrl  = url('getmorecomments/'.$postId."/?limit=".$skip."&offset=0");
                $datas->remain        = $countAll-3;
            }    
            else{
                $datas->hasMorePages = false;
            }    
        }
        
        
        
        foreach ($datas as $data) {
            
            $data->formatted_date = $this->formatDate($data->updated_at);

            $dataContent = $data->cmnt_text;

            $data->cmnt_text = $this->convertCodeToemoji($dataContent, json_decode($data->emoji_codes));
            
            
            $data->like_count           = $this->likeCount($data->cmnt_id,COMMENT_LIKE); 
            
            $data->likedByMe            = $this->likedByMe($data->cmnt_id, COMMENT_LIKE);
            
            $data->cmntRepliesCount     = $this->cmntRepliesCount($data->cmnt_id); 
            
            switch($data->role){
               case "usrpr" :  
                   if(empty($data->img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                       $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->img);
                        
                   $data->user_link       =  URL::to('user/profile/'.$data->uid); 
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   $data->user_link       =  URL::to('companyshow/'.$data->uid); 
                   break;
           }
            
        }
        
        //$datas->withPath(url('getmorecomments/'.$postId));

        
        
        return $datas;
    }
    
    public function loadMoreComments($postId,Request $request){
        
        $limit  = $request->limit;
               
        $offset = $request->offset; 
        
        $datas = $this->comment->getAllComments($postId,true,$limit,$offset);
        
        $post  =  Post::where("post_id",$postId)->first();
        
        
        $view = View::make('posts.morecomments', ['comments' => $datas,'postId'=>$postId,"post"=>$post]);

        
        $htmlData = $view->render();
        
        
        $datas->htmlData = $htmlData;

        $nextPage = "null";
        $secondParameter = 'cmnt_father_'.$postId;
        $onclick  = "onclick="."loadMoreComments(this,'$nextPage','$secondParameter')";
        $nextLink = "<a class='pointer' $onclick> << more comments </a>";  
        
        return Response::json(['success'=>true,"exists"=>count($datas),'data'=>$htmlData,"link"=>$nextLink,"more"=>true]);
    }

    public function getCommentById($id) {


        $data = \App\Comment::leftJoin('userprofiles', 'userprofiles.uid', '=', 'comments.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'comments.user_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('comments.cmnt_id', '=', $id)
                ->select(
                        'comments.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"),
                        'userprofiles.pres_org as working_org', 
                        'userprofiles.pres_desg as user_desig', 
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'users.login_role  as role', 
                        'comments.updated_at as updated_at',
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'comments.*'
                )
                ->first();
        
        $data->formatted_date = $this->formatDate($data->updated_at);

        $dataContent = $data->cmnt_text;

        $data->cmnt_text = $this->convertCodeToemoji($dataContent, json_decode($data->emoji_codes));
        
        $data->like_count       = $this->likeCount($data->cmnt_id,COMMENT_LIKE); 
            
        $data->likedByMe        = $this->likedByMe($data->cmnt_id, COMMENT_LIKE);
        
        switch($data->role){
               case "usrpr" :  
                   if(empty($data->img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                       $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->img);
                        
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   break;
           }

        return $data;
    }

    public function doCommentReply(Request $request){
        $validator = Validator::make($request->all(), [
            
                    'cmnt_text' => 'required',
            
                    'post_id' => 'required'  ,
            
                    'cmnt_id' => 'required'  ,
            
                    'cmnt_user_id' => 'required',
                
        ]);

        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while comment!!']);
        }
        $cmntText = $this->getEmojies(trim($request->cmnt_text));

        $cmnt = new \App\CommentReply;
        $cmnt->cmnt_text = strip_tags($cmntText);
        $cmnt->post_id = $request->post_id;
        $cmnt->user_id = Auth::user()->id;
        $cmnt->cmnt_id = $request->cmnt_id;
        $cmnt->cmnt_user_id = $request->cmnt_user_id;
        
        $cmnt->save();
        $cmntId = $cmnt->id;
        $getSingleComment = $this->getCommentReplyById($cmntId);
        
        $post    = Post::where('post_id','=',$request->post_id)->first();
        $comment = Comment::where('cmnt_id','=',$request->cmnt_id)->first();
        return view('posts.commentreply')
                ->with('commentReply', $getSingleComment)
                ->with('post',$post)
                ->with("comment",$comment)
                ; 
        /* Response::json(['success'=>true,'data'=>$getSingleComment]); */
    }
    
    public function getCommentReplyById($id) {


        $data = \App\CommentReply::leftJoin('userprofiles', 'userprofiles.uid', '=', 'creplies.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'creplies.user_id')
                ->join('users', 'users.id', '=', 'creplies.user_id')
                ->where('creplies.reply_id', '=', $id)
                ->select(
                        'creplies.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"),
                        'userprofiles.pres_org as working_org', 
                        'userprofiles.pres_desg as user_desig', 
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'users.login_role  as role', 
                        'creplies.updated_at as updated_at',
                        'creplies.*',
                        'userprofiles.img',
                        'companyprofiles.logo_img'
                )
                ->first();
        
        $data->formatted_date = $this->formatDate($data->updated_at);

        $dataContent = $data->cmnt_text;

        $data->cmnt_text = $this->convertCodeToemoji($dataContent, json_decode($data->emoji_codes));
        
        $data->like_count       = $this->likeCount($data->reply_id,REPLY_LIKE); 
            
        $data->likedByMe        = $this->likedByMe($data->reply_id, REPLY_LIKE);
        
        
        
        
        switch($data->role){
               case "usrpr" :  
                   if(empty($data->img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                       $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->img);
                   
                   $data->user_link       =  URL::to('userprofile/user/'.$data->uid); 
                   
                   $data->user_name       =  $data->user_name; 
                   
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   $data->user_link       =  URL::to('showcompany/'.$data->uid); 
                   
                   $data->user_name       =  $data->posted_company_name;
                   
                   break;
           }
        

        return $data;
    }
    
    public function getCommentReplies($cmntId){
        
        
        
        $datas = \App\CommentReply::leftJoin('userprofiles', 'userprofiles.uid', '=', 'creplies.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'creplies.user_id')
                ->join('users', 'users.id', '=', 'creplies.user_id')
                ->where('creplies.cmnt_id', '=', $cmntId)
                ->orderBy("creplies.reply_id","ASC")
                ->select(
                        'creplies.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                        'userprofiles.pres_org as working_org', 
                        'userprofiles.pres_desg as user_desig', 
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'users.login_role  as role', 
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'creplies.*'
                )
                ->paginate(10);
        
        foreach ($datas as $data) {
            
            $data->formatted_date = $this->formatDate($data->updated_at);

            $dataContent = $data->cmnt_text;
            
            /*$data->cmnt_text = strip_tags($dataContent);*/

            $data->cmnt_text = $this->convertCodeToemoji($dataContent, json_decode($data->emoji_codes));
            
            
            $data->like_count       = $this->likeCount($data->reply_id,REPLY_LIKE); 
            
            $data->likedByMe        = $this->likedByMe($data->reply_id, REPLY_LIKE);
            
            
            
            switch($data->role){
               case "usrpr" :  
                   if(empty($data->img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                       $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->img);
                   
                   $data->user_link       =  URL::to('userprofile/user/'.$data->uid); 
                   
                   $data->user_name       =  $data->user_name; 
                   
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   $data->user_link       =  URL::to('showcompany/'.$data->uid); 
                   
                   $data->user_name       =  $data->posted_company_name;
                   
                   break;
           }
            
        }
       
        return $datas; 
    }
    
    
    public function viewAllReplies($postId,$cmntId){
        
        
        $getAll = $this->getCommentReplies($cmntId);
        $post    = Post::where('post_id','=',$postId)->first();
        $comment = Comment::where('cmnt_id','=',$cmntId)->first();
        return view('posts.commentreplies')
                ->with('commentReplies', $getAll)
                ->with('post',$post)
                ->with("comment",$comment);
    }
    
    public function getBookMarkPosts(){
        
        
        $postIds = BookMark::where("user_id",$this->userId)
                ->pluck("post_id");
        
        $posts = Post::leftJoin('userprofiles', 'userprofiles.uid', '=', 'posts.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'posts.user_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                
                ->where('posts.is_deleted', '=', POST_NOT_DELETED)
                ->whereIn('posts.post_id', $postIds)
                ->select(
                        'posts.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                        'userprofiles.pres_org as working_org', 'userprofiles.pres_desg as user_desig', 
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'users.login_role  as role', 
                        'posts.*'
                )
                ->orderBy('posts.updated_at', 'desc')
                ->paginate(10);
       
        foreach ($posts as $post) {
            $post->formatted_date = $this->formatDate($post->updated_at);

            $postContent            = $post->post_content;
            
            $post->post_content     = $this->convertCodeToemoji($postContent, json_decode($post->emoji_codes));
            
            $post->post_comments    = $this->getAllComments($post->post_id);
            
            $post->like_count       = $this->likeCount($post->post_id,POST_LIKE); 
            
            $post->likedByMe        = $this->likedByMe($post->post_id, POST_LIKE); 
            
            
            $post->service          = \App\Service::where("id",$post->service_id)->first();
            
            $post->isBookMarked     = $this->isBookMarked($post->post_id, $this->userId);  
            
           switch($post->role){
               case "usrpr" :  
                   if(empty($post->img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                       $post->profilepic =  URL::to('userimages/user_'.$post->uid."/medium/".$post->img);
                        
                   $post->user_link       =  URL::to('user/profile/'.$post->uid); 
                   break;
               case "cmppr":
                   if(empty($post->logo_img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                        $post->profilepic =  URL::to('userimages/user_'.$post->uid."/medium/".$post->logo_img);
                   
                   $post->user_link       =  URL::to('showcompany/'.$post->uid); 
                   break;
           }
            
            
        }

        /* print "<pre>";
          print_r($posts);
          print "</pre>"; */

        return $posts;
    }
 
    public function updateReply(Request $request) {
        
        $validator = Validator::make($request->all(), [
                    'cmnt_text' => 'required',
                    'rply_id'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while comment!!']);
        }
        
        $cmntText = $this->getEmojies(trim($request->cmnt_text));
        
        $update = \App\CommentReply::where('reply_id','=',$request->rply_id)
                        ->update(['cmnt_text'=>$cmntText])
                    ;
        
        
        $getSingleRply = $this->getCommentReplyById($request->rply_id);
        
        return Response::json(['success'=>true,"data"=>$getSingleRply]);
        
    }
    
    public function deleteReply($cmntId){
        
        $delete = \App\CommentReply::where('reply_id','=',$cmntId)
                    ->where('user_id','=',$this->userId)
                    ->delete();
        
        if($delete)
            return Response::json(['success'=>true]);
        else 
            return Response::json(['success'=>false]);
        
    }
    
    
    
}
