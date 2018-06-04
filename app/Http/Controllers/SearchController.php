<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Response;

use \App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function __cnstruct()
    {
         $this->middleware('guest');
    }
    
    
    public function index(Request $request){
        
        $query      =  $request->get("q");
        
        $searchedUser = $this->getSearchedData($query);
        
        return view("search.search")->with('data',$searchedUser); 
    }
    public function getSearchedUser($name)
    {
        
        
        $users = User::crossJoin('userfollowings')
                 
                  ->where('users.user_name','like',"%$name%")
                  
                  ->orWhere(function ($query) {
                          $query->where('users.id','=','userfollowings.user_id')
                                ->where('users.id','=','userfollowings.following_id');
                    })
                    
                   ->where(function ($query) {
                          $query->orWhere('userfollowings.user_id','=',Auth::user()->id)
                                ->orWhere('userfollowings.following_id','=',Auth::user()->id);
                    })
                  ->distinct() 
                            
                  ->select('users.user_name as user_name','users.id as user_id')
                            
                 ->get();
        
        return Response::json(['users'=>$users]);
    }
    
    public function getSearchedData($query) {

        if (!Auth::check()) {
            $userId = 0;
        } else {
            $userId = Auth::user()->id;
        }


        $wildQuery = "%" . $query . "%";

        /*$blockedId = DB::table('blockedusers')->where('user_id', '=', $userId)->pluck('blocked_id');

        $whoBlockedMe = DB::table('blockedusers')->where('blocked_id', '=', $userId)->pluck('user_id');

        $allBlockedUnblockedUser = [];

        $allBlockedUnblockedUser = array_merge($blockedId, $whoBlockedMe);*/

        $users = User::leftJoin('companyprofiles', 'users.id', '=', 'companyprofiles.uid')
                ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.uid')
                /*->where('users.verified_status', '=', '2')*/
                /*->whereNotIn('users.id', $allBlockedUnblockedUser)*/
                ->where(function ($query) use ($wildQuery) {

                    $query->whereRaw("userprofiles.fname like '$wildQuery'")
                    ->orwhereRaw("userprofiles.pres_desg like '$wildQuery'")
                    ->orwhereRaw("userprofiles.country like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_name like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_location like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.services like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_type like '$wildQuery'")
                    ->orwhereRaw("userprofiles.lname like '$wildQuery'")
                    ->orwhereRaw("userprofiles.email like '$wildQuery'")        
                    ->orwhereRaw("CONCAT(userprofiles.fname,' ',userprofiles.lname) like '$wildQuery'");
                })
                ->select(
                        
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.pres_desg,companyprofiles.company_type) as user_designation"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.background_img,companyprofiles.background_img) as background_img"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.img,companyprofiles.logo_img) as user_profile"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,CONCAT(userprofiles.fname,' ',userprofiles.lname),companyprofiles.company_name) as fname"), 
                        DB::raw("IF( LENGTH(userprofiles.uid) > 0,userprofiles.uid,companyprofiles.uid) as user_id,userprofiles.country,companyprofiles.country"),
                        
                        "users.login_role",
                        "userprofiles.pres_desg"
                        
                )
                ->paginate(12)
        //->toSql()
        ;
             $users->setPath('searcresult/'.$query);   
        /* dd($users); */

         $all = [];
         
        foreach ($users as $user) {

            $user->alreadyFollow = DB::table('userfollowings')
                    ->where('following_id', "=", $user->user_id)
                    ->where('user_id', "=", $userId)
                    ->where('following_status', '=', 1)
                    ->where(function ($query) {

                        $query->where('object_type', '=', 'user')
                              ->orWhere('object_type', '=', 'business');
                    })
                    ->count();
            $user->profilepic = url("userimages/user_".$user->user_id."/medium/".$user->user_profile);        
            switch($user->login_role){
                case "usrpr":
                   $user->user_link       =  URL::to('user/profile/'.$user->user_id); 
                   $user->follow_link     =  URL::to("followuser/".$user->user_id); 
                   $all["users"][]= $user;
                    break;                    
                
                case "cmppr":
                    $user->user_link       =  URL::to('showcompany/'.$user->user_id); 
                     $user->follow_link    =  URL::to("followcompany/".$user->user_id);
                    $all["companies"][]= $user;
                    break;
            }        
           
        }

        return $all;
    }
    
    public function getSearchedSuggestions($query){
        
        if (!Auth::check()) {
            $userId = 0;
        } else {
            $userId = Auth::user()->id;
        }


        $wildQuery = "%" . $query . "%";

        /*$blockedId = DB::table('blockedusers')->where('user_id', '=', $userId)->pluck('blocked_id');

        $whoBlockedMe = DB::table('blockedusers')->where('blocked_id', '=', $userId)->pluck('user_id');

        $allBlockedUnblockedUser = [];

        $allBlockedUnblockedUser = array_merge($blockedId, $whoBlockedMe);*/

        $users = User::leftJoin('companyprofiles', 'users.id', '=', 'companyprofiles.uid')
                ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.uid')
                /*->where('users.verified_status', '=', '2')*/
                /*->whereNotIn('users.id', $allBlockedUnblockedUser)*/
                ->where(function ($query) use ($wildQuery) {

                    $query->whereRaw("userprofiles.fname like '$wildQuery'")
                    ->orwhereRaw("userprofiles.pres_desg like '$wildQuery'")
                    ->orwhereRaw("userprofiles.country like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_name like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_location like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.services like '$wildQuery'")
                    ->orwhereRaw("companyprofiles.company_type like '$wildQuery'")
                    ->orwhereRaw("userprofiles.lname like '$wildQuery'")
                    ->orwhereRaw("userprofiles.email like '$wildQuery'")        
                    ->orwhereRaw("CONCAT(userprofiles.fname,' ',userprofiles.lname) like '$wildQuery'");
                })
                ->select(
                        
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.pres_desg,companyprofiles.company_type) as user_designation"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.background_img,companyprofiles.background_img) as background_img"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,userprofiles.img,companyprofiles.logo_img) as user_profile"), 
                        DB::raw("IF( LENGTH(userprofiles.fname) > 0,CONCAT(userprofiles.fname,' ',userprofiles.lname),companyprofiles.company_name) as fname"), 
                        DB::raw("IF( LENGTH(userprofiles.uid) > 0,userprofiles.uid,companyprofiles.uid) as user_id,userprofiles.country,companyprofiles.country"),
                        
                        "users.login_role",
                        "userprofiles.pres_desg"
                        
                )
                ->paginate(5)
        //->toSql()
        ;
             $users->setPath('searcresult/'.$query);   
        /* dd($users); */

         $all = [];
         
        foreach ($users as $user) {

            $user->alreadyFollow = DB::table('userfollowings')
                    ->where('following_id', "=", $user->user_id)
                    ->where('user_id', "=", $userId)
                    ->where('following_status', '=', 1)
                    ->where(function ($query) {

                        $query->where('object_type', '=', 'user')
                              ->orWhere('object_type', '=', 'business');
                    })
                    ->count();
            
                    if(isset($user->user_profile) && count($user->user_profile) > 0)
                        $user->profilepic = url("userimages/user_".$user->user_id."/medium/".$user->user_profile);        
                    else
                        $user->profilepic = url("images/user.png");
                        
                    
            
            switch($user->login_role){
                case "usrpr":
                    $user->follow_link = URL::to("followuser/".$user->user_id);
                    $user->user_link       =  URL::to('user/profile/'.$user->user_id); 
                    break;
                case "cmppr":
                    $user->follow_link = URL::to("followcompany/".$user->user_id);
                    $user->user_link       =  URL::to('showcompany/'.$user->user_id); 
                    break;
            }
           
        }
        
        $searchAll = URL::to("search/all?q=".$query);
        
        $view = View::make('search.suggestion', ['users' => $users,'all_link'=>$searchAll]);

        $view = $view->render();

        return Response::json(['success'=>true,'users'=>$view]);
         
    }
    
    public function companySearchSuggestion($query){
        
        if(empty($query))
            return; 
        
        $users  = \App\CompanyProfile::where("company_name","like","%$query%")
                    ->take(10)
                    ->get();
        
        
        $view = View::make('search.suggestcompany', ['users' => $users]);

        $view = $view->render();

        return Response::json(['success'=>true,'users'=>$view]);
        
    }
    
}