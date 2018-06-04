<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Notification;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

define('SHOW_POST','showpost/');
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    
    public $noticeText=[];
    
    private $post;
    
    public $userId;
    public function __construct($userId) {
        
        $this->userId = $userId;
        
        $this->noticeText[1] = " post a feed on your network"; 
        $this->noticeText[2] = " share your post on his timeline"; 
        $this->noticeText[3] = " like your post"; 
        $this->noticeText[4] = " like your comment"; 
        $this->noticeText[5] = " like your reply"; 
        $this->noticeText[6] = " replyed on your comment"; 
        $this->noticeText[7] = " commented on your post "; 
        $this->noticeText[8] = " started following you"; 
        $this->noticeText[9] = " sent you a message"; 
        $this->noticeText[10] = " started following you"; 
        
    }
    public function index()
    {
        
        $notifications = Notification::leftJoin('userprofiles', 'userprofiles.uid', '=', 'notifications.user_id')
                        ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'notifications.user_id')
                        ->join('users', 'users.id', '=', 'notifications.user_id')
                        ->where('notifications.check_user', '=', $this->userId)
                        ->select(
                            DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                            'userprofiles.pres_org as working_org', 'userprofiles.pres_desg as user_desig', 
                            'companyprofiles.company_name as company_name', 
                            'companyprofiles.company_type as company_type', 
                            'companyprofiles.country as company_country', 
                            'users.login_role  as role', 
                            'notifications.*'
                         )
                
                ->orderBy('notifications.updated_at', 'desc')
                
                ->paginate(10);
                $this->post        =    new PostController();
                foreach($notifications as $notification){
                    $notification->text = $this->noticeText[$notification->notice_type]; 
                    $notification->time = $this->post->formatDate($notification->updated_at); 
                    $notification->action = URL::to(SHOW_POST.$notification->object_id);
                    
                }
        
        return view('notifications')->with("notifications",$notifications);
    }
    
    public function getNewNotifications(){
        
        $notifications = Notification::leftJoin('userprofiles', 'userprofiles.uid', '=', 'notifications.user_id')
                        ->leftJoin('companyprofiles', 'companyprofiles.uid', '=', 'notifications.user_id')
                        ->join('users', 'users.id', '=', 'notifications.user_id')
                        ->where('notifications.check_user', '=', $this->userId)
                        ->where('notifications.seen_status', '=', NOTICE_UNSEEN)
                        //->groupBy('notifications.user_id')
                        ->select(
                            DB::raw("CONCAT(userprofiles.fname ,' ',userprofiles.lname ) as user_name"), 
                            'userprofiles.pres_org as working_org', 'userprofiles.pres_desg as user_desig', 
                            'companyprofiles.company_name as company_name', 
                            'companyprofiles.company_type as company_type', 
                            'companyprofiles.country as company_country', 
                           // DB::raw('count(notifications.user_id) as notice_count'),    
                            'users.login_role  as role', 
                            'notifications.notice_type','notifications.object_id','notifications.notification_id'
                         )
                
                ->orderBy('notifications.updated_at', 'desc')
               // ->toSql();
                ->paginate(5);
        
        //dd($notifications);
        $this->post        =    new PostController();
        foreach($notifications as $notification){
             $notification->text = $this->noticeText[$notification->notice_type]; 
             $notification->time = $this->post->formatDate($notification->updated_at); 
             $notification->action = URL::to(SHOW_POST.$notification->object_id."?nid=".$notification->notification_id);
        }
        
        return $notifications;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($object,$checkUser,$noticeType)
    {
        $notice                 =   new Notification; 
        $notice->object_id      =   $object;
        $notice->check_user     =   $checkUser;
        $notice->notice_type    =   $noticeType;
        $notice->user_id        =   $this->userId;
        $notice->save();
        
        return $notice->id;
    }
    
    
    public function setSeen($notificationId){
        
        $update = Notification::where('notification_id','=',$notificationId)
                    ->update([
                            'seen_status' => NOTICE_SEEN
                  ]);
        
        return $update;
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
}
