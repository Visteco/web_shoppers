<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\CompanyProfile;
use Response;
use App\BusinessCard;
use App\UserCard;

define("CARD_APPROVED",1);

define("CARD_REJECT",0);



class VcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userId;
    
    
    public function __construct($userId = null) {
        $this->userId = Input::get('user_id');
    }
    
    public function shareBusinessCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE]);
        }
        
        
        $alreadySent = BusinessCard::where('sender_user','=',$this->userId)
                        ->where('receiver_user',"=",$request->to_user)
                        ->count();
        
        if($alreadySent){
            return Response::json(["success"=>RESPONSE_FALSE,"message"=>"Card already sent!!"]);
        }
        
        $save                   =  new BusinessCard;
        
        $save->sender_user      =  $this->userId;
        
        $save->receiver_user    =  $request->to_user;
        
        $save->save();
        
        return Response::json(["success"=>RESPONSE_TRUE,"error"=>0]);
        
    }
    
    
    
    public function shareUserCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE]);
        }
        
        $alreadySent = BusinessCard::where('sender_user','=',$this->userId)
                        ->where('receiver_user',"=",$request->to_user)
                        ->count();
        
        if($alreadySent){
            return Response::json(["success"=>RESPONSE_FALSE,"message"=>"Card already sent!!"]);
        }
        
        $save                   =  new UserCard;
        
        $save->sender_user      =  $this->userId;
        
        $save->receiver_user    =  $request->to_user;
        
        $save->save();
        
        return Response::json(["success"=>RESPONSE_TRUE,"error"=>0]);
        
    }
    
    
    public function cancelUserCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE]);
        }
        $delete = UserCard::where('sender_user',$this->userId)
                    
                    ->where("receiver_user",$request->to_user)
                    
                    ->delete();
        
        if($delete){
            
            return Response::json(['success'=>RESPONSE_TRUE]);
            
        }else{
            
            return Response::json(['success'=>RESPONSE_FALSE,'message'=>"Error in process"]);
            
        }
    }
    
     public function cancelBusinessCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE]);
            
        }
        $delete = CompanyCard::where('sender_user',$this->userId)
                    
                    ->where("receiver_user",$request->to_user)
                    
                    ->delete();
        
        if($delete){
            
            return Response::json(['success'=>RESPONSE_TRUE]);
            
        }else{
            
            return Response::json(['success'=>RESPONSE_FALSE,'message'=>"Error in process"]);
            
        }
    }
    
    
    public function getBusinessCards(Request $request){
        
        $data = BusinessCard::join('userprofiles',"userprofiles.uid","=","business_cards.sender_user")
                
                ->orderBy("userprofiles.fname","ASC")
               
                ->where('business_cards.receiver_user',$this->userId)
                
                ->where("user_cards.approval_status",$request->type)
                
                ->paginate(5);
        
         return Response::json(["success"=>RESPONSE_TRUE,"data"=>$data]);
        
    }
    
    public function getUserCards(Request $request){
        
        $data = UserCard::join('userprofiles',"userprofiles.uid","=","user_cards.sender_user")
                
                ->orderBy("userprofiles.fname","ASC")
               
                ->where('user_cards.receiver_user',$this->userId)
                
                ->where("user_cards.approval_status",$request->type)
                
                ->paginate(5);
        
         return Response::json(["success"=>RESPONSE_TRUE,"data"=>$data]);
    }
    
    public function approveBusinessCards(Request $request){
        
        $validator = Validator::make($request->all(), [
            'card_id'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE]);
            
        }
        
        $update = BusinessCard::where("receiver_user",$this->userId)
                    ->where("card_id",$request->card_id)
                    ->update(['approval_status'=>CARD_APPROVED]);
        
        if($update)
            return Response::json(["success"=>RESPONSE_TRUE]);
        else
            return Response::json(["success"=>RESPONSE_FALSE]);
    }
    
    public function approveUserCards(Request $request){
        
        $validator = Validator::make($request->all(), [
            'card_id'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE,"error"=>1]);
            
        }
        
        $update = UserCard::where("receiver_user",$this->userId)
                    ->where("card_id",$request->card_id)
                    ->update(['approval_status'=>CARD_APPROVED]);
        
        if($update)
            return Response::json(["success"=>RESPONSE_TRUE]);
        else
            return Response::json(["success"=>RESPONSE_FALSE]);
    }
    
    
    public function suggestedUsers(){
        
        $sentUSers = UserCard::where("sender_user",$this->userId)
                        ->pluck("sender_user");
        
        $users = \App\userProfile::whereNotIn('uid', $sentUSers)
                  ->paginate(10);
        
        return Response::json(["success"=>RESPONSE_TRUE,"users"=>$users]);
        
    }
    
    public function suggestedCompanies(){
        
        $sentUSers = BusinessCard::where("sender_user",$this->userId)
                        ->pluck("sender_user");
        
        $users = \App\CompanyProfile::whereNotIn('uid', $sentUSers)
                        ->paginate(10);
        
        return Response::json(["success"=>RESPONSE_TRUE,"users"=>$users]);
        
    }
    
    
    public function rejectUserCard(Request $request){
        $validator = Validator::make($request->all(), [
            'card_id'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE,"error"=>1]);
            
        }
        
        $del = UserCard::where("card_id",$request->card_id)
                    ->delete();
        
        if($del){
            return Response::json(["success"=>RESPONSE_TRUE,'error'=>""]); 
        }else{
            return Response::json(["success"=>RESPONSE_FALSE,'error'=>""]); 
        }
    }
    
    public function rejectCompanyCard(Request $request){
        $validator = Validator::make($request->all(), [
            'card_id'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>RESPONSE_FALSE,"error"=>1]);
            
        }
        
        $del = BusinessCard::where("card_id",$request->card_id)
                    ->delete();
        
        if($del){
            return Response::json(["success"=>RESPONSE_TRUE,'error'=>""]); 
        }else{
            return Response::json(["success"=>RESPONSE_FALSE,'error'=>""]); 
        }
    }
    
}
