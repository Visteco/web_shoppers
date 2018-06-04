<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userProfile;
use App\User;
use Hash;
use App\ChangePassword;
use App\Gallery;
use Validator;
use Redirect;
use Image;
use Auth;
use Response;
use URL;
use DB;
use Illuminate\Support\Facades\Input; 
use App\Service;

define("STAFF_APPROVED",1);

class UserController extends Controller
{
    public function getFollowers($id,$flag='limited') {
        $userFollowersUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $id)
                       ->select("userprofiles.uid as followingUser","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
         $userFollowersCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $id)
                       ->select("companyprofiles.uid as followingUser","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city")
                       ->get();
         
         if($flag=='all')
         {
         $userRecord = userProfile::where('uid','=',$id)->get();
         $getFollowingsList=$this->getFollowings($id);
         $companyfollowing="";
          return view('hana.userfollowers')
                      ->with('followerCompany', $userFollowersCompany)
                      ->with('followerUser', $userFollowersUser)
                      ->with('userRecord',$userRecord)
                      ->with('companyfollowing',$companyfollowing)
                      ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                      ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                      ->with('userID',$id);
         }
         else
         {
            return["follower_user"=>$userFollowersUser,"follower_company"=>$userFollowersCompany];
         }

    }
     public function getFollowings($id,$flag='limited') {
        $userFollowingsUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $id)
                       ->select("userprofiles.uid as followingUser","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
        $userFollowingsCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $id)
                       ->select("companyprofiles.uid as followingUser","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city")
                       ->get();
       

         if($flag=='all')
         {
              $userRecord = userProfile::where('uid','=',$id)->get();
         $getFollowersList=$this->getFollowers($id);
         
         
         $companyfollowing="";
          return view('hana.userfollowings')
                      ->with('followingCompany', $userFollowingsCompany)
                      ->with('followingUser', $userFollowingsUser)
                      ->with('userRecord',$userRecord)
                      ->with('companyfollowing',$companyfollowing)
                      ->with('getFollowersUserList', $getFollowersList['follower_user'])
                      ->with('getFollowerscompanyList', $getFollowersList['follower_company'])
                      ->with('userID',$id);
         }
         else
         {       
           return["following_user"=>$userFollowingsUser,"following_company"=>$userFollowingsCompany];
         }

    }
    public function index()
    {
        $id=Auth::user()->id;
        
        $PostController = new PostController($id);
         $follow     = new FollowController(Auth::user()->id);
         $trendingPosts =  $PostController->getAllPost(true);
        
        $userRecord = userProfile::where('uid','=',Auth::user()->id)->get();
        //$userGallery = Gallery::all()->where('user_id', $id);
        $getFollowersList=$this->getFollowers($id);
        $getFollowingsList=$this->getFollowings($id);
        $getFollowersList['follower_user']=$this->checkAlreadyFollowing($getFollowersList['follower_user']);
        $getFollowersList['follower_company']=$this->checkAlreadyFollowing($getFollowersList['follower_company']); 
        $notification = new NotificationController();
        $notifications = $notification->getNewNotifications(); 
        
        $galleries      = $this->getGallariesImages(Auth::user()->id); 
         
        extract($galleries);
        
        $letters       = $this->getVletters();
        
        extract($letters);
        
        $bookMarks     =   $PostController->getBookMarkPosts();
        
        
        return view('hana.user_profile')
                ->with('trendingPosts',$trendingPosts)
                ->with('displayLI', 'defaultValue')
                ->with('status', '')
                ->with('getFollowersUserList', $getFollowersList['follower_user'])
                ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                //->with('userGallery', $userGallery)
                ->with('userRecord', $userRecord)
                ->with('notifications', $notifications)
                ->with("profilePics",$profilePics)
                ->with("coverPics",$coverPics)
                ->with("postImages",$postImages)
                ->with("serviceImages",$serviceImages)
                ->with("pendingCards",$pendingCards)
                ->with("approvedCards",$approvedCards)
                ->with("bookmarks",$bookMarks)
                ;
        
    }
    
    

   public function showProfilePic()
   {
       //$userID = userProfile::all()->where('uid', Auth::user()->id);
       
       
   }
    public function create()
    {
        //
    }

    
    
    public function chngPics(Request $request) {
        
        /*$this->validate($request, [

        'image_src' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);*/
        $rules = array(
            'image_src' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
        $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $usr_id = Auth::user()->id;
        $image = $request->file('image_src');
        if ($image) {

            $DIR = 'public/userimages/user_' . $usr_id;
            $SMALL = $DIR . '/' . 'small/';
            $MEDIUM = $DIR . '/' . 'medium/';
            $ORG = $DIR . '/' . 'original/';
            //$helper = new App\http\Controllers\HelperController();

            if (!file_exists($DIR)) {

                mkdir($DIR, 0755, true);

                if (!file_exists($SMALL))
                    mkdir($SMALL, 0755, true);

                if (!file_exists($MEDIUM))
                    mkdir($MEDIUM, 0755, true);

                if (!file_exists($ORG))
                    mkdir($ORG, 0755, true);
            }
            else {
                if (file_exists($DIR)) {

                    //mkdir($DIR);

                    if (!file_exists($SMALL))
                        mkdir($SMALL, 0755, true);

                    if (!file_exists($MEDIUM))
                        mkdir($MEDIUM, 0755, true);

                    if (!file_exists($ORG))
                        mkdir($ORG, 0755, true);
                }
            }



            /* new code added for remove replacement of iphone posts from other posts date:3/10/2016 */
            
            $filename = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            // $ORG = str_replace("public/","",$ORG);

            // $location = public_path($ORG);
            $location = $ORG;
            
            $image->move($location, $filename);
                    
            $imageController =  new ImageController($usr_id);
            $thumbMedium            =  $imageController->resizeImage(140, 140, $filename, $ORG.$filename, $MEDIUM."/".$filename);  
            $thumbSmall             =  $imageController->resizeImage(35,30, $filename, $ORG.$filename, $SMALL."/".$filename);         
                    
            //copy($MEDIUM . $filename, $SMALL . $filename);
            //copy($MEDIUM . $filename, $ORG . $filename);
            
            if($thumbMedium && $thumbSmall) {
            $update =userProfile::where('uid', '=', $usr_id)->update(['img' => $filename]); 
            
            session(['profilepic' =>$filename]);
                
                return Response::json(array('success' => true, 'img' => URL($MEDIUM . $filename)), 200);
            }else{
                return Response::json(array('success' => false, 'message'=>'Error to upload image'), 200);
            }
        }
    }
    
    
    public function uploadImg(Request $request) {
       
       //print_r($request);die;
        $validator = Validator::make($request->all(), [
            
             'bgimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            
        ]);
        
        if($validator->fails()){
            return Response::json(array('success' => false), 200);
        }

        $usr_id = Auth::user()->id;
       
        $image = $request->file('image');
        
        
            $DIR = 'public/userimages/user_' . Auth::user()->id;

            $BACKGROUND = $DIR . '/' . 'profile_background/';


            if (!file_exists($DIR)) {

                mkdir($DIR);
            }

                if (!file_exists($BACKGROUND)){
                    mkdir($BACKGROUND);
            }


          
            $extension = Input::file('bgimage')->getClientOriginalExtension();

            $randomName = uniqid();

            $img = $randomName . "." . $extension;


          

            $position = Input::get('position');

            $path = public_path() . '/images/';

            Input::file('bgimage')->move($BACKGROUND, $img);

            Userprofile::where('uid', Auth::user()->id)
                    ->update(
                            ['background_img' => $img, 'position' => $position]
            );

            return Response::json(array('success' => true, 'img' => URL($BACKGROUND . $img)), 200);
        
    }
    
    
    
    
   public function updateUserProfileInfo(Request $request)
    {
      $loginUserId=Auth::user()->id;
      $getFollowersList=$this->getFollowers($loginUserId);
      $getFollowingsList=$this->getFollowings($loginUserId);
      $userRecord = userProfile::all()->where('uid', Auth::user()->id);
      $index=0;
      $checkboxValue=array();
      for($i=1;$i<=16;$i++)
      {
          $var='check'.$i;
          $temp=trim($request->$var);
          if($temp)
          {
            $index++;
            $checkboxValue[$index]=trim($temp);
            $temp='';
          }
      }
      if(count($checkboxValue)!=0)
        $primaryWorkFields = implode (",", $checkboxValue);
      else
        $primaryWorkFields="";  
     foreach ($userRecord as $key) {
            $email_id=$key->email;
        }
        $new_eamil_id=$request->emailId;
        if($email_id!=$new_eamil_id)
        {
           $newRecord = userProfile::all()->where('email', $new_eamil_id);
            foreach ($newRecord as $value) {
            $email_idNew=$value->email;
            $userId=$value->uid;
            if($userId!=$loginUserId)
                {
                return Redirect::back();
                
                /*return view('user_profile')
                                ->with('status', 'Entered email ID already exist with another USER!')
                                ->with('displayLI', 'userProfileDisplay') 
                                ->with('getFollowersUserList', $getFollowersList['follower_user'])
                                ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                                ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                                ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                                ->with('userRecord', $userRecord);
                 */
                }
            }
        }
        else
        {
        
        $update =userProfile::where('uid', Auth::user()->id)->update([
                'fname' => $request->firstName,
                'pres_desg' => $request->jobTitle,
                'pres_org' => $request->companyName,
                'city' => $request->city,
                'state' => $request->state,
                'poscode' =>$request->zip,
                'country' => $request->country,
                'contact' => $request->phNumber,
                'email' => $request->emailId,
                'prev_org' => $request->previousComName,
                'sumry' => $request->aboutUs,
                'primaryWorkFields' =>$primaryWorkFields,
                ]);
        //$userRecord = userProfile::all()->where('uid', Auth::user()->id)->with('status', 'Successfully Updated!');
        
        
        
        if($request->company_uid > 0){
            $set = $this->setApproval($request->company_uid);
        }
        
        
        return Redirect::back()->with('status', 'Successfully Updated!');
        /*return view('user_profile')
                 ->with('status', 'Successfully Updated!')
                ->with('displayLI', 'userProfileDisplay')
                ->with('getFollowersUserList', $getFollowersList['follower_user'])
                ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                ->with('userRecord', $userRecord);*/
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function galleryImages($imageType)
    {
        $id=Auth::user()->id;
        $userGallery = Gallery::all()->where('user_id', $id);
        return view('galleryImages')
                ->with('userGallery', $userGallery)
                ->with('img_type', $imageType);
                
    }
    public function galleryFolder()
    {
        
        return view('hana.galleryFolders');
                
    }
    
   public function showUserProfile($id){
        
        $userRecord = userProfile::where('uid','=',$id)->get();
        //$userGallery = Gallery::all()->where('user_id', $id);
        $getFollowersList=$this->getFollowers($id);
        $getFollowingsList=$this->getFollowings($id);
        $getFollowersList['follower_user']=$this->checkAlreadyFollowing($getFollowersList['follower_user']);
        $getFollowersList['follower_company']=$this->checkAlreadyFollowing($getFollowersList['follower_company']); 
        $getFollowingsList['following_user']=$this->checkAlreadyFollowing($getFollowingsList['following_user']);
        $getFollowingsList['following_company']=$this->checkAlreadyFollowing($getFollowingsList['following_company']); 
        
        
        $notification = new NotificationController();
        $notifications = $notification->getNewNotifications(); 
        $PostController = new PostController($id);
        $trendingPosts =  $PostController->getAllPost();
        $galleries      = $this->getGallariesImages($id); 
         
        extract($galleries);
        
        $alreadyFollowingUser = DB::table('userfollowings')
                    ->where('following_id', "=", $id)
                    ->where('user_id', "=", Auth::user()->id)
                    ->where('following_status', '=', 1)
                    ->count();
        if($alreadyFollowingUser)
            $UserAlreadyFollowing="1";
        else
            $UserAlreadyFollowing="0";
        
        
        
        return view('hana.show_user_profile')
                ->with('displayLI', 'defaultValue')
                ->with('trendingPosts',$trendingPosts)
                ->with('status', '')
                ->with('UserAlreadyFollowing',$UserAlreadyFollowing)
                ->with('getFollowersUserList', $getFollowersList['follower_user'])
                ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                //->with('userGallery', $userGallery)
                ->with('userRecord', $userRecord)
                ->with("profilePics",$profilePics)
                ->with("coverPics",$coverPics)
                ->with("postImages",$postImages)
                ->with("serviceImages",$serviceImages)
               
                ->with('notifications', $notifications);
   }
   
    //***************************************************************

    public function forgotPassword(Request $request) {
        $inputs = $request->all();
        $validator = Validator::make(array('email' => $inputs['email']),['email' => 'required|email']);
        if($validator->fails()){
            return redirect('/forgot-password')->withErrors($validator)->withInput();
        }else{
            $email = $request->email;

            $str = "qwerrttyuiopassfghjklzxcvbnmAQWERTY121313UIOPSDFGHJKLZXCVBNM123456778890";
            $token = str_shuffle($str);
            
            $user = user::where('email','=',$email)->first();
            
            if($user=='')
            {
                $request->session()->flash('alert-danger','Invalid Email ID!');
                return redirect('/forgot-password');
              // return Response::json(['success'=>"0", 'error' => "Invalid Email ID!"]);   
            }
            $uid = $user->id;
            $link = URL::to('resetpassword/?t=' . $token.'&uid='.$uid);
          
             $checkUser =  ChangePassword::where('uid','=',$uid)
                               ->first();
             if($checkUser)
             {
            $create=ChangePassword::where('uid', $uid)->update([
                    'token' =>$token,
                    
                    ]);
             }
             else
             {
              $create=ChangePassword::Create(['token'=>$token, 'uid'=>$uid]);   
             }
          
            if ($create) 
            {
                $this->sendMail($email,$link,$user->user_name);
                $text="Please check your E-mail.If You do not get the mail then please check your Spam.";
                $request->session()->flash('alert-success',$text);
                return redirect('/forgot-password');
                // echo $text;
               //return Response::json(['success'=>"1", 'error' => "0"]);   
            } 
            else 
            {
                $text="sorry something went wrong !!</font>";
                $request->session()->flash('alert-danger',$text);
                return redirect('/forgot-password');
                //return Response::json(['success'=>"0", 'error' => "Error to send Reset Password Email!"]);  
            }
        }
    }
    
    public function requireToVar($file,$link)
    {
        ob_start();
        require($file);
        return ob_get_clean();
    }
    public function sendMail($to, $link, $user_name) 
    {
        $subject = "Welcome to Shoppers change your password";
        $message = '<center style="width: 100%; background: #901913; padding: 20px;"><table align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="border:none;background: #ffffff;padding: 21px;">
             <tr>
              <td style="border: none;border-bottom: 1px solid grey;">
              <h2 style="color: #6a6060;">Hi, '.ucfirst($user_name).'</h2>
              </td>
             </tr>
             <tr>
             <td>
             </td>      
             </tr>
             <tr>
             <td style="border: none;">
             <p style="font-size: 16px;color: #590f66;">It looks like you requested a new password</p>
             </td>      
             </tr>
             <tr>
              <td style="border: none;">
              <p style="font-size: 16px;color: #590f66;"> Click here to change your password,connected to the following link</p><p style="font-size: 16px;"><a href="'.$link.'" style="color: #FF5722;">'.$link.'</a></p>
              </td>
             </tr>

            </table></center>';
            // echo $message;die;
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <forgotpass@shoppers.social>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$message,$headers);
        // $subject = "Welcome to Visteco change your password";
        // $fileName='emailTemplate.php';
        // $message =$this->requireToVar($fileName,$link);
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers .= 'From: <forgotpass@shoppers.social>' . "\r\n";
        // mail($to, $subject, $message, $headers);
    }
    
    
    public function validateToken(Request $request) {
       // echo "neha rana";die;
       $token = $request->t;
        
        $uid   = $request->uid;
 
        $checkValidUser =  ChangePassword::where('uid','=',$uid)
                                ->where('token','=',$token)
                                ->first();
        if ($checkValidUser) {

           // $this->Redirect(URL."?action=showpasform&uid=".$uid);
           // echo "neh";die;
           return Redirect::to("showpasform?uid=".$uid);
            
        } else {
            return Response::json(['success'=>"0", 'error' => "Error to save informmation"]);
        }
     }
    
    public function showPasForm(Request $request){
       // echo "neha";die;
        
        $uid = $request->uid;
        return view('changepas')
                    ->with('uid', $uid);
        //return Redirect::to("showpasform?uid=".$uid);
      //  include 'changepas.php';
        
    }
    
   public function saveNewPassword(Request $request){
        //echo "neha";die;
        
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        $user_id = $request->uid;
        //echo $newpass;
       // echo $user_id;
       // echo $confirmpass;
       // die;
        
        if($newpass==$confirmpass)
         {
             $password=Hash::make($newpass);
          $update = user::where('id', '=', $user_id)->update(['password' => $password]);
        if ($update) {
                return Response::json(['success'=>"1", 'error' => "0"]);
            } else {
                return Response::json(['success'=>"0", 'error' => "Error to save informmation"]);
            
            }
        
        }
        else
        {
          return Response::json(['success'=>"0", 'error' => "Confirmed Password not Matched"]);
        }
    }
    
    
    public function getGallariesImages($id){
        
        
        $profilePics = "userimages/user_".$id."/medium/";
        
        $coverPics   = "userimages/user_".$id."/profile_background/";
        
        $galleries   = [];
        
        $galleries["postImages"]    = [];
        $galleries["serviceImages"] = [];
        $galleries["coverPics"]     = [];
        $galleries["profilePics"]   = [];
        
        if(is_dir($profilePics))
        {
        $pr          =      scandir($profilePics);
        }
        
        if(is_dir($coverPics))
        {        
        $cv          =      scandir($coverPics);  
        }
        
        $services    =      Service::where("user_id",Auth::user()->id)
                                  
                                    ->where("is_deleted",0)
                
                                    ->take(1)
                
                                    ->orderBy("id","DESC")
                                    
                                    ->get();
         
        
        $posts      =       \App\Post::where("user_id",Auth::user()->id)
                                  
                                    ->where("is_deleted",0)
                                    
                                    ->where("post_type",1)
                                    
                                    ->where("content_type",1)
                                    
                                    ->whereRaw("LENGTH(post_image)>3")
                
                                    ->orderBy("post_id","DESC")
                
                                    ->take(1)
                
                                    ->get(); 
        
       
        
        foreach($services as $service){
            $service->image = URL::to("images/services/".$service->image); 
            $galleries["serviceImages"][]= $service->image;
        }
        
       
        
        foreach($posts as $post){
            $post->post_image = URL::to("images/posts/".$post->post_image); 
            $galleries["postImages"][]= $post->post_image; 
        }
        
        if(is_dir($coverPics))
        {
            for($i=2; $i < 3; $i++){
            $galleries["coverPics"][] = URL::to($coverPics.$cv[$i]);
            }
        }
        
        if(is_dir($profilePics))
        {
            for($i=2; $i < 3; $i++){
            $galleries["profilePics"][] = URL::to($profilePics.$pr[$i]);
            }
        }
        
        
        
        return $galleries;
    }
    
    
    public function getGalleriesImages($cat,$id){
        
        $images = [];
        
        
        
        $profilePics = "userimages/user_".$id."/medium/";
        
        
        $coverPics   = "userimages/user_".$id."/profile_background/";
        
        
        switch($cat){
            case 1:
                
                $posts      =       \App\Post::where("user_id",$id)
                                  
                                    ->where("is_deleted",0)
                    
                                    ->whereRaw("LENGTH(post_image)>3")
                
                                    ->pluck("post_image"); 
        
                foreach($posts as $post){
                    $images[] = URL::to("images/posts/".$post); 
                }
        
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Uploads")
                        ->with("userID",$id)
                        ;
                
                break;
            
              case 2:
                
                $services    =      Service::where("user_id",$id)
                                  
                                    ->where("is_deleted",0)
                                    
                                    
                                    ->pluck("image");
        
        
                foreach($services as $service){
                    
                        
                        $images[] = URL::to("images/services/".$service); 
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Services Images")
                        ->with("userID",$id)
                        ;
                
                break;
            
           
            case 3:
                
                if(is_dir($profilePics)){
                    $pr          =      scandir($profilePics);
                }
                
                for($i=2; $i < count( $pr ); $i++){
                
                    $images[] = URL::to($profilePics.$pr[$i]);
            
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Profile Pictures")
                        ->with("userID",$id)
                        ;
                
                break;
            
            case 4:
                
                if(is_dir($coverPics)){
                    $cv          =      scandir($coverPics);  
                    
                    for($i=2; $i < count( $cv ); $i++){
                
                    $images[] = URL::to($coverPics.$cv[$i]);
            
                }
                
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Cover Pictures")
                        ->with("userID",$id)
                        ;
                
                break;
        }
    }
    
    
    public function getGallery(){
        
        $galleries      = $this->getGallariesImages(); 
        
        extract($galleries);
        
        return view("posts.galleries")
                ->with("profilePics",$profilePics)
                ->with("coverPics",$coverPics)
                ->with("postImages",$postImages)
                ->with("serviceImages",$serviceImages)
                ->with("userID",$id)
                ;
   }

   public function getVletters(){
        
        
        $vcard  =  new VcardController(Auth::user()->id);
        
        
        $pendingCard    =  $vcard->getUserCards(0);
        
        
        $approvedCard   =  $vcard->getUserCards(1);
        
        
        return ["pendingCards"=>$pendingCard,"approvedCards"=>$approvedCard];
        
    } 
    
    public function setApproval($cmpId){
       
       $save = new \App\ApprovalRequest;
       
       $save->user_id = Auth::user()->id;
       
       $save->company_id = $cmpId;
       
       $save->save();
   
       return true;
    }

public function checkAlreadyFollowing($check_array)
{
    foreach($check_array as $follower)
        {
            $alreadyFollowing = DB::table('userfollowings')
                    ->where('following_id', "=", $follower->followingUser)
                    ->where('user_id', "=", Auth::user()->id)
                    ->where('following_status', '=', 1)
                    ->count();
        if($alreadyFollowing)
            $follower->alreadyFollowing="1";
        else
            $follower->alreadyFollowing="0";
        }
return $check_array;        
}
    public function forgot_password(Request $request)
    {
        // $inputs = $request->all();
        return view('user.forgot_password');
    }
    public function resetPassword(Request $request)
    {
        $inputs = $request->all();
        return view('user.reset_password',array('id' => $inputs['uid']));
    }
    public function createResetPassword(Request $request, $id)
    {
        $inputs = $request->all();
        $validator =  Validator::make(array('password' => $inputs['password']), ['password' => 'required|min:6']);
        if($validator->fails()){
            return redirect('/resetpassword?t='.$inputs['fp_code'].'&uid='.$id)->withErrors($validator)->withInput();
        }else{
            $password = bcrypt($inputs['password']);
            $data = DB::table('users')->where('id',$id)->update(['password' => $password]);
            $request->session()->flash('alert-success','You have been password reset successfully');
            return redirect('/resetpassword?t='.$inputs['fp_code'].'&uid='.$id);
        }
    }
}
