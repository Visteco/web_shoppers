<?php

namespace App\Http\Controllers;

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



class VcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userId;
    
    
    
    
    
    public function __construct($userId = null) {
    
        if(is_null($userId)){
                
                $this->middleware(function ($request, $next) {
                
                if(Auth::check())    
                    $this->userId= auth()->user()->id;

                return $next($request);
            });
        }else{
            $this->userId = $userId;
        }
    }
    
    public function shareBusinessCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>false]);
        }
        
        
        $alreadySent = BusinessCard::where('sender_user','=',$this->userId)
                        ->where('receiver_user',"=",$request->to_user)
                        ->count();
        
        if($alreadySent){
            return Response::json(["success"=>false,"message"=>"Card already sent!!"]);
        }
        
        $save                   =  new BusinessCard;
        
        $save->sender_user      =  $this->userId;
        
        $save->receiver_user    =  $request->to_user;
        
        $save->save();
        
        return Response::json(["success"=>true,"error"=>0]);
        
    }
    
    
    
    public function shareUserCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>false]);
        }
        
        $alreadySent = BusinessCard::where('sender_user','=',$this->userId)
                        ->where('receiver_user',"=",$request->to_user)
                        ->count();
        
        if($alreadySent){
            return Response::json(["success"=>false,"message"=>"Card already sent!!"]);
        }
        
        $save                   =  new UserCard;
        
        $save->sender_user      =  $this->userId;
        
        $save->receiver_user    =  $request->to_user;
        
        $save->save();
        
        return Response::json(["success"=>true,"error"=>0]);
        
    }
    
    
    public function cancelUserCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>false]);
        }
        $delete = UserCard::where('sender_user',$this->userId)
                    
                    ->where("receiver_user",$request->to_user)
                    
                    ->delete();
        
        if($delete){
            
            return Response::json(['success'=>true]);
            
        }else{
            
            return Response::json(['success'=>false,'message'=>"Error in process"]);
            
        }
    }
    
     public function cancelBusinessCard(Request $request){
        
        $validator = Validator::make($request->all(), [
            'to_user'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['success'=>false]);
            
        }
        $delete = UserCard::where('sender_user',$this->userId)
                    
                    ->where("receiver_user",$request->to_user)
                    
                    ->delete();
        
        if($delete){
            
            return Response::json(['success'=>true]);
            
        }else{
            
            return Response::json(['success'=>false,'message'=>"Error in process"]);
            
        }
    }
    
    
    public function getBusinessCards($status){
       
        $data = BusinessCard::join('companyprofiles',"companyprofiles.uid","=","business_cards.sender_user")
                
                ->orderBy("companyprofiles.company_name","ASC")
               
                ->where('business_cards.receiver_user',$this->userId)
                
                ->where("business_cards.approval_status",$status)
                
                ->paginate(10);
        
        
         return $data;
         
         
         
        
    }
    
    public function getUserCards($status){
        
        $data = UserCard::join('userprofiles',"userprofiles.uid","=","user_cards.sender_user")
                
                ->orderBy("userprofiles.fname","ASC")
               
                ->where('user_cards.receiver_user',$this->userId)
                
                ->where("user_cards.approval_status",$status)
                
                ->paginate(10);
         return $data;
    }
    
    
}
