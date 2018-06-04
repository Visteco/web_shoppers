<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\userProfile_setting;
use App\User;
use App\BlockUser;
use App\userProfile;
use Auth;
use Validator;
use Redirect;
use Hash;
use Response;
use URL;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class UserSettingsController extends Controller
{
    public function __construct() 
    {
       $this->userId = Input::get("user_id");
    }
    
    public function index()
    {
       
        $AdController =  new AdsManagerController();
        $myAds        =  $AdController->getMyAds();
        $userPrivacySetting = userProfile_setting::where('uid',$this->userId)
                                ->first();
        $userRecord = userProfile::where('uid', $this->userId)
                        ->first();
        
        return Response::json(['success'=>"1",'userPrivacySetting'=>[$userPrivacySetting],'userRecord'=>[$userRecord],'myAds'=>$myAds]);
         
        /*return view('settings')
                ->with('userPrivacySetting', $userPrivacySetting)
                ->with('generalSetting', 'true')
                ->with('userRecord', $userRecord)
               ->with('myAds',$myAds);*/
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    
    public function resetPassword(Request $request) 
            {
        
        
        $validation = [
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6'
        ];
        
        $validator = Validator::make($request->all(), $validation);
        $userInfo=user::where('id',$this->userId)
                        ->first();

        if ($validator->passes()) {
            if (!Hash::check($request->currentPassword, $userInfo->password)) {
                return back()->with('cerror', 'You have entered incorrect password!!');
            }
            if ($request->newPassword != $request->confirmPassword)
                return Response::json(['success'=>"0",'Error'=>'Your password and confirmation password do not match!!']);
            
            $update = DB::table('users')->where('id', '=', $this->userId)->update(['password' => Hash::make($request->newPassword)])
            ;

            return Response::json(['success'=>"1",'error'=>'0']);
        }else {
            return Response::json(['success'=>"0",'error'=>'New Password counld not be updated! ']);
        }
    }
    
    
    function privacySetting(Request $request)
    {
        $id=$this->userId;
        $update=0;
       // echo $id;
         $userProfile = userProfile_setting::where('uid',$id)
                                            ->first();
        // echo "hi";
        // print_r($userProfile);
         if($userProfile)
         {
         
            $contact=$userProfile->contact;
            $PostDisplay=$userProfile->PostDisplay;
          
                if(($request->contactMeItem!='' && $contact!=$request->contactMeItem) && ($request->stuffItem!='' && $PostDisplay!=$request->stuffItem))
                {
                   // echo "hi";die;
                     $update =userProfile_setting::where('uid', '=', $id)->update([
                     'contact' => $request->contactMeItem,
                     'PostDisplay' => $request->stuffItem,
                     'updated_at' => Carbon::now()->toDateTimeString(),
                     ]); 
                }
                else
                {
                     if($request->contactMeItem!='' && $contact!=$request->contactMeItem)
                    {
                     $update =userProfile_setting::where('uid', '=', $id)->update([
                     'contact' => $request->contactMeItem,
                     'updated_at' => Carbon::now()->toDateTimeString(),
                      ]); 
                    }
                    else
                    {
                        if($request->stuffItem!='' && $PostDisplay!=$request->stuffItem)
                        {
                         $update =userProfile_setting::where('uid', '=', $id)->update([
                         'PostDisplay' => $request->stuffItem,
                         'updated_at' => Carbon::now()->toDateTimeString(),
                          ]); 
                        }
                    }
                }
         }
         else
         {
             $update = new userProfile_setting();
            $update->uid = $id;
            if($request->contactMeItem)
                $update->contact = $request->contactMeItem;
            if($request->stuffItem)
            $update->PostDisplay = $request->stuffItem;
            $update->updated_at = Carbon::now()->toDateTimeString();
            $update->created_at = Carbon::now()->toDateTimeString();
            $update->save();  
         }
                //$userPrivacySetting = userProfile_setting::all()->where('uid',$id);
                if($update)
                {
                    return Response::json(['success'=>"1",'error'=>'0']);
                }
                else
                {
                 return Response::json(['success'=>"0",'error'=>'Error to save information!']);
                } 
    }
    function socialLinkSetting(Request $request)
    {
        $id=$this->userId;
        $update=0;
        $userRecord = userProfile::all()->where('uid',$id);   
        $update =userProfile::where('uid', '=', $id)->update([
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'skype' => $request->skype,
                    'googleplus' => $request->googleplus,
                    'youtube' => $request->youtube,
                    'linkedin' =>$request->linkedin,
                     ]); 
        if($update)
                {
                     return Response::json(['success'=>"1",'error'=>'0']);
                }
                else
                {
                return Response::json(['success'=>"0",'error'=>'Error to save information!']);
                }
     
    }
    
    function mobileSetting(Request $request)
    {
        $id=$this->userId;
        $update=0;
        $userProfile = userProfile::all()->where('uid',$id); 
        foreach ($userProfile as $key) 
        {
            $contact1=$key->contact;
            $contact2=$key->contact2;
        }
         $validation = [
            'contact1' => 'required|numeric|min:10',
            'newcontact' => 'nullable|numeric|min:10',
            'contact2' => 'nullable|numeric|min:10'
        ];
       $contact1=  $request->contact1;
       $newcontact=  $request->newcontact;
       $contact2=  $request->contact2;
       
       if($contact1)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact' => $contact1,
                    ]);
        }
       if($newcontact)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact2' => $newcontact,
                    ]);
        }
        if($contact2)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact2' => $contact2,
                    ]);
        }
         $userRecord = userProfile::all()->where('uid',$id);
        if($update==1)
                {
                    return Response::json(['success'=>"1",'error'=>'0']);
                }
                else
                {
                 return Response::json(['success'=>"0",'error'=>'Error to save information!']);
                }
    
    
}


