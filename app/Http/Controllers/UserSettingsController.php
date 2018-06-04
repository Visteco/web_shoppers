<?php

namespace App\Http\Controllers;
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
use URL;
use DB;
use Session;
class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $usersId=Auth::user()->id;
        $AdController =  new AdsManagerController();
        $myAds        =  $AdController->getMyAds();
        $userPrivacySetting = userProfile_setting::all()->where('uid',Auth::user()->id);
        $userRecord = userProfile::all()->where('uid', Auth::user()->id);
        $list=$this->blockedUser_List($usersId);
        return view('hana.settings')
                ->with('userPrivacySetting', $userPrivacySetting)
                ->with('generalSetting', 1)
                ->with('userRecord', $userRecord)
                ->with('blockedUserList', $list)
               ->with('myAds',$myAds);
       
       
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
    
    public function resetPassword(Request $request) {
        
        if (!Auth::check()) {
            return Redirect::to('/')
                            ->with('flash_error', 'Oops something wents wrong ,Please login to continue');
        }
        $validation = [
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6'
        ];
        //die;

        //  print_R($request->all());
        //return;

        $validator = Validator::make($request->all(), $validation);

        if ($validator->passes()) {
            if (!Hash::check($request->get('currentPassword'), Auth::user()->password)) {
                return back()->with('cerror', 'You have entered incorrect password!!');
            }
            if ($request->get('newPassword') != $request->get('confirmPassword'))
                return back()->with('cerror', 'Your confirm password should be matched to your new password!!');


            $update = DB::table('users')->where('id', '=', Auth::user()->id)->update(['password' => Hash::make($request->get('newPassword'))])
            ;

            return back()->with('success', "Password reset successfully!!");
        }else {
            return back()->with('paserror', 'The following errors occurred')->withErrors($validator);
        }
    }
    
    
    function privacySetting(Request $request)
    {
        $id=Auth::user()->id;
        $userProfile = userProfile_setting::where('uid',$id)
                            ->first();
        if($userProfile)
        {
            $contact=$userProfile->contact;
            $PostDisplay=$userProfile->PostDisplay;
            
            if(($request->contactMeItem!='' && $contact!=$request->contactMeItem) && ($request->stuffItem!='' && $PostDisplay!=$request->stuffItem))
            {
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
         // $create=ChangePassword::Create(['token'=>$token, 'uid'=>$uid]);
            if($request->contactMeItem!='' && $request->stuffItem!='' )
                $update=userProfile_setting::Create(['uid'=>$id, 'PostDisplay'=>$request->stuffItem, 'contact'=>$request->contactMeItem]);
            else
            {
              if($request->contactMeItem!='' && $request->stuffItem=='' ) 
              {
                  $update=userProfile_setting::Create(['uid'=>$id, 'contact'=>$request->contactMeItem]);
              }
              else
              {
                 $update=userProfile_setting::Create(['uid'=>$id, 'PostDisplay'=>$request->stuffItem]); 
              }
            }
        }    
                
                $userPrivacySetting = userProfile_setting::all()->where('uid',$id);
                if($update)
                {
                    
                    return back()
                        ->with('userPrivacySetting', $userPrivacySetting)
                         ->with('generalSetting', '3')
                         ->with('successPrivacySetting', 'Updated Successfully!'); 
                }
                else
                {
                 return back()
                        ->with('generalSetting', '3')
                        ->with('userPrivacySetting', $userPrivacySetting)
                        ->with('updateError', 'Not Updated!');    
                } 
                
                
    }
    function socialLinkSetting(Request $request)
    {
        $id=Auth::user()->id;
        $userRecord = userProfile::all()->where('uid',$id);   
        $update =userProfile::where('uid', '=', $id)->update([
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'skype' => $request->skype,
                    'googleplus' => $request->googleplus,
                    'youtube' => $request->youtube,
                    'linkedin' =>$request->linkedin,
                     ]); 
        if($update==1)
                {
                    return back()
                        ->with('generalSetting', 6)
                         ->with('userRecord', $userRecord)
                         ->with('successsocialLinksSetting', 'Updated Successfully!'); 
                }
                else
                {
                 return back()
                         ->with('socialLinksSetting', '1')
                         ->with('userRecord', $userRecord)
                         ->with('updateSocialLinkError', 'Enable Update!');    
                }
     
    }
    
    function mobileSetting(Request $request)
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
                        ->with('mobileSetting', 5)
                         ->with('userRecord', $userRecord)
                         ->with('successmobileSetting', 'Updated Successfully!'); 
                }
                else
                {
                 return back()
                         ->with('generalSetting', 5)
                         ->with('userRecord', $userRecord)
                         ->with('updatemobileError', 'Enable Update!');    
                }
    
    
}


function blockUserSetting(Request $request)
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
    
    
}

function listForBlockUser($name)
{
    //echo $name."****\n";
   // echo 'neha';die;
    $usersId=Auth::user()->id;
     $i=0;
     $list=$this->blockedUser_List($usersId);
     $str=[0,0];
     foreach($list as $l)
     {
        $str[$i]=$l['uid'];
        $i++;
     }
     //$string=implode(",",$str);
     //echo $string;
     $listOfUser =  DB::table('users')
                    ->join('userprofiles','userprofiles.uid','=','users.id')
                    ->where('users.user_name' ,'like' ,"%$name%")
                    ->where('users.id' ,'!=' ,Auth::user()->id)
                    ->whereNotIn('users.id', $str)
                    ->select("users.id as id","userprofiles.img as image","userprofiles.fname as fname","userprofiles.lname as lname" )
                    ->get();
    
    
   // $listOfUser = User::all()->where('user_name', $name);
    return view('hana.UserListForBlock')->with('listOfUser',$listOfUser);
}

function blockUser($id)
{
    $usersId=Auth::user()->id;
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
        $temp->user_id = Auth::user()->id;
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
    $list=$this->blockedUser_List($usersId);
    $userPrivacySetting = userProfile_setting::all()->where('uid',Auth::user()->id);
    $userRecord = userProfile::all()->where('uid', Auth::user()->id);
    $AdController =  new AdsManagerController();
    $myAds        =  $AdController->getMyAds();
    //return \Illuminate\Support\Facades\Response::json(array('success' => true, 'blockuserArray' => $blocked_user_list));
    return view('hana.settings')
        ->with('userPrivacySetting', $userPrivacySetting)
        ->with('userRecord', $userRecord)
        ->with('myAds',$myAds)
        ->with('generalSetting', '4')
        ->with('blockedUserList', $list);
                          
        
    
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

function unblockUser($id)
{
  $usersId=Auth::user()->id;
   $temp =BlockUser::where('user_id',$usersId)
                    ->where('blocked_id',$id)
                    ->update([
                     'blockuser_status'=>'0',
                     'updated_at' =>Carbon::now()->toDateTimeString(),
                     ]); 
   
   return back();
  
}

}
