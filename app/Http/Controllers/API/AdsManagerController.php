<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\adboard_information;
use Validator;
use Redirect;
use Image;
use Auth;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class AdsManagerController extends Controller
{
    public $userId;
    
    public function __construct()
    {
      $this->userId = Input::get("user_id");
    }
    

    public function store(Request $request)
    {
       
       /*$validator = Validator::make($request->all(), [
                              'image' => 'required',
        ]);
        
        if ($validator->fails()) 
        {
            return Response::json(['success' => '0', 'error' => $validator->errors()]);
        }*/
        $usr_id = $this->userId;
        $image = trim($request->image);
        $extension = '.jpg';
        $credit = 5;
        $temp = new adboard_information();
        $temp->title = $request->title;
        $temp->description = $request->description;
        $temp->url = $request->url;
        $temp->time = $displayTime = $request->time;
        $temp->user_id = $usr_id;
        
       if ($displayTime != '' && $displayTime != 0) 
        {
            $dayPerCredit = 2;
            $temporary = $displayTime / $dayPerCredit;
            $newCredit = $credit - $temporary;
            if ($newCredit >= 0) 
            {
                $credit = $credit - $newCredit;
                if ($image != '') 
                {
                    $filename = time() . rand(1000, 9999).$extension;
                    $DIR='images/adboard/';
                    $file = fopen( $DIR.$filename, "w+");
                    if ($file) 
                    {
                        $put = file_put_contents($DIR.$filename, base64_decode(trim($image)));
                        $temp->image = $filename; 
                    }
                }
                $temp->save();
                if($temp)
                {
                    return Response::json(['success' => '1', 'error' => '0']);
                }
                else
                {
                    return Response::json(['success' => '0','error'=>'Advertisement not added!']);
                }
            } 
            else 
            {
              return Response::json(['success' => '0','error'=>'You do not have sufficient credit points!']);
            }
        }
    }

    
    public function getMyAds()
    {
        $ads = adboard_information::where('user_id','=',$this->userId)
                ->get();
        if($ads)       
            return Response::json(['success' => '1', 'addlist' => $ads, 'image_url'=> 'http://latest.visteco.com/public/images/adboard/']);
        else
            return Response::json(['success' => '0','error'=>'No Advertisement Available!']);  
    }

    
    public function updateSave(Request $request)
    {
        $update=0;
        $this->addid = Input::get("addid");
        $id=$this->addid;
        $extension = '.jpg';
        $credit = 10;
        $displayTime = $request->time;
        if ($displayTime != '' && $displayTime != 0) 
        {
            $dayPerCredit = 2;
            $temporary = $displayTime / $dayPerCredit;
            $newCredit = $credit - $temporary;
            if ($newCredit >= 0) 
            {
                $credit = $credit - $newCredit;
                $record = adboard_information::where('Advertisement_id', $id)
                                        ->first();
                $image=$record->image;
                //echo $image;die;
                if($request->image)
                    $image = $request->image;
                if ($request->image != '') 
                {
                    $filename = time() . rand(1000, 9999).$extension;
                    $DIR='images/adboard/';
                    $file = fopen( $DIR.$filename, "w+");
                    if ($file) 
                    {
                        $put = file_put_contents($DIR.$filename, base64_decode(trim($image)));
                        //$temp->image = $filename; 
                    }
                }
                else
                {
                  
                 $filename= $image;
                }
                if($request->url !='' && $request->image!='')
                {
                    if($image!='' or $image!=NULL)
                    {
                        if($request->description)
                            $desc=$request->description;
                        else
                            $desc="";
                        $update =adboard_information::where('Advertisement_id', '=', $id)->update([
                                                    'title' => $request->title,
                                                    'url' => '',
                                                    'time' => $request->time,
                                                    'image' =>$filename,
                                                    'description' => $desc,
                                                    ]); 
                    }
                }
                else
                { 
                    if($request->url !='')
                    {
                        $update =adboard_information::where('Advertisement_id', '=', $id)->update([
                                                    'title' => $request->title,
                                                    'url' => $request->url,
                                                    'time' => $request->time,
                                                    'image' =>NULL,
                                                    'description' => NULL,
                                                    ]); 
                    }
                    else
                    {
                       
                        if($image !='')
                        {
                             $update =adboard_information::where('Advertisement_id', '=', $id)->update([
                                                'title' => $request->title,
                                                'url' => NULL,
                                                'time' => $request->time,
                                                'image' =>$filename,
                                                'description' => $request->description,
                                                ]);
                           
                        }
                    }
                }
                
                if($update)
                     return Response::json(['success' => '1', 'error' => '0']);
                else
                   return Response::json(['success' => '0','error'=>'Error to Update Advertisement detail!']); 
                    
            }
        }
        else 
        {
            return Response::json(['success' => '0','error'=>'You do not have sufficient credit points!']);
        }
    
    }
      

    public function update()
    {
        $this->addid = Input::get("addid");
        $id=$this->addid;
        $updateAd = adboard_information::where('Advertisement_id', $id)
                ->get();
        if($updateAd)       
            return Response::json(['success' => '1', 'adsdetail' => $updateAd,'image_url'=> 'http://latest.visteco.com/public/images/adboard/']);
        else
            return Response::json(['success' => '0','error'=>'Error to show Advertisement detail!']); 
    }
    
        
    public function destroyMyAds()
    {
        $this->addid = Input::get("addid");
        $id=$this->addid;
        $deleteAds = adboard_information::where('Advertisement_id','=',$id)
                                    ->delete();
        if($deleteAds)       
            return Response::json(['success' => '1', 'error' => '0']);
        else
            return Response::json(['success' => '0','error'=>'Error to delete this Advertisement!']);  
    }
}
