<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use Auth;

use Hash;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;



class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $userId;
    
    
    
        public function __construct(Request $request) {
            
            $this->userId = $request->userId;
            
        }
    
        public function doLogin(Request $request,$type){
            if($type == 1){
              $validator = Validator::make($request->all(), [
                    'email'           =>      'required|email',
                    'password'        =>      'required|min:6',
               ]);

              if ($validator->fails()) {

              
              $messages = $validator->messages();
              
              return Response::json(['success' => RESPONSE_FALSE, 'message' => $messages,'error_type'=>"obj"]);
              
              
              }   

              if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) && Auth::user()->status == 2) {
                    $userProfile     =  \App\Userprofile::where("uid",Auth::user()->id)->first();
                    
                    $companyProfile  = \App\CompanyProfile::where("uid",Auth::user()->id)->first();
                    
                    
                    if( count($userProfile) ){
                        $profilePic = URL::to("public/userimages/user_".$userProfile->uid."/medium/".$userProfile->img);
                        $coverPic   = URL::to("public/userimages/user_".$userProfile->uid."/profile_background/".$userProfile->background_img);
                    }else{
                        $profilePic = URL::to("public/userimages/user_".$companyProfile->uid."/medium/".$companyProfile->img);
                        $coverPic   = URL::to("public/userimages/user_".$companyProfile->uid."/profile_background/".$companyProfile->background_img);
                    }
                    
                    return Response::json(['success'=>RESPONSE_TRUE,'error'=>'0','data'=>Auth::user(),'img'=>$profilePic,'cover'=>$coverPic]);
                    
                }else{
                    
                    $validator->errors()->add('autherror', 'Email or password is incorrect!');
                    return Response::json(['success' => RESPONSE_FALSE,'message'=>"Your account yet not activate,please check your email and activate your acount" ,'error_type'=>"str"]);
                }
              }else{
                return Response::json(['success' => RESPONSE_FALSE,'message'=>"Email or password is incorrect" ,'error_type'=>"str"]);
              }
          }else{
              $input = $request->all();
              if(array_key_exists('email', $input)){
                $validator = Validator::make($request->all(), [
                  'email'           =>      'required|email'
                ]);
                $type = 'email';
                $validate_field = 'Email';
                $request_field = $request->email;
              }else{
                $validator = Validator::make($request->all(), [
                  'name'            =>      'required'
                ]);
                $type = 'user_name';
                $validate_field = 'Username';
                $request_field = $request->name;
              }

              if ($validator->fails()) {
                $messages = $validator->messages();
                return Response::json(['success' => RESPONSE_FALSE, 'message' => $messages,'error_type'=>"obj"]);
              }    
              $user_data = \DB::table('users')->where($type,$request_field)->first();
              if(!empty($user_data )){
                  $userProfile     =  \App\Userprofile::where("uid",$user_data->id)->first();
                
                  $companyProfile  = \App\CompanyProfile::where("uid",$request->id)->first();
                  if(!empty($userProfile) || !empty($companyProfile)){
                    if( count($userProfile) ){
                        $profilePic = URL::to("public/userimages/user_".$userProfile->uid."/medium/".$userProfile->img);
                        $coverPic   = URL::to("public/userimages/user_".$userProfile->uid."/profile_background/".$userProfile->background_img);
                    }else{
                        $profilePic = URL::to("public/userimages/user_".$companyProfile->uid."/medium/".$companyProfile->img);
                        $coverPic   = URL::to("public/userimages/user_".$companyProfile->uid."/profile_background/".$companyProfile->background_img);
                    }
                    return Response::json(['success'=>RESPONSE_TRUE,'error'=>'0','data'=>$user_data,'img'=>$profilePic,'cover'=>$coverPic]);
                  }else{
                    return Response::json(['success'=>RESPONSE_TRUE,'error'=>'0','data'=>$user_data]);
                  }
              }else{
                  // $this->createLoginRegistration($input); 
                  return Response::json(['success' => RESPONSE_FALSE,'message'=>"".$validate_field." or User type is incorrect or not registered" ,'error_type'=>"str"]);
              }
            
          }
      }
      public function createLoginRegistration($request_data){
        echo '<pre>';
        print_r($request_data);die;
      }
}
