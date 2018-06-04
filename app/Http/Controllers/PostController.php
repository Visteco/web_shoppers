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


define('POST_PUBLIC', 2);
define('POST_FOLLOWERS', 1);
define('POST_ONLYME', 0);
define('INTERNAL_POST', 1);
define('EXTERNAL_POST', 2);
define('SERVICE_POST',3);
define('TYPE_IMAGE', 1);
define('TYPE_VIDEO', 2);
define('POST_DELETED', 1);
define('POST_NOT_DELETED', 0);
define('POST_SHARED_TRUE', 1);
define('POST_LIKE', 'post');
define('COMMENT_LIKE', 'cmnt');
define('REPLY_LIKE','rlike');
define('LOAD_MORE_POST', 'loadmore');

class PostController extends Controller {

    public $imageExt = [];
    public static $service;
    public $emojies;
    
    public $notification;
    
    public $follow;
    
    public  $userId;

    
    
    public function __construct($userId=null) {


        $this->imageExt ['image/png'] = ".png";
        $this->imageExt['image/bmp'] = ".bmp";
        $this->imageExt['image/x-cmx'] = ".cmx";
        $this->imageExt['image/cis-cod'] = ".cod";
        $this->imageExt['image/gif'] = ".gif";
        $this->imageExt['image/x-icon'] = ".ico";
        $this->imageExt['image/ief'] = ".ief";
        $this->imageExt['image/pipeg'] = ".jfif";
        $this->imageExt['image/jpeg'] = ".jpeg";
        $this->imageExt['image/x-portable-graymap'] = ".pgm";
        $this->imageExt['image/x-portable-pixmap'] = ".ppm";
        $this->imageExt['image/x-cmu-raster'] = ".ras";
        $this->imageExt['image/x-rgb'] = ".rgb";
        $this->imageExt['image/svg+xml'] = ".svg";
        $this->imageExt['image/tiff'] = ".tif";
        $this->imageExt['image/x-xbitmap'] = ".xbm";
        $this->imageExt['image/x-xpixmap'] = ".xpm";
        $this->imageExt['image/x-xwindowdump'] = ".xwd";
        
        if(is_null($userId)){
            $this->userId = Auth::user()->id;
        }else{
           $this->userId = $userId;
        }
         
        $this->notification =  new NotificationController($this->userId);
        
        $this->follow       =  new FollowController($this->userId);
    }

    
    public function emojiList(){
        $emoji = [  "angry_face",
                    "anguished_face",
                    "astonished_face",
                    "athletic_shoe",
                    "baby_angel",
                    "baby",
                    "bikini",
                    "boy",
                    "bride_with_veil",
                    "briefcase",
                    "bust_in_silhouette",
                    "busts_in_silhouette",
                    "call_me_hand",
                    "cat_face_with_tears_of_joy",
                    "cat_face_with_wry_smile",
                    "clapping_hands_sign",
                    "closed_umbrella",
                    "confounded_face","confused_face","construction_worker","couple_(man,man)","couple_with_heart","couple_(woman,woman)","crown","crying_cat_face","crying_face","dancer","dark_sunglasses","disappointed_but_relieved_face","disappointed_face","dizzy_face","dress","ear","expressionless_face","extraterrestrial_alien","eyeglasses","eyes","eye","face_massage","face_palm","face_savouring_delicious_food","face_screaming_in_fear","face_throwing_a_kiss","face_with_cold_sweat","face_with_head-bandage","face_with_look_of_triumph","face_with_medical_mask","face_with_no_good_gesture","face_with_ok_gesture","face_with_open_mouth_and_cold_sweat","face_with_open_mouth","face_without_mouth","face_with_rolling_eyes","face_with_stuck-out_tongue_and_tightly-closed_eyes","face_with_stuck-out_tongue_and_winking_eye","face_with_stuck-out_tongue","face_with_tears_of_joy","face_with_thermometer","family_(man,man,boy,boy)","family_(man,man,boy)","family_(man,man,girl,boy)","family_(man,man,girl,girl)","family_(man,man,girl)","family_(man,woman,boy,boy)","family_(man,woman,girl,boy)","family_(man,woman,girl,girl)","family_(man,woman,girl)","family","family_(woman,woman,boy,boy)","family_(woman,woman,boy)","family_(woman,woman,girl,boy)","family_(woman,woman,girl,girl)","family_(woman,woman,girl)","father_christmas","fearful_face","fisted_hand_sign","flexed_biceps","flushed_face","footprints","frowning_face_with_open_mouth","ghost","girl","graduation_cap","grimacing_face","grinning_cat_face_with_smiling_eyes","grinning_face","grinning_face_with_smiling_eyes","guardsman","haircut","handbag","handshake","hand_with_first_and_index_finger_crossed","happy_person_raising_one_hand","helmet_with_white_cross","high-heeled_shoe","hugging_face","hushed_face","imp","information_desk_person","japanese_goblin","japanese_ogre","jeans","kimono","kissing_cat_face_with_closed_eyes","kissing_face","kissing_face_with_closed_eyes","kissing_face_with_smiling_eyes","kiss_(man,man)","kiss_mark","kiss","kiss_(woman,woman)","left-facing_fist","lipstick","loudly_crying_face","man_and_woman_holding_hands","man_dancing","man_in_tuxedo","mans_shoe","man","man_with_gua_pi_mao","man_with_turban","money-mouth_face","mother_christmas","mouth","nail_polish","necktie","nerd_face","neutral_face","nose","ok_hand_sign","older_man","older_woman","open_hands_sign","pedestrian","pensive_face","persevering_face","person_bowing_deeply","person_frowning","person_raising_both_hands_in_celebration","person_with_blond_hair","person_with_folded_hands","person_with_pouting_face","pile_of_poo","police_officer","pouch","pouting_cat_face","pouting_face","pregnant_woman","princess","prince","purse","raised_back_of_hand","raised_fist","raised_hand","raised_hand_with_fingers_splayed","raised_hand_with_part_between_middle_and_ring_fingers","relieved_face","reversed_hand_with_middle_finger_extended","right-facing_fist","ring","robot_face","runner","school_satchel","selfie","shrug","sign_of_the_horns","skull","sleeping_face","sleeping_symbol","sleepy_face","sleuth_or_spy","slightly_frowning_face","slightly_smiling_face","smiling_cat_face_with_heart-shaped_eyes","smiling_cat_face_with_open_mouth","smiling_face_with_halo","smiling_face_with_heart-shaped_eyes","smiling_face_with_horns","smiling_face_with_open_mouth_and_cold_sweat","smiling_face_with_open_mouth_and_smiling_eyes","smiling_face_with_open_mouth_and_tightly-closed_eyes","smiling_face_with_open_mouth","smiling_face_with_smiling_eyes","smiling_face_with_sunglasses","smirking_face","speaking_head_in_silhouette","thinking_face","thumbs_down_sign","thumbs_up_sign","tired_face","tongue","top_hat","t-shirt","two_men_holding_hands","two_women_holding_hands","unamused_face","upside-down_face","victory_hand","waving_hand_sign","weary_cat_face","weary_face","white_down_pointing_backhand_index","white_frowning_face","white_left_pointing_backhand_index","white_right_pointing_backhand_index","white_smiling_face","white_up_pointing_backhand_index","white_up_pointing_index","winking_face","womans_boots","womans_clothes","womans_hat","womans_sandal","woman","woman_with_bunny_ears","worried_face","writing_hand","zipper-mouth_face"];
       return $emoji; 
    }
    
