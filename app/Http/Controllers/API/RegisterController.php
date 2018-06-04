<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\User;

use App\CompanyProfile;

use App\userProfile;

use Illuminate\Http\Request;

use Redirect;

use Validator;

use Hash;

use URL;

use Auth;

use DB;

use App\ChangePassword;

use Illuminate\Support\Facades\Response;



class RegisterController extends Controller {
    
    
    
    public function doRegister(Request $request){
        $inputs = $request->all();
        $name_error = Validator::make(array('name'=>$inputs['name']),['name'      => 'required|max:100']);
        $email_error =Validator::make(array('email'=>$inputs['email']),['email'      => 'required|email']);
        $pass_error = Validator::make(array('password'=>$inputs['password']),['password'      => 'required|min:6']);
        $role_error =Validator::make(array('role'=>$inputs['role']),['role' => 'required']);
        $email_data = \DB::table('users')
          ->where('email',$inputs['email'])
          ->where('login_role',$inputs['role'])
          ->first();
        if($name_error->fails()){
        // if ($validator->fails()) {
           return Response::json(['success' => '0', 'error' => array('Message' => $name_error->errors()->first(),'Type' => ucwords($name_error->errors()->keys()[0]))]);
            
        }else if($email_error->fails()){
          return Response::json(['success' => '0', 'error' => array('Message' => $email_error->errors()->first(),'Type' => ucwords($email_error->errors()->keys()[0]))]);

        }else if(!empty($email_data)){
          return Response::json(['success' => '0', 'error' => array('Message' =>'The email has already been taken.','Type' => 'Email')]);
        }else if($pass_error->fails()){
           return Response::json(['success' => '0', 'error' => array('Message' => $pass_error->errors()->first(),'Type' => ucwords($pass_error->errors()->keys()[0]))]);

        }else if($role_error->fails()){
           return Response::json(['success' => '0', 'error' => array('Message' => $role_error->errors()->first(),'Type' => ucwords($role_error->errors()->keys()[0]))]);

        }else{
           $user                    =    new User();
           
           $user->user_name         =    $request->get('name');
           
           $user->email             =    $request->get('email');
           
           $user->password          =    Hash::make($request->get('password'));
           
           $user->login_role        =    $request->get('role');
           
           $user->save();
           
           $nextEntry = false;    
      
           if($request->role == USER_PROFILE ){
               
               $data  =  [
                            'name'  =>  $request->name,
                            'uid'   =>  $user->id,
                            'email' =>  $request->email,
                            
                         ];
               
               $set = $this->registerUser($data);
               if($set)
                   $nextEntry = true;
               
           }else if($request->role == COMPANY_PROFILE) {
               
               $data  =  [
                            'company_name'  =>  $request->name,
                            'contact_email' =>  $request->email,
                            'uid'           =>  $user->id,
                         ];
           
               
               $response = $this->registerCompany($data);
               
               $error   = $response["error"];
               
               if($error){
                   
                   
                  return Response::json(['success' => '0', 'error' => $response["validator"]->errors()]);
                   
               }else{
                       
                    $nextEntry = true; 
                   
                }
               
           }else{
              $nextEntry = true; 
           }
  
           if ( Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]) && $nextEntry==true ) {
                return Response::json(['success'=>RESPONSE_TRUE,'error'=>'0','data'=>Auth::user()]);
           }
        }
    }
    
    public function registerCompany($data){
        $validator = Validator::make($data, [
            'company_name'        => 'required|unique:companyprofiles|max:100',
            'contact_email'       => 'required',  
            'uid'                 => 'required',  
        ]);

        if ($validator->fails()) {
            
            User::where('id','=',$data['uid'])
                    ->delete();
            
            $validator->getMessageBag()->add('name', 'Please choose a unique name '.$data['company_name']." is already exists!!");
            
            return ['error'=>true,'validator'=>$validator];
            
            
        }
      
        $save                   =  new CompanyProfile;
        $save->company_name     =  $data['company_name'];     
        $save->contact_email    =  $data['contact_email'];    
        $save->uid              =  $data['uid'];    
        $save->save();
        
        return ['error'=>false,];
        
    }
    
    public function registerUser($data){
        
        $save           =  new userProfile;
        $save->fname    =  $data['name'];     
        $save->lname    =  " ";     
        $save->email    =  $data['email'];    
        $save->uid      =  $data['uid'];    
        $save->save();
        return $save->id;
        
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
            
            $uid = $user->id;
            if(empty($user)){
                return Response::json(['success'=>"0", 'error' => "Invalid Email ID!"]);   
            }
            $uid = $user->id;
            $link = URL::to('resetpassword/?t=' . $token.'&uid='.$uid);
            
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
                $this->sendMail($email,$link,$user->user_name);
               $text="<p><font color='blue' >Please check your E-mail.<br>If You do not get the mail then please check your Spam.</font></p>";
               // echo $text;
               return Response::json(['success'=>"1", 'Message' => $text]);   
            }else{
               $text="<p><font color='red' >sorry something went wrong !!</font></p>";
               // echo $text;
                return Response::json(['success'=>"0", 'error' => $text]);  
            }
        }
    }
    
    public function requireToVar($file,$link)
    {
        ob_start();
        require($file);
        echo $file;die;
        return ob_get_clean();
    }
    public function sendMail($to, $link, $user_name) 
    {
       
        // $fileName='emailTemplate.php';
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
        // $message = $this->requireToVar($fileName,$link);

        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers = "From: <vineetcs144@gmail.com>"."\r\n";
        // // $headers .= 'From: <forgotpass@shoppers.social>' . "\r\n";
        // mail($to, $subject, $message, $headers);
    }
}