/*function blockUserSetting(Request $request)
    {
        $id=Auth::user()->id;
        $userProfile = userProfile::all()->where('uid',$id); 
        foreach ($userProfile as $key) 
        {
            $contact1=$key->contact;
            $contact2=$key->contact2;
        }
         $validation = [
            'contact1' => 'required|numeric|min:10',
            'newcontact' => 'nullable|numeric|min:10',
            'contact2' => 'nullable|numeric|min:10'
        ];
       $contact1=  $request->contact1;
       $newcontact=  $request->newcontact;
       $contact2=  $request->contact2;
       
       if($contact1)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact' => $contact1,
                    ]);
        }
       if($newcontact)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact2' => $newcontact,
                    ]);
        }
        if($contact2)
        {
        $update =userProfile::where('uid', '=', $id)->update([
                    'contact2' => $contact2,
                    ]);
        }
         $userRecord = userProfile::all()->where('uid',$id);
        if($update==1)
                {
                    return back()
                        ->with('mobileSetting', '1')
                         ->with('userRecord', $userRecord)
                         ->with('successmobileSetting', 'Updated Successfully!'); 
                }
                else
                {
                 return back()
                         ->with('mobileSetting', '1')
                         ->with('userRecord', $userRecord)
                         ->with('updatemobileError', 'Enable Update!');    
                }
    
    
}*/

function listForBlockUser()
{
    $this->keyname = Input::get("keyname");
    $this->uid = Input::get("uid");
    $uid=$this->uid;
    $name=$this->keyname;
    $i=0;
    $list=$this->blockedUser_List($this->userId);
    $str=[0,0];
    foreach($list as $l)
    {
        $str[$i]=$l['uid'];
        $i++;
    }
    $listOfUser =  DB::table('users')
                    ->join('userprofiles','userprofiles.uid','=','users.id')
                    ->where('users.user_name' ,'like' ,"%$name%")
                    ->where('users.id' ,'!=' ,$this->userId)
                    ->whereNotIn('users.id', $str)
                    ->select("users.id as id","userprofiles.img as image","userprofiles.fname as fname","userprofiles.lname as lname" )
                    ->get();
    if($listOfUser)
        return Response::json(['success'=>"1",'userlist'=>$listOfUser]);
    else
        return Response::json(['success'=>"0",'error'=>'There is no data to display']); 
}

function blockUser()
{
    $usersId=$this->userId;
    $this->idforblock = Input::get("idforblock");
    $id=$this->idforblock;
    $loginUser=$blockedUser='';
    $blockuser = BlockUser::all()->where('user_id',$usersId)
                                  ->where('blocked_id',$id); 
    foreach ($blockuser as $user) 
    {
        $loginUser=$user->user_id;
        $blockedUser=$user->blocked_id;
    }
    if($loginUser=='' && $blockedUser=='')
    {
        $temp = new BlockUser();
        $temp->user_id = $this->userId;
        $temp->blocked_id = $id;
        $temp->blockuser_status = "1";
        $temp->updated_at = Carbon::now()->toDateTimeString();
        $temp->created_at = Carbon::now()->toDateTimeString();
        $temp->save();  
    }
    else
    {
        $temp =BlockUser::where('user_id',$usersId)
                    ->where('blocked_id',$id)
                    ->update([
                     'blockuser_status'=>'1',
                     'updated_at' =>Carbon::now()->toDateTimeString(),
                     ]); 
    }
    /*$list=$this->blockedUser_List($usersId);
    $userPrivacySetting = userProfile_setting::all()->where('uid',Auth::user()->id);
    $userRecord = userProfile::all()->where('uid', $this->userId);
    $AdController =  new AdsManagerController();
    $myAds        =  $AdController->getMyAds();
    //return \Illuminate\Support\Facades\Response::json(array('success' => true, 'blockuserArray' => $blocked_user_list));
    return back()
                         ->with('userPrivacySetting', $userPrivacySetting)
                         ->with('userRecord', $userRecord)
                         ->with('myAds',$myAds)
                         ->with('generalSetting', '4')
                         ->with('blockedUserList', $list);*/
    if($temp)
        return Response::json(['success'=>"1",'error'=>'0']);
    else
        return Response::json(['success'=>"0",'error'=>'Error to block this user!']); 
                          
        
    
}



  function unblockUser()
{
  $usersId=$this->userId;
  $this->idforunblock = Input::get("idforunblock");
  $id=$this->idforunblock;
   $temp =BlockUser::where('user_id',$usersId)
                    ->where('blocked_id',$id)
                    ->update([
                     'blockuser_status'=>'0',
                     'updated_at' =>Carbon::now()->toDateTimeString(),
                     ]); 
   
   if($temp)
        return Response::json(['success'=>"1",'error'=>'0']);
    else
        return Response::json(['success'=>"0",'error'=>'Error to unblock this user!']); 
}

