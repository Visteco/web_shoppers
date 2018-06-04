<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Userfollowing;

use Illuminate\Support\Facades\Response;


class FollowController extends Controller {

    
    private $userId;
    
    public function __construct($userId = null) {
        
        
        
           if(is_null($userId)){
                
                $this->middleware(function ($request, $next) {
                
                $this->userId= auth()->user()->id;

                return $next($request);
            }); 
           
          }else{
              $this->userId = $userId;
          }
       
        
    }
    
    
    public function userFollowers() {
        return view('userfollowers');
    }

    public function userFollowings() {
        return view('userfollowings');
    }

    public function companyFollowers() {
        return view('companyfollowers');
    }

    public function companyFollowings() {
        return view('companyfollowings');
    }

    public function getSuggestedUsers($count=2){
        
       $followings = [];
       $followings = $this->getAllFollowingsIds($this->userId);  
        
        if(count($followings) == 0 ){
           
            
            $followings[] = $this->userId;
            
        }else{
           
           array_unshift($followings,$this->userId); 
        }
        
        
        $users = \App\userProfile::whereNotIn('uid',$followings)
            
                    ->take($count)
                
                    ->get();  
        
       
        return $users;

    }
    
    public function getSuggestedCompanies($count=2){
        
        $followings = [];
        
        $followings = $this->getAllFollowingsIds($this->userId);  
        
        
        if(count($followings) == 0 ){
           
            
            $followings[] = $this->userId;
            
        }else{
           
           array_unshift($followings,$this->userId); 
        }
        
        $companies = \App\CompanyProfile::whereNotIn('uid',$followings)
            
                    ->take($count)
                
                    ->get();  
        
       
        return $companies;
    }
    
    
    
    public function getAllFollowersIds($uid){
        
        $users = Userfollowing::where('following_id','=',$uid)
                ->where('following_status','=',FOLLOW_TRUE)
                ->pluck('user_id')
               
                ;
        
        return  $users;
        
    }
    
    public function getAllFollowingsIds($uid){
        
        $users = Userfollowing::where('user_id','=',$uid)
                ->where('following_status','=',FOLLOW_TRUE)
                ->pluck('following_id')
                
                 ->toArray()
                ;
        
        return  $users;
    }
    
    public function doFollow($followto) {

        if (!Auth::check()) {
            return Response::json(['sucess'=>true,'message'=>'session time out!']);
        }
        $userId = Auth::user()->id;
        
        $exists = Userfollowing::where('following_id', "=", $followto)
                    ->where("object_type", "=", USER_FOLLOW_CONST)
                    ->where('user_id', "=", $userId)
                    ->count();

        if ($exists > 0) {

            $alreadyFollow = Userfollowing::where('following_id', "=", $followto)
                    ->where("object_type", "=", USER_FOLLOW_CONST)
                    ->where('user_id', "=", $userId)
                    ->where('following_status', '=', FOLLOW_TRUE)
                    ->count();

            if ($alreadyFollow > 0) {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_FALSE]);
                return Response::json(array('follow' => false), 200);
            } else {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_TRUE]);
                
                return Response::json(array('follow' => true), 200);
            }
        } else {

            $follow = new Userfollowing;
            $follow->following_id = $followto;
            $follow->user_id = $userId;
            $follow->following_status = FOLLOW_TRUE;
            $follow->object_type = USER_FOLLOW_CONST;
            $follow->save();

            return Response::json(array('follow' => true), 200);
        }
    }
    
    public function doFollowCompany($followto) {

        if (!Auth::check()) {
            return Response::json(['sucess'=>true,'message'=>'session time out!']);
        }


        $userId = Auth::user()->id;
        
        $exists = Userfollowing::where('following_id', "=", $followto)
                    ->where("object_type", "=", COMPANY_FOLLOW_CONST)
                    ->where('user_id', "=", $userId)
                    ->count();

        if ($exists > 0) {

            $alreadyFollow = Userfollowing::where('following_id', "=", $followto)
                          ->where("object_type", "=", COMPANY_FOLLOW_CONST)
                           ->where('user_id', "=", $userId)
                           ->where('following_status', '=', FOLLOW_TRUE)->count();

            if ($alreadyFollow > 0) {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_FALSE]);
         
                return Response::json(array('follow' => false), 200);
                
            } else {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_TRUE]);
                return Response::json(array('follow' => true), 200);
                
            }
        } else {

            $follow = new Userfollowing;
            $follow->following_id = $followto;
            $follow->user_id = $userId;
            $follow->following_status = FOLLOW_TRUE;
            $follow->object_type = COMPANY_FOLLOW_CONST;
            $follow->save();

            return Response::json(array('follow' => true), 200);
        }
    }

}
