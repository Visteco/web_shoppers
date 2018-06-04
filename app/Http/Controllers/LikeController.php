<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Userlike;
use Session;
use Response;
use Validator;
use Auth;
use DB;
class LikeController extends Controller {

	public function doLikePost($like_object) {


		
		$alreadyLike = UserLike::where('like_object','=',$like_object)
		->where('user_id',"=",Auth::user()->id)
		->where('object_type',"=","POST")
		->count();

		if($alreadyLike > 0 ){

			UserLike::where('like_object','=',$like_object)
			->where('object_type',"=","POST")
			->where('user_id',"=",Auth::user()->id)->delete();


			$count =UserLike::where('like_object','=',$like_object)
			->where('object_type',"=","POST")
			->count();

			return Response::json(array('success' => true,'like_count'=>$count), 200);
		}


		$like = new Userlike;
		$like->user_id 		= 	Auth::user()->id;
		$like->like_object 	= 	$like_object;
		$like->object_type	=	"POST";
		$like->save();
		$count = UserLike::where('like_object','=',$like_object)
		->where('object_type',"=","POST")
		->count();

		/* code for set notice*/

			$infoArr=array();

			$sharedPostName  = DB::table('posts')->where('id','=',$like_object)->value('postname');
			$sharedUser = DB::table('userprofiles')->where('uid','=',Auth::user()->id)->value('fname');

			if(empty($sharedUser))

			$sharedUser = DB::table('companyprofiles')->where('uid','=',Auth::user()->id)->value('company_name');

			$infoArr['notice_text']    =  $sharedUser." like your post :".html_entity_decode($sharedPostName, ENT_QUOTES, "ISO-8859-1");

			$infoArr['user_id']        =  DB::table('posts')->where('id','=',$like_object)->value('user_id');/*we needs comments owner to spacify user who will see this notification*/

			$infoArr['notice_type']    = 'like';

			$infoArr['notice_action']  = "getsngpost/".$like_object;

      if(Auth::user()->id!=$infoArr['user_id'])
			$this->setNotification($infoArr);

			/* end code */

		return Response::json(array('success' => true,'like_count'=>$count), 200);
	}




		public function doLikeComment($like_object) {


		if (!Auth::check())
		{
			return Redirect::to('/')->with('flash_error', 'Session timeout please login to continue !!');
		}

		$alreadyLike = UserLike::where('like_object','=',$like_object)
		->where('user_id',"=",Auth::user()->id)
		->where('object_type',"=","COMMENT")
		->count();

		if($alreadyLike > 0 ){
			UserLike::where('like_object','=',$like_object)
			->where('user_id',"=",Auth::user()->id)
			->where('object_type',"=","COMMENT")
			->delete();

			$count = UserLike::where('like_object','=',$like_object)
			->where('object_type',"=","COMMENT")
			->count();
			return Response::json(array('success' => true,'like_count'=>$count), 200);
		}


		$like = new Userlike;
		$like->user_id 		= 	Auth::user()->id;
		$like->like_object 	= 	$like_object;
		$like->object_type	=	"COMMENT";
		$like->save();
		$count = UserLike::where('like_object','=',$like_object)
		->where('object_type',"=","COMMENT")
		->count();

                /* code for set notice*/

		$infoArr=array();

    $cmntName = DB::table('comments')->where('id','=',$like_object)->value('cmnt_name');

		$sharedUser = DB::table('userprofiles')->where('uid','=',Auth::user()->id)->value('fname');

		$postId     = DB::table('comments')->where('id','=',$like_object)->value('post_id');

		if(empty($sharedUser))

		$sharedUser = DB::table('companyprofiles')->where('uid','=',Auth::user()->id)->value('company_name');

		$infoArr['notice_text']    =  $sharedUser." like your comment: ".html_entity_decode($cmntName, ENT_QUOTES, "ISO-8859-1");

		$infoArr['user_id']        =  DB::table('comments')->where('id','=',$like_object)->value('user_id');/*we needs comments owner to spacify user who will see this notification*/

		$infoArr['notice_type']    = 'like';

		$infoArr['notice_action']  = "getsngpost/".$postId;

    if(Auth::user()->id!=$infoArr['user_id'])
		$this->setNotification($infoArr);

		/* end code */

		return Response::json(array('success' => true,'like_count'=>$count), 200);
	}



		public function doLikeReply($like_object) {


		if (!Auth::check())
		{
			return Redirect::to('/')->with('flash_error', 'Session timeout please login to continue !!');
		}

		$alreadyLike = UserLike::where('like_object','=',$like_object)
		->where('user_id',"=",Auth::user()->id)
		->where('object_type',"=","REPLY")
		->count();

		if($alreadyLike > 0 ){
			UserLike::where('like_object','=',$like_object)


				->where('object_type',"=","REPLY")
				->where('user_id',"=",Auth::user()->id)->delete();


			$count = UserLike::where('like_object','=',$like_object)
			->where('object_type',"=","REPLY")
			->count();

			return Response::json(array('success' => true,'like_count'=>$count), 200);
		}


		$like = new Userlike;
		$like->user_id 		= 	Auth::user()->id;
		$like->like_object 	= 	$like_object;
		$like->object_type	=	"REPLY";
		$like->save();
		$count = UserLike::where('like_object','=',$like_object)
		->where('object_type',"=","REPLY")
		->count();

                /* code for set notice*/

		$infoArr=array();

    $cmntReplyName = DB::table('creplies')->where('id','=',$like_object)->value('cmnt_text');

		$sharedUser = DB::table('userprofiles')->where('uid','=',Auth::user()->id)->value('fname');

		$postId     = DB::table('creplies')->where('id','=',$like_object)->value('post_id');

		if(empty($sharedUser))

		$sharedUser = DB::table('companyprofiles')->where('uid','=',Auth::user()->id)->value('company_name');

		$infoArr['notice_text']    =  $sharedUser." like your reply: ".html_entity_decode($cmntReplyName, ENT_QUOTES, "ISO-8859-1");

		$infoArr['user_id']        =  DB::table('creplies')->where('id','=',$like_object)->value('user_id');/*we needs comments owner to spacify user who will see this notification*/

		$infoArr['notice_type']    = 'like';

		$infoArr['notice_action']  = "getsngpost/".$postId;

    if(Auth::user()->id!=$infoArr['user_id'])
		$this->setNotification($infoArr);

		/* end code */


		return Response::json(array('success' => true,'like_count'=>$count), 200);
	}

	public function destroys($id)
    {
		if (!Auth::check())
		{
			return Redirect::to('/')->with('flash_error', 'Session timeout please login to continue !!');
		}

		Like::find($id)->delete();
       // $post->delete();
		//dd(Session::get('user')[0][0]);
		return Response::json(array('success' => true));

    }


    /** code to set notifications*/

    public function setNotification($infoArr){

		$id = DB::table('notifications')->insertGetId(
		         ['check_user'=>$infoArr['user_id'],
							'notice_text'=>$infoArr['notice_text'],
							'seen_status'=>1,
							'user_id'=>Auth::user()->id,
							'notice_type'=>$infoArr['notice_type'],
							'notice_action'=>$infoArr['notice_action'],
                                                        'updated_at'=>date('Y-m-d H:i:s')
						]
     );

		 DB::table('notifications')
            ->where('id', $id)
            ->update( [ 'notice_action' =>$infoArr['notice_action']."/".$id ]);

   }

   /*ends*/







}
