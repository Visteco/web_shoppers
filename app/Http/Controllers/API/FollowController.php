<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Userfollowing;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class FollowController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    
    private $userId;
    public function __construct() {
        $this->userId = Input::get("user_id");
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

    public function getAllFollowersIds($uid){
        
        $users = Userfollowing::where('following_id','=',$uid)
                ->pluck('user_id')
               
                ;
        
        return  $users;
        
    }
    
    public function getAllFollowingsIds($uid){
        $users = Userfollowing::where('user_id','=',$uid)
                ->pluck('following_id')
                 ->toArray()
                ;
        
        return  $users;
    }
    
    public function doFollow($followto,$userId) {

        // $userId = $this->userId;
        
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
                return Response::json(array('follow' => RESPONSE_FALSE), 200);
            } else {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_TRUE]);
                
                return Response::json(array('follow' => RESPONSE_TRUE), 200);
            }
        } else {

            $follow = new Userfollowing;
            $follow->following_id = $followto;
            $follow->user_id = $userId;
            $follow->following_status = FOLLOW_TRUE;
            $follow->object_type = USER_FOLLOW_CONST;
            $follow->save();

            return Response::json(array('follow' => RESPONSE_TRUE), 200);
        }
    }
    
    public function doFollowCompany($followto) {
        $userId = $this->userId;
        print_r($userId);die;
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
         
                return Response::json(array('follow' => RESPONSE_FALSE), 200);
                
            } else {

                Userfollowing::where('following_id', "=", $followto)
                        ->where('user_id', "=", $userId)
                        ->update(['following_status' => FOLLOW_TRUE]);
                return Response::json(array('follow' => RESPONSE_TRUE), 200);
                
            }
        } else {

            $follow = new Userfollowing;
            $follow->following_id = $followto;
            $follow->user_id = $userId;
            $follow->following_status = FOLLOW_TRUE;
            $follow->object_type = COMPANY_FOLLOW_CONST;
            $follow->save();

            return Response::json(array('follow' => RESPONSE_TRUE), 200);
        }
    }

}