function blockUserForMsg($id)
{
  $usersId=$this->userId;
  $blockuser_for_msg_status=1;
  $loginUser=$blockedUser='';
   $blockuser = BlockUser::where('user_id',$usersId)
                            ->where('blocked_id',$id)
                            ->get(); 
        foreach ($blockuser as $user) 
        {
            $loginUser=$user->user_id;
            $blockedUser=$user->blocked_id;
        }
        
        if($loginUser=='' && $blockedUser=='')
        {
            $temp = new BlockUser();
            $temp->user_id = $this->userId;
            $temp->blocked_id = $id;
            $temp->blockuser_for_msg_status = $blockuser_for_msg_status;
            $temp->updated_at = Carbon::now()->toDateTimeString();
            $temp->created_at = Carbon::now()->toDateTimeString();
            $temp->save();  
        }
        else
        {
            $temp =BlockUser::where('user_id',$usersId)
                    ->where('blocked_id',$id)
                    ->update([
                     'blockuser_for_msg_status' =>$blockuser_for_msg_status,
                     'updated_at' =>Carbon::now()->toDateTimeString(),
                     ]); 
        }
       if($temp)
            return Response::json(['success'=>"1",'error'=>'0']);
        else
            return Response::json(['success'=>"0",'error'=>'Error to block this user!']); 
      
    
}

function unblockUserForMsg($id)
{
  $usersId=$this->userId;
  $blockuser_for_msg_status=0;
  $loginUser=$blockedUser='';
   $blockuser = BlockUser::where('user_id',$usersId)
                            ->where('blocked_id',$id)
                            ->get(); 
        foreach ($blockuser as $user) 
        {
            $loginUser=$user->user_id;
            $blockedUser=$user->blocked_id;
        }
        
        if($loginUser!='' && $blockedUser!='')
        {
           $temp =BlockUser::where('user_id',$usersId)
                    ->where('blocked_id',$id)
                    ->update([
                     'blockuser_for_msg_status' =>$blockuser_for_msg_status,
                     'updated_at' =>Carbon::now()->toDateTimeString(),
                     ]);  
            if($temp)
                return Response::json(['success'=>"1",'error'=>'0']);
            else
                return Response::json(['success'=>"0",'error'=>'Error to unblock this user!']); 
        }
        else
        {
            return Response::json(['success'=>"0",'error'=>'Error to unblock this user!']); 
        }
}

function blockedUser_List($uid)
{
    $blockedUserList =  DB::table('users')
                    ->join('blockedusers','blockedusers.user_id','=','users.id')
                    ->where('blockedusers.blockuser_status',1)
                    ->where('users.id',$uid)
                    ->select("blockedusers.blocked_id as blockeduser")
                    ->get();
    $i=0;
    $blocked_user_list=array();
    foreach($blockedUserList as $blockedID)
    {
        $blockeduser = User::where('id','=',$blockedID->blockeduser)
                             ->first();
        $blocked_user_list[$i]['uid']= $blockeduser->id;
        $blocked_user_list[$i]['name']= $blockeduser->user_name;
        $i++;
    }
   //echo count($blocked_user_list);
    //print_r($blocked_user_list);die;
    
        return $blocked_user_list;
}




function blockedusersss()
{
    $blockedUserList =  DB::table('users')
                    ->join('blockedusers','blockedusers.user_id','=','users.id')
                    ->where('blockedusers.blockuser_status',1)
                    ->where('users.id',$this->userId)
                    ->select("blockedusers.blocked_id as blockeduser")
                    ->get();
    $i=0;
    $blocked_user_list=array();
    foreach($blockedUserList as $blockedID)
    {
        $blockeduser = User::where('id','=',$blockedID->blockeduser)
                             ->first();
        $blocked_user_list[$i]['uid']= $blockeduser->id;
        $blocked_user_list[$i]['name']= $blockeduser->user_name;
        $i++;
    }
   //echo count($blocked_user_list);
    //print_r($blocked_user_list);die;
     
            return Response::json(['success'=>"1",'blockedlist'=>$blocked_user_list]);
       
       // return $blocked_user_list;
}


}
