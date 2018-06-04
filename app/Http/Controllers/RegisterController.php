<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\User;

use App\CompanyProfile;

use App\userProfile;

use Illuminate\Http\Request;

use Redirect;

use Validator;

use Hash;

use Auth;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\URL;


class RegisterController extends Controller {
    
    
    
    public function doRegister(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'role'      => 'required',
            "turms"     => 'required', 
        ]);

        if ($validator->fails()) {
            
           
            return  redirect('/')
                   ->withErrors($validator,'register')
                    ->withInput();
            
        }else{
           
           $user                    =    new User();
           
           $user->user_name         =    $request->get('name');
           
           $user->email             =    $request->get('email');
           
           $user->password          =    Hash::make($request->get('password'));
           
           $user->login_role        =    $request->get('role');
           
           $user->save();
           
           $nextEntry = false;   
           
           if($this->sendMailToVerification($request->get('email'), $user->id)) {
           
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
                   
                   
                   return  redirect('/')
                   ->withErrors($response["validator"],'register')
                   ->withInput();
                   
               }else{
                       
                    $nextEntry = true; 
                   
                }
               
           }
                   
           if ( Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]) && $nextEntry==true ) {
                return  redirect('/');
           }
           
           
        }else{
               echo "error";
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
    
    public function sendMailToVerification($email,$uid){
        
        $token = md5(uniqid('KP'));
        
        $update = User::where('id','=',$uid)
                    ->update(['verification_token'=>$token]);
        
        $activation_link = URL::to("activate/".$token.'/'.$uid);
        
        $mail = Mail::send('email.mail', ['name' => "Ankur", 'activation_link' => $activation_link], function ($message) use($email, $activation_link) {
            $message->to($email,"ankur" )
            ->subject('Hi, greeting from visteco!');
        });
        return true;
    }
    
    public function verifyAndRedirect($token,$uid){
        
        
        $user = User::where('verification_token','=',$token)
                        ->where('id','=',$uid)
                        ->where('status','=',0)
                        ->first();
        if(count($user)){
            
            $update = User::where('id','=',$uid)
                        ->update(['status'=>2]);
            
             Auth::login($user);
             
             return  redirect('/my-network');
             
        }else{
                echo "false";
               // return  redirect('/');
        }
        
    } 
   
}