    public function getEmoticons() {
        
        $emoticons = [];
        
        $emoticons[1] = DB::table('emoji')
                        ->where("cat",'=',1)
                        
                        //->select(DB::raw("CONCAT('emox','_',emoji.id) as name"))
                        ->pluck("name")
                        //->get()
                
                        ->toArray();
        
        $emoticons[2] = DB::table('emoji')
                        ->where("cat",'=',2)
                    
                        //->select(DB::raw("CONCAT('emox','_',emoji.id) as name"))
                        
                        ->pluck("name")
                
                        ->toArray();
        
        $emoticons[3] = DB::table('emoji')
                        
                        ->where("cat",'=',3)
                        
                        //->select(DB::raw("CONCAT('emox','_',emoji.id) as name"))
                        
                        ->pluck("name")
                        
                        ->toArray();
        
        $emoticons[4] = DB::table('emoji')
                        
                        ->where("cat",'=',4)
                        
                        //->select(DB::raw("CONCAT('emox','_',emoji.id) as name"))
                        
                        ->pluck("name")
                
                        ->toArray();
        
        
        $emoticons[5] = DB::table('emoji')
                        ->where("cat",'=',5)
                        
                        //->select(DB::raw("CONCAT('emox','_',emoji.id) as name"))
                        ->pluck("name")
                        
                        
                        ->toArray();
        
        return $emoticons;
    }

