<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use App\CompanyProfile;
use App\userProfile;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
            return Redirect::to('my-network');
        else    
            $company_data = $this->getUserTypeData('cmppr');
            $recent_company_data = $this->getUserTypeData('cmppr',3);
            $users = $this->getUserTypeData('usrpr');
            $recent_users = $this->getUserTypeData('usrpr',3);
            return view('index',['company_data'=> $company_data,'user_data'=> $users,'recent_company_data'=> $recent_company_data, 'recent_users' => $recent_users]);
        
    }
    
    
    public function redirectIfAuthenticate(){
        
       
        
    }
    public function showMyNetwork(Request $request){
        
        /*$this->middleware('guest');*/
        
         if(!Auth::check()){
            return Redirect::to("/");
        }
        
        
        
        $post       = new PostController();
        
        $follow     = new FollowController(Auth::user()->id);
        
        $posts      = $post->getAllPost();
        
        $posts->withPath(url('loadmore'));
        
        $this->setSessionData($post,['next_page_url'=>$posts->nextPageUrl()]);
        
        $suggestedUsers     = $follow->getSuggestedUsers(4);
        
        $suggestedCompanies   = $follow->getSuggestedCompanies(4); 
        
        return view('my_network')
                ->with('posts',$posts)
                ->with('singlepostview',0)
                ->with('suggestedUsers',$suggestedUsers)
                ->with('suggestedCompanies',$suggestedCompanies)
                ;
    }
    
    
    public function setSessionData($post,$data){
        
        $emoticons  = $post->getEmoticons();
        
        $notController = new NotificationController();
        
        $notifications = $notController->getNewNotifications();
        
        session(['emoticons' => $emoticons,'notifications'=>$notifications,'next_page_url'=>$data['next_page_url']]);
        
    } 
    public function getUserTypeData($user_role,$limit=null){
        $limit_data = !empty($limit)?'->offset(0)->limit($limit)':'';
        if($user_role == 'cmppr'){
            if(!empty($limit)){
                $user_data = CompanyProfile::leftJoin('users', function($join) {
                    $join->on('companyprofiles.uid', '=', 'users.id');
                })
                ->where('login_role',$user_role)       
                ->where('users.status','2')
                ->offset(0)
                ->limit($limit)
                ->get(['companyprofiles.*','users.*']);
            }else{
                $user_data = CompanyProfile::leftJoin('users', function($join) {
                    $join->on('companyprofiles.uid', '=', 'users.id');
                })
                ->where('login_role',$user_role)       
                ->where('users.status','2')
                ->get(['companyprofiles.*','users.*']);
            }
        }else{
            if(!empty($limit)){
                $user_data = UserProfile::leftJoin('users', function($join) {
                    $join->on('userprofiles.uid', '=', 'users.id');
                })       
                ->where('login_role',$user_role)
                ->where('users.status','2')
                ->offset(0)
                ->limit($limit)
                ->get(['userprofiles.*','users.*']);
            }else{
                $user_data = UserProfile::leftJoin('users', function($join) {
                    $join->on('userprofiles.uid', '=', 'users.id');
                })       
                ->where('login_role',$user_role)
                ->where('users.status','2')
                ->get(['userprofiles.*','users.*']);
            }
        }
        return $user_data;
    }
}
