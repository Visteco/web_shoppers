<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\userProfile;
use App\User;
use App\ChangePassword;
use App\Gallery;
use Validator;
use Redirect;
use Image;
use Auth;
use Response;
use URL;
use Hash;
use DB;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    private $userId;
    
    public function __construct() {
        
        $this->userId = Input::get("user_id");
        
    }
    public function getFollowers() {
        $userFollowersUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $this->userId)
                       ->select("userprofiles.uid as id","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
         $userFollowersCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $this->userId)
                       ->select("companyprofiles.uid as id","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city","companyprofiles.company_type as company_type")
                       ->get();
         return Response::json(['success'=>"1",'followerCompany'=>$userFollowersCompany,'followerUser'=>$userFollowersUser]);
             
            /* view('userfollowers')
                      ->with('followerCompany', $userFollowersCompany)
                      ->with('followerUser', $userFollowersUser)
                      ->with('userID',$id);*/
    }
     public function getFollowings() {
        $userFollowingsUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $this->userId)
                       ->select("userprofiles.uid as id","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
        $userFollowingsCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $this->userId)
                       ->select("companyprofiles.uid as id","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city","companyprofiles.company_type as company_type")
                       ->get();

             return Response::json(['success'=>"1",'followingCompany'=>$userFollowingsCompany,'followingUser'=>$userFollowingsUser]);
         
         /* return view('userfollowings')
                      ->with('followingCompany', $userFollowingsCompany)
                      ->with('followingUser', $userFollowingsUser)
                      ->with('userID',$id);*/
         

    }
    public function index($json=false)
    {
        $PostController = new PostController($this->userId);
         
         $trendingPosts =  $PostController->getAllPost();
        $userRecord = userProfile::all()->where('uid','=',$this->userId)
                           ->first();
        
        if(empty($userRecord->img)){
             $profilePic = URL::to("images/user.png");
         }else{
             $profilePic = URL::to("public/userimages/user_".$this->userId."/medium/".$userRecord->img);
         }
         
         if(empty($userRecord->background_img)){
             $coverPic = URL::to("images/user.png");
         }else{
             $coverPic = URL::to("public/userimages/user_".$this->userId."/profile_background/".$userRecord->background_img);
         }
         
         return Response::json(
                        [   'success'=>'1',
                            'trendingPosts'=>$trendingPosts,
                            'userRecord'   =>  $userRecord,
                            'profilePic'=>  $profilePic,
                            'coverPic'  =>  $coverPic,
                            
                        ]
                 );
        
        
        
        
        /*//$userGallery = Gallery::all()->where('user_id', $id);
        $getFollowersList=$this->getFollowers($id);
        $getFollowingsList=$this->getFollowings($id);
        
        $notification = new NotificationController();
        $notifications = $notification->getNewNotifications(); 
        //print_r($getFollowingsList);die;
        return view('hana.user_profile')
                ->with('displayLI', 'defaultValue')
                ->with('status', '')
                ->with('getFollowersUserList', $getFollowersList['follower_user'])
                ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                //->with('userGallery', $userGallery)
                ->with('userRecord', $userRecord)
                ->with('notifications', $notifications);*/
                
        
    }
    
    

   public function showProfilePic()
   {
       //$userID = userProfile::all()->where('uid', $this->userId);
       
       
   }
    public function UserBasicInfo()
    {
        //$userProfileCover=URL::to('/public/userimages/user_'.$this->userId.'/profile_background/');
        //$userProfilePic=URL::to('/public/userimages/user_'.$this->userId.'/medium/');
        $userInfo=userProfile::where('uid',$this->userId)
                 ->first();
        $userProfileCover=URL::to('/public/userimages/user_'.$this->userId.'/profile_background/'.$userInfo->background_img);
        $userProfilePic=URL::to('/public/userimages/user_'.$this->userId.'/medium/'.$userInfo->img);
        if($userInfo->img)
            $userInfo->img=$userProfilePic;
        else
            $userInfo->img='NULL';
        if($userInfo->background_img)
            $userInfo->background_img=$userProfileCover;
        else
            $userInfo->background_img='NULL';
        return Response::json(['success'=>"1",'userInfo'=>[$userInfo]]);
    }

    public function chngPics(Request $request) 
    {
        $validator = Validator::make($request->all(), [
                              'image' => 'required',
        ]);
        
        if ($validator->fails()) 
        {
            return Response::json(['success' => '0', 'error' => $validator->errors()]);
        }
        $usr_id = $this->userId;
        $image = trim($request->image);
        $extension = '.jpg';
        if ($image) 
        {
            $DIR = 'public/userimages/user_' . $usr_id;
            $SMALL = $DIR . '/' . 'small/';
            $MEDIUM = $DIR . '/' . 'medium/';
            $ORG = $DIR . '/' . 'original/';
            if (!file_exists($DIR)) 
            {
                mkdir($DIR);
                if (!file_exists($SMALL))
                    mkdir($SMALL);
                if (!file_exists($MEDIUM))
                    mkdir($MEDIUM);
                if (!file_exists($ORG))
                    mkdir($ORG);
            }
            else 
            {
                if (file_exists($DIR)) 
                {
                    if (!file_exists($SMALL))
                        mkdir($SMALL);
                    if (!file_exists($MEDIUM))
                        mkdir($MEDIUM);
                    if (!file_exists($ORG))
                        mkdir($ORG);
                }
            }
            $filename = time() . rand(1000, 9999).$extension;
            //$filename_otherfolder = $filename.$extension;
            $file = fopen( $MEDIUM.$filename, "w+");
            if ($file) 
            {
                $put = file_put_contents($MEDIUM.$filename, base64_decode(trim($image)));
               // $imageController =  new ImageController($this->userId);
               // $thumbMedium            =  $imageController->resizeImage(140, 140, $filename, $ORG.$filename, $MEDIUM."/".$filename);  
               // $thumbSmall             =  $imageController->resizeImage(35,30, $filename, $ORG.$filename, $SMALL."/".$filename);  
               // if ($put && $thumbMedium && $thumbSmall) 
                if($put)
                {
                    //copy($MEDIUM . $filename, $SMALL . $filename);
                   // copy($MEDIUM . $filename, $ORG . $filename);
                    $update = userProfile::where('uid', '=', $usr_id)->update(['img' => $filename]);
                    $profile = url($MEDIUM.$filename);
                    return Response::json(['success' => '1', 'profile' => $profile]);
                } 
                else 
                {
                    return Response::json(['success' => '0']);
                }
            }
        }
    }
        
        
        
        
   public function uploadImg(Request $request) 
    {
        $validator = Validator::make($request->all(), [
                              'cover' => 'required',
        ]);
        
        if ($validator->fails()) 
        {
            return Response::json(['success' => '0', 'error' => $validator->errors()]);
        }
        $usr_id = $this->userId;
        $image = trim($request->cover);
        $extension = '.jpg';
        if ($image) 
        {
           $DIR = 'public/userimages/user_' . $this->userId;
          $cover = $DIR . '/' . 'profile_background/';
            
            
                if(!file_exists($DIR))
                    mkdir($DIR);

                if (!file_exists($cover))
                    mkdir($cover);
            $filename = time() . rand(1000, 9999).$extension;
            //$filename_otherfolder = $filename.$extension;
            $file = fopen( $cover.$filename, "w+");
            if ($file) 
            {
                $put = file_put_contents($cover.$filename, base64_decode(trim($image)));
                if ($put) 
                {
                    $update = userProfile::where('uid', '=', $usr_id)->update(['background_img' => $filename]);
                    $profile = url($cover.$filename);
                    return Response::json(['success' => '1', 'profilecover' => $profile]);
                } 
                else 
                {
                    return Response::json(['success' => '0']);
                }
            }
        }
    }     
        
    public function forgotPassword(Request $request) 
    {
        $email = $request->email;
        $validator = Validator::make(['email' => $email],['email' => 'required|email']);
        if($validator->fails()){
            return Response::json(['success'=> '0','error' => $validator->errors()]);
        }else{
            $str = "qwerrttyuiopassfghjklzxcvbnmAQWERTY121313UIOPSDFGHJKLZXCVBNM123456778890";
            $token = str_shuffle($str);
            
            $user =  user::where('email','=',$email)
                               ->first();
            //$uid = $user->id;
           
            if(empty($user)){
                return Response::json(['success'=>"0", 'error' => "Invalid Email ID!"]);   
            }
            $uid = $user->id;
            $link = URL::to('api/verifyuser/?t=' . $token.'&uid='.$uid);
           
            $checkUser =  ChangePassword::where('uid','=',$uid)
                           ->first();

            if($checkUser){
                $create=ChangePassword::where('uid', $uid)->update([
                    'token' =>$token,
                    ]);
            }else{
                $create=ChangePassword::Create(['token'=>$token, 'uid'=>$uid]);   
            }
          
            if ($create){
                $this->sendMail($email,$link);
               // $text="<p><font color='blue' >Please check your E-mail.<br>If You do not get the mail then please check your Spam.</font></p>";
               // echo $text;
               return Response::json(['success'=>"1", 'error' => "0"]);   
            }else{
               // $text="<p><font color='red' >sorry something went wrong !!</font></p>";
               // echo $text;
                return Response::json(['success'=>"0", 'error' => "Error to send Reset Password Email!"]);  
            }
        }
    }
    
    public function requireToVar($file,$link)
    {
        ob_start();
        require($file);
        return ob_get_clean();
    }
    public function sendMail($to, $link) 
    {
        $subject = "Welcome to Visteco change your password";
        // $fileName='emailTemplate.php';
        $message = $this->requireToVar($fileName,$link);
        print_r($message);die;
        // $message = 'Password Change';
        $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers = "From: vineetcs144@gmail.com\r\n";
        // $headers .= 'From: <forgotpass@shoppers.social>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }    
       
       
    
  /*  public function uploadImg(Request $request) {
        echo "nehaRana";
       // print_r($request);die;
        $this->validate($request, [

        'bgimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',

    ]);

        $usr_id = $this->userId;
        $image = $request->file('image');
        if ($image) {
            echo "hi";die;

            $DIR = 'public/userimages/user_' . $this->userId;

            $BACKGROUND = $DIR . '/' . 'profile_background/';


            if (!file_exists($DIR)) {

                mkdir($DIR);

                if (!file_exists($BACKGROUND))
                    mkdir($BACKGROUND);
            }


            // new code added for remove replacement of iphone posts from other posts date:3/10/2016 
            $extension = Input::file('image')->getClientOriginalExtension();

            $randomName = uniqid();

            $img = $randomName . "." . $extension;


            // end 

            $position = Input::get('position');

            $path = public_path() . '/images/';

            Input::file('image')->move($BACKGROUND, $img);

            Userprofile::where('uid', $this->userId)
                    ->update(
                            ['background_img' => $img, 'position' => $position]
            );

            return Response::json(array('success' => true, 'img' => URL($BACKGROUND . $img)), 200);
        }else {
            return Response::json(array('success' => false), 200);
        }
    }
    */
    
    
    
   public function updateUserProfileInfo(Request $request)
    {
        $loginUserId=$this->userId;
        //echo $this->userId;
        //echo "--Fname---".$request->firstName;
        //echo "--Lname---".$request->lastName;
        
        $update =userProfile::where('uid', $this->userId)->update([
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
                'primaryWorkFields' =>$request->primaryWorkFields,
                ]);
      if($update)
        return Response::json(['success'=>"1"]);
      else
        return Response::json(['success'=>"0"]);  
        
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
        $id=$this->userId;
        $userGallery = Gallery::all()->where('user_id', $id);
        return view('galleryImages')
                ->with('userGallery', $userGallery)
                ->with('img_type', $imageType);
                
    }
    public function galleryFolder()
    {
        
        return view('hana.galleryFolders');
                
    }
    
    
    
    
    public function validateToken(Request $request) {
       // echo "neha";
        //die;
        $token = $request->t;
        
        $uid   = $request->uid;
 
        $checkValidUser =  ChangePassword::where('uid','=',$uid)
                                ->where('token','=',$token)
                                ->first();
        //print_r($checkValidUser);die;
        if ($checkValidUser) {

           // $this->Redirect(URL."?action=showpasform&uid=".$uid);
           return Redirect::to("api/showpasform?uid=".$uid);
            
        } else {
            return Response::json(['success'=>"0", 'error' => "Error to save informmation"]);
        }
     }
    
    public function showPasForm(Request $request){
        
        $uid = $request->uid;
        include 'changepas.php';
        
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
    
    
}