    public function getAllPost($profile=false) {

        $allFollowings=[];
        
        if($profile){
            $allFollowings[] = $this->userId; 
        }else{
            
            $allFollowings =  $this->follow->getAllFollowingsIds($this->userId);
            $allFollowings[count($allFollowings)] = $this->userId; 
            
        }
        
        $posts = Post::leftJoin('userprofiles', 'userprofiles.uid', '=', 'posts.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'posts.user_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                
                ->where('posts.is_deleted', '=', POST_NOT_DELETED)
                ->whereIn('posts.user_id', $allFollowings)
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

            $post_date = date('Y-m-d',strtotime($post->updated_at));
            if($post_date == date('Y-m-d')){
                $post->post_created_date = 'Today '.date("H:i a",strtotime($post->updated_at));
            }else{
                $post->post_created_date = date('l, d F Y H:i a',strtotime($post->updated_at));
            }
           
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
                       $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->img);
                        
                   $post->user_link       =  URL::to('user/profile/'.$post->uid); 
                   break;
               case "cmppr":
                   if(empty($post->logo_img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                        $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->logo_img);
                   
                   $post->user_link       =  URL::to('showcompany/'.$post->uid); 
                   break;
           }
            
            
        }

         // print "<pre>";
         //  print_r($posts->toArray());
         //  print "</pre>"; 
         //  die;

