<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use Auth;

use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;







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
            return view('index');
        
    }
    
    public function showMyNetwork(Request $request){
        $post       = new PostController($request->user_id);
        $posts      = $post->getAllPost();
        $posts->withPath(url('loadmore'));
        /*$this->setSessionData($post,['next_page_url'=>$posts->nextPageUrl()]);*/
        return Response::json(['success'=>RESPONSE_TRUE,'error'=>0,'posts'=>$posts]);
    }
    
    public function showMyNetworkPost(Request $request){
        $post       = new PostController($request->user_id);
        $posts      = $post->getAllPost();
        /*$this->setSessionData($post,['next_page_url'=>$posts->nextPageUrl()]);*/
        return Response::json(['success'=>RESPONSE_TRUE,'error'=>0,'posts'=>$posts]);
    }
    
    public function setSessionData($post,$data){
        
        
        
        $emoticons  = $post->getEmoticons();
        
        $notController = new NotificationController();
        
        $notifications = $notController->getNewNotifications();
        
        session(['emoticons' => $emoticons,'notifications'=>$notifications,'next_page_url'=>$data['next_page_url']]);
        
    } 
    
    
}