        return $posts;
    }
    
    public function likeCount($id,$type){
        $count = Userlike::where('like_object','=',$id)
                   ->where('object_type','=',$type)
                   ->count();
        
        return $count;
                
    }
    
    public function getLikedUsers($id,$type){
        
        
        $users = Userlike::leftJoin('userprofiles', 'userprofiles.uid', '=', 'userlikes.user_id')
                        ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'userlikes.user_id')
                        ->leftJoin('users', 'users.id', '=', 'userlikes.user_id')
                
                ->where('userlikes.like_object','=',$id)
                
                ->where('userlikes.object_type','=',$type)
                
                /*->where('userlikes.user_id','=',$this->userId)*/
                
                ->select(
                        'userlikes.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                        'userprofiles.pres_org as working_org', 'userprofiles.pres_desg as user_desig', 
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country', 
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'users.login_role', 
                        'userlikes.*'
                )
                ->orderBy('userlikes.updated_at', 'desc')
                
                ->paginate(10);
        
        foreach($users as $user){
            
            $user->alreadyFollow = $this->alreadyFollow($user->uid, $this->userId);
            
            
            switch($user->login_role){
               case "usrpr" :  
                   if(empty($user->img))
                       $user->profilepic =  URL::to('images/user.png');
                   else
                       $user->profilepic =  URL::to('public/userimages/user_'.$user->uid."/medium/".$user->img);
                   
                   $user->username = $user->user_name;
                   
                   $user->follow_link = URL::to('followuser/'.$user->uid);
                   break;
               case "cmppr":
                   if(empty($user->logo_img))
                       $user->profilepic =  URL::to('images/user.png');
                   else
                        $user->profilepic =  URL::to('public/userimages/user_'.$user->uid."/medium/".$user->logo_img);
                   
                   $user->username = $user->posted_company_name;
                   
                   $user->follow_link = URL::to('followcompany/'.$user->uid);
                   
                   break;
           }
            
        }
        
        
        
        /*$users = Userlike::join('users','users.id','=','userlikes.user_id')
        
                ->where('like_object','=',$id)
                
                ->where('object_type','=',$type)
                
                ->paginate(10);*/
        
        
        
        
        $view = View::make('posts.userlistmodal', ['users' => $users]);

        $view = $view->render();

        return Response::json(['success'=>true,'users'=>$view]);
        
    }
    
    public function alreadyFollow($followto,$followfrom){
        $count = \App\Userfollowing::where('following_id','=',$followto)
                ->where("user_id","=",$followfrom)
                ->count();
        return $count;
    } 
    
    public function likedByMe($id,$type){
        $count = Userlike::where('like_object','=',$id)
                   ->where('object_type','=',$type)
                   ->where('user_id','=',$this->userId) 
                   ->count();
        
        return $count;
    }

    public function getEmojies($string) {
        $image_regex = '/<img[^>]*' . 'src=[\"|\'](.*)[\"|\']/Ui';

        preg_match_all($image_regex, $string, $img, PREG_PATTERN_ORDER);


        $images_array1 = $img;
        $images_array = array();

        for ($i = 1; $i < count($images_array1); $i++) {
            $images_array[] = $images_array1[$i];
        }

        if (count($images_array[0]) > 0) {
            return $this->convertEmojiToCode($string, $images_array[0]);
        } else {
            return $string;
        }
    }

    public function convertEmojiToCode($html){
        
        $emoji = [];
        
        
        
        
        preg_match_all('/<img[^>]+>/i',$html, $result); 



        foreach($result[0] as $img){



            $n = new \DOMDocument();

            $img1 = $img;

            $n->loadHTML($img);

            foreach ($n->getElementsByTagName('img') as $img) {
                $src = $img->getAttribute('src');
            }


            $explode = explode("/",$src);
            
            //print_r($explode);

            $emo = $explode[count($explode)-1];

            $emo = str_replace(".svg","",$emo);
            
            $emoji[] = $emo;

            $html =str_replace($img1,$emo,$html);

            }
            $this->emojies = json_encode($emoji);
            
            return strip_tags($html);
     }
    
   /* public function convertEmojiToCode($string, $images) {
        $emoji = [];


        for ($i = 0; $i < count($images); $i++) {

            $src = $images[$i];
            $emoji_face = str_replace("http://localhost:8000/images/emoticons/", "", $images[$i]);
            ;

            $only_face = strtok($emoji_face, ".");
            $emoji[] = $only_face;

            /* echo $only_face; */

           /* $str = str_replace('<img src="' . $src . '" style="width: 25px;">', $only_face, $string);
            // $str = str_replace('<img src="'.$src.'">',$only_face,$string);
        }

        $this->emojies = json_encode($emoji);

        return strip_tags($str);
    }*/

    public function convertCodeToemoji($string, $emojies) {

        return $string;
        
        $emojies = DB::table('emoji')
                    ->get();
        
        
        
        
            foreach ($emojies as $emoji) {
               
                $src = url('images/emoticons/'.$emoji->name);
                $em  = str_replace(".svg","", $emoji->name);
                $str = str_replace($em, '<img src="' . $src . '" style="width: 25px;">', $string);
                $string = $str;
                
            }
            

        return $string;
    }

    public function createPost(Request $request) {
        $validator = Validator::make($request->all(), [
                    'post_type' => 'required',
                    'external_link' => 'sometimes|required|url',
                    'publish_status' => 'sometimes|required',
                    'post_content' => 'sometimes|required',
                    'tag_line' => 'sometimes|required',
                    'image' => 'sometimes|required',
                    'video' => 'sometimes|required',
                    'tagged_users' => 'sometimes|required|json',
        ]);
        
        if ($validator->fails()) {
          $validator->errors()->all();
        } 
        
        $image_array = $request->image;
        $postText = $this->getEmojies(trim($request->post_text));
        /* print ("<pre>");
          print_r($request->all());
          print ("</pre>"); */
        $tagedUsers = json_decode($request->tagged_users);

        $crawelData = json_decode($request->crawl_data);

        $post = new Post;

        $post->post_owner = $this->userId;

        $post->user_id = $this->userId;

        $post->post_content = $postText;

        $post->publish_status = $request->publish_status;

        $post->tagged_users = $request->tagged_users;

        $post->publish_status = $request->publish_status;

        $post->emoji_codes = $this->emojies;



        switch ($request->post_type) {

            case EXTERNAL_POST:

                $post->external_link = isset($crawelData->video) ? $crawelData->video : $crawelData->url;

                $post->tag_line = empty($crawelData->url_title)? "": $crawelData->url_title;

                $post->content_type = $request->content_type;
                ;

                $post->post_type = $request->post_type;

                if ($request->content_type == TYPE_IMAGE)
                    $post->post_image = $crawelData->image;/*$this->downloadImageFromUrl($crawelData->image);*/

                break;

            case INTERNAL_POST:

                if (empty($request->content_type) || is_null($request->content_type))
                    $post->content_type = 0;
                else
                    $post->content_type = $request->content_type;


                $post->post_type = $request->post_type;

                $fileName = $this->uploadPostPicsAndVideos();
                
                if(is_array($fileName)){
                    $file_name = implode(',',$fileName);
                }else{
                    $file_name = $fileName;
                }
                
                switch ($request->content_type) {
                    case TYPE_IMAGE:
                        $post->post_image = $file_name;
                        break;

                    case TYPE_VIDEO:
                        $post->post_video = $file_name;
                        break;
                }
        }

        $post->save();

        $postId = $post->id;
        
        $followers =  $this->follow->getAllFollowersIds($this->userId);
        
        foreach($followers as $follower){
             $this->notification->create($postId, $follower, NOTICE_POST); 
        }
        
        

        $newCreatedPost = $this->getPostByPostId($postId);

        $emojies = $this->getEmoticons();

        return view('posts.post')->with('post', $newCreatedPost[0])->with('emoticons', $emojies);
    }

    public function getPostByPostId($postId) {

        $posts = Post::leftJoin('userprofiles', 'userprofiles.uid', '=', 'posts.user_id')
                ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'posts.user_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->where('posts.post_id', '=', $postId)
                ->where('posts.is_deleted', '=', POST_NOT_DELETED)
                ->select(
                        'posts.user_id as uid', 
                        DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                        'userprofiles.pres_org as working_org', 
                        'userprofiles.pres_desg as user_desig',
                        'companyprofiles.company_name as posted_company_name', 
                        'companyprofiles.company_type as posted_company_type', 
                        'companyprofiles.country as posted_company_country',
                        'userprofiles.img',
                        'companyprofiles.logo_img',
                        'users.login_role  as role', 'posts.*'
                )
                //->first();
                ->get(); 

        foreach($posts as $post){
            
            $post->formatted_date = $this->formatDate($post->updated_at);
            $postContent = $post->post_content;
            $post->post_content = $this->convertCodeToemoji($postContent, json_decode($post->emoji_codes));
            $post->post_comments = $this->getAllComments($post->post_id);
            $post->like_count        = $this->likeCount($post->post_id,POST_LIKE); 
            $post->likedByMe         = $this->likedByMe($post->post_id, POST_LIKE); 
            
            switch($post->role){
               case "usrpr" :  
                   if(empty($post->img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                       $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->img);
                   
                   $post->user_link       =  URL::to('user/profile/'.$post->uid); 
                   
                   break;
               case "cmppr":
                   if(empty($post->logo_img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                        $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->logo_img);
                   
                   $post->user_link       =  URL::to('companyshow/'.$post->uid); 
                    break;
           }
            
        }
        

        return $posts;
    }

    public function uploadPostPicsAndVideos() {
        if (Input::hasFile('image')) {
            $isImageArr = Input::file('image');
            if(is_array($isImageArr)){
                $imgName = array();
                foreach ($isImageArr as $imagearr) {
                    $img = $imagearr->getClientOriginalName();
                    /* new code added for remove replacement of iphone posts from other posts date:3/10/2016 */
                    $extension = $imagearr->getClientOriginalExtension();

                    $randomName = uniqid();

                    $img_name = $randomName . "." . $extension;

                    $imgName[] = $img_name;

                    /* end */

                    $path = 'public/images/posts/';

                    $img_ar = $imagearr->move($path, $img_name);
                    
                    $imageController =  new ImageController($this->userId);
                    
                    $opt = $imageController->optimizeImage($path.$img_name);
                }
            }else{
                $img = Input::file('image')->getClientOriginalName();
                /* new code added for remove replacement of iphone posts from other posts date:3/10/2016 */
                $extension = Input::file('image')->getClientOriginalExtension();

                $randomName = uniqid();

                $imgName = $randomName . "." . $extension;


                /* end */

                $path = 'public/images/posts/';


                Input::file('image')->move($path, $imgName);
                
                $imageController =  new ImageController($this->userId);
                
                $opt = $imageController->optimizeImage($path.$imgName);
            }
            /*$opt = true;*/
            if($opt)
              return $imgName;
            else
              return false;
            
        } else if (Input::hasFile('video')) {
            $isVideoArr = Input::file('video');
            if(is_array($isVideoArr)){
                $fileName = array();
                foreach ($isVideoArr as $videoarr) {
                    $extension = $videoarr->getClientOriginalExtension();

                    $randomName = uniqid();

                    $file_name = $randomName . "." . $extension;

                    $fileName[] = $file_name;

                    $path = 'public/images/posts/';

                    $extension = $videoarr->getClientOriginalExtension();

                    $videoarr->move($path, $fileName);
                }
            }else{
                $extension = Input::file('video')->getClientOriginalExtension();

                $randomName = uniqid();

                $fileName = $randomName . "." . $extension;

                $path = 'public/images/posts/';

                $extension = Input::file('video')->getClientOriginalExtension();

                Input::file('video')->move($path, $fileName);

            }
            return $fileName;
        } else {

            return false;
        }
    }

    public function checkStringForLink(Request $request) {



        $validator = Validator::make($request->all(), [
                    'link' => 'required|active_url',
        ]);


        if ($validator->fails()) {


            return Response::json(['success' => '0', 'error' => $validator->errors()]);
        } else {

            $url = $request->link;

            $url = $this->checkValues($url);

            $urlType = $this->videoType($url);

            $string = $this->fetch_record($url);

            /// fecth title
            $title_regex = "/<title>(.+)<\/title>/i";
            preg_match_all($title_regex, $string, $title, PREG_PATTERN_ORDER);
            $url_title = $title[1];

            /// fecth decription
            $tags = get_meta_tags($url);

            $embedURL = null;

            switch ($urlType) {

                case 'youtube' :

                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                        $video_id = $match[1];
                    }

                    $video_img = "http://img.youtube.com/vi/$video_id/default.jpg";

                    $images_array = [$video_img];

                    $linkType = "video";
                    $embedURL = $this->AutoParseYoutubeLink($url);
                    break;

                case 'unknown' :
                    // fetch images
                    $image_regex = '/<img[^>]*' . 'src=[\"|\'](.*)[\"|\']/Ui';
                    preg_match_all($image_regex, $string, $img, PREG_PATTERN_ORDER);


                    $images_array1 = $img[1];
                    $images_array = array();


                    for ($i = 1; $i < count($images_array1); $i++) {
                        
                        if (filter_var($images_array1[$i], FILTER_VALIDATE_URL)) {
                            $images_array[] = $images_array1[$i];
                        } else {
                            $images_array[] = $url."/".$images_array1[$i];
                        }
                        
                        
                    }

                    $linkType = "img";
                    break;

                default :
                    break;
            }



            return Response::json([
                        'success' => 1,
                        'images_array' => $images_array,
                        'url_title' => $url_title,
                        'tags' => $tags,
                        'URL' => $url,
                        'urlType' => $linkType,
                        'embed_url' => $embedURL,
            ]);
        }
    }

    private function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    private function checkValues($value) {
        $value = trim($value);
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        $value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    private function fetch_record($path) {


        $file = fopen($path, "r");



        //return;

        if (!$file) {
            exit("Problem occured");
        }
        $data = '';
        while (!feof($file)) {
            $data .= fgets($file, 1024);
        }


        return $data;
    }

    private function downloadImageFromUrl($path) {
        /* $path = public_path('images/posts/' . "vis5979daab51a01.jpeg"); */
        /*
          $img = Image::canvas(800, 600);

          $img = Image::canvas(32, 32, '#ff0000');

          $img->save(public_path('images/posts/' . "vis5979daab51a01.jpg"));

         */
        $img = Image::make($path);

        $size = $img->filesize();

        $size_ = ($size) / (1024);



        $mime = $img->mime();

        $filename = "vis" . uniqid() . $this->imageExt[$mime];

        $height = $img->height();

        $width = $img->width();

        /* $img->resize(300, 200);  */

        /* $img->crop($width, $height, 500,500); */

        $img->save(public_path('images/posts/' . $filename));

        return $filename;
    }

    public function setImageCompressionQuality($imagePath, $quality) {

        $imagick = new \Imagick(realpath($imagePath));

        $imagick->setImageCompressionQuality($quality);
    }

    private function AutoParseYoutubeLink($data) {
        // Check if youtube link is a playlist
        if (strpos($data, 'list=') !== false) {
            // Generate the embed code
            $data = preg_replace('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{12,})[a-z0-9;:@#?&%=+\/\$_.-]*~i', 'https://www.youtube.com/embed/videoseries?list=$1', $data);

            return $data;
        }
        // Check if youtube link is not a playlist but a video [with time identifier]
        if (strpos($data, 'list=') === false && strpos($data, 't=') !== false) {
            $time_in_secs = null;

            // Get the time in seconds from the time function
            $time_in_secs = ConvertTimeToSeconds($data);

            // Generate the embed code
            $data = preg_replace('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i', 'https://www.youtube.com/embed/$1?start=' . $time_in_secs, $data);

            return $data;
        }
        // If the above conditions were false then the youtube link is probably just a plain video link. So generate the embed code already.
        $data = preg_replace('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i', 'https://www.youtube.com/embed/$1', $data);

        return $data;
    }

    public static function formatPost() {

        $date = new \DateTime();

        //echo Carbon::now()->toDayDateTimeString("2017-8-10 11:29:30");

        /* echo date("D, d M Y H:i A",mktime(18,8,0,10,3,2016)); */


        $date1 = "2017-8-10";
        $date2 = "2017-8-9";



        $date1 = date_create("2017-08-11 13:7:0");
        $date2 = date_create("2017-08-11 13:8:0");
        $diff = date_diff($date1, $date2);
        //echo $diff->format('%d  %h  %i ')."<br>";
        //echo $diff->format('%d Day %h Hours %i Minutes')."<br>";

        echo self::formatDate("2017-08-10 13:7:0");
    }

    public static function formatDate($postDate) {

        $now = Carbon::now()->toDateTimeString();

        $diff = date_diff(date_create($now), date_create($postDate));

        $day = $diff->format("%d");

        $hour = $diff->format("%h");

        $minutes = $diff->format("%i");

        $seconds = $diff->format("%s");

        $year = $diff->format("%Y");

        if ($day < 1) {

            if ($hour < 1) {
                return $diff->format('%i Minutes ago');
            } else {
                return $diff->format('%h Hours ago');
            }
        } else {


            $dateTime = explode(" ", $postDate);
            $data = explode("-", $dateTime[0]);

            $Y = $data[0];
            $m = $data[1];
            $d = $data[2];

            $data2 = explode(":", $dateTime[1]);
            $H = $data2[0];
            $i = $data2[1];
            $s = $data2[2];





            return date("D, d M Y", mktime($H, $i, 0, $m, $d, $Y)); //$diff->format('%d Day, %h Hours %i Minutes');
        }
    }

    
    public function doCmntToPost(Request $request) {
        $validator = Validator::make($request->all(), [
                    'cmnt_text' => 'required',
                    'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while comment!!']);
        }
        $cmntText = $this->getEmojies(trim($request->cmnt_text));

        $cmnt = new \App\Comment;
        $cmnt->cmnt_text = strip_tags($cmntText);
        $cmnt->post_id = $request->post_id;
        $cmnt->user_id = $this->userId;
        $cmnt->emoji_codes = $this->emojies;
        $cmnt->save();
        $cmntId = $cmnt->id;
        $getSingleComment = $this->getCommentById($cmntId);
        
        $post = Post::where('post_id','=',$request->post_id)->first();
        
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
        
        $getSingleComment = $this->getCommentById($cmntId);
        
        return Response::json(['success'=>true,'data'=>$getSingleComment]);
        
    }
    
    
    public function deleteComment($cmntId){
        
        $delete = \App\Comment::where('cmnt_id','=',$cmntId)
                    ->where('user_id','=',$this->userId)
                    ->delete();
        
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
                       $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->img);
                        
                   $data->user_link       =  URL::to('user/profile/'.$data->uid); 
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
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
        
        $datas = $this->getAllComments($postId,true,$limit,$offset);
        
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
                       $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->img);
                        
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   break;
           }

        return $data;
    }

    public function changePostStatus($postId, $status) {
        $update = Post::where('post_id', '=', $postId)
                ->update(['publish_status' => $status]);
        return Redirect::back();
    }

    public function deletePost($postId) {
        $delete = Post::where('post_id', '=', $postId)
                ->where('user_id', '=', $this->userId)
                ->update([
            'is_deleted' => POST_DELETED
        ]);
        if ($delete) {
            return Response::json(['success' => true]);
        } else {
            return Response::json(['success' => false, 'error' => 'Error while elete this post']);
        }
    }

    public function sharePost($postId, $status) {

        $posts = $this->getPostByPostId($postId);
        
        $post =  $posts[0]; 
        
        $share = new Post();
        
        $share->post_owner = $post->uid;
        $share->user_id = $this->userId;
        $share->is_shared = POST_SHARED_TRUE;
        $share->post_type = $post->post_type;
        $share->external_link = $post->external_link;
        $share->publish_status = $status;
        $share->post_content = $post->post_content;
        $share->tag_line = $post->tag_line;
        $share->post_image = $post->post_image;
        $share->post_video = $post->post_video;
        $share->content_type = $post->content_type;

        $share->save();
        $shareCount = $this->increaseShareCount($postId);
        if ($share->id < 1 && $shareCount) {

            return Response::json(['sucess' => false, 'error' => 'Error while sharing this post!!']);
        } else {

            $post = $this->getPostByPostId($share->id);
            $emojies = $this->getEmoticons();
            $view = View::make('posts.post', ['post' => $post[0], 'emoticons' => $emojies]);

            $sharedPost = $view->render();

            return Response::json(['success' => true, 'post' => $sharedPost, 'share_count' => $shareCount]);
        }
    }

    public function increaseShareCount($postId) {

        $shareCount = Post::where('post_id', '=', $postId)
                ->value('share_count');

        $count = intval($shareCount) + 1;

        $update = Post::where('post_id', '=', $postId)
                ->update(['share_count' => $count]);


        $shareCount = Post::where('post_id', '=', $postId)
                ->value('share_count');
        return $shareCount;
    }

    public function likeObject($like_object, $type) {

        $alreadyLike = \App\Userlike::where('like_object', '=', $like_object)
                ->where('user_id', "=", $this->userId)
                ->where('object_type', "=", $type)
                ->count();

        if ($alreadyLike > 0) {

            UserLike::where('like_object', '=', $like_object)
                    ->where('object_type', "=", $type)
                    ->where('user_id', "=", $this->userId)
                    ->delete();


            $count = UserLike::where('like_object', '=', $like_object)
                    ->where('object_type', "=", $type)
                    ->count();

            return Response::json(array('success' => false, 'count' => $count), 200);
        }

        $like = new \App\Userlike();
        $like->user_id = $this->userId;
        $like->like_object = $like_object;
        $like->object_type = $type;
        $like->save();
        $count = UserLike::where('like_object', '=', $like_object)
                ->where('object_type', "=", $type)
                ->count();


        return Response::json(array('success' => true, 'count' => $count), 200);
    }
    
    public function showSinglePost($postId,Request $request){
        
        $this->middleware('guest');
        
        
        $posts          =   $this->getPostByPostId($postId);
        
        $emoticons      =   $this->getEmoticons();
        
        $notController  =   new NotificationController();
        
        $notController->setSeen($request->nid);
        
        $notifications  =   $notController->getNewNotifications();
        
        
        
        return view('my_network')
                ->with('posts',$posts)
                ->with('emoticons',$emoticons)
                ->with('notifications',$notifications)
                ->with('singlepostview',1)
                ;
    }
    
    public function loadMorePost(){
        
        $posts = $this->getAllPost();
        
        $posts->withPath(url(LOAD_MORE_POST));
        
        $emoticons = $this->getEmoticons();
                
        $view = View::make('posts.loadmoreposts', ['posts' => $posts,'emoticons'=>$emoticons]);

        $view = $view->render();
        
        return Response::json(['success'=>true,'posts'=>$view,'next'=>$posts->nextPageUrl()]);
        
    }

    public function setEmojCat($name,$cat){
        $cat = 5;
        $insert = DB::table('emoji')->insert([
                'cat'=>$cat,
                'name'=>$name
            ]);
        return 1;
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
                       $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->img);
                   
                   $data->user_link       =  URL::to('userprofile/user/'.$data->uid); 
                   
                   $data->user_name       =  $data->user_name; 
                   
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
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
                       $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->img);
                   
                   $data->user_link       =  URL::to('userprofile/user/'.$data->uid); 
                   
                   $data->user_name       =  $data->user_name; 
                   
                   
                   break;
               case "cmppr":
                   if(empty($data->logo_img))
                       $data->profilepic =  URL::to('images/user.png');
                   else
                        $data->profilepic =  URL::to('public/userimages/user_'.$data->uid."/medium/".$data->logo_img);
                   
                   $data->user_link       =  URL::to('showcompany/'.$data->uid); 
                   
                   $data->user_name       =  $data->posted_company_name;
                   
                   break;
           }
            
        }
       
        return $datas; 
    }
    
    public function doBookMark($postId){
        
        $link = URL::to("undobookmark/".$postId);
        
        if($this->isBookMarked($postId, $this->userId)){
            
            $del  = BookMark::where("post_id",$postId)
                
                    ->where("user_id",$this->userId)
                
                    ->delete();
        
            $link = URL::to("dobookmark/".$postId);
            
            return Response::json(["success"=>true,"link"=>$link,"bookmarked"=>false]);
        }
        
        
        $save           = new BookMark;
        $save->user_id  = $this->userId;
        $save->post_id  = $postId;
        $save->save();
        
        return Response::json(["success"=>true,"link"=>$link,"bookmarked"=>true]);
        
    }
    
    public function unDoBookMark($postId){
       
        $del  = BookMark::where("post_id",$postId)
                ->where("user_id",$this->userId)
                ->delete();
        
        $link = URL::to("dobookmark/".$postId);
        
        if($del){
            return Response::json(["success"=>true,"link"=>$link,"bookmarked"=>false]);
        }else{
            return Response::json(["success"=>false,"link"=>$link,"bookmarked"=>false]);
        }
        
    }
    
    public function isBookMarked($postId,$userId){
        $exists = BookMark::where("post_id",$postId)
                       ->where("user_id",$userId)
                       ->count();
        
        return $exists;
                   
    }
    
    public function cmntRepliesCount($cmntId){
        $count = \App\CommentReply::where("cmnt_id",$cmntId)
                  ->count();
        return $count;
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
                       $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->img);
                        
                   $post->user_link       =  URL::to('user/profile/'.$post->uid); 
                   break;
               case "cmppr":
                   if(empty($post->logo_img))
                       $post->profilepic =  URL::to('images/user.png');
                   else
                        $post->profilepic =  URL::to('public/userimages/user_'.$post->uid."/medium/".$post->logo_img);
                   
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
