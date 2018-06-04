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
use Illuminate\Support\Facades\Response;
use App\Service;
use App\Post;

class ServiceController extends Controller
{
   
    public $userId;
    
    public function __construct($userId=null) {
        if(is_null($userId)){
                
                $this->middleware(function ($request, $next) {
                
                if(Auth::check())    
                    $this->userId= auth()->user()->id;

                return $next($request);
            });
        }
    }
    
    public function index()
    {
        return view('services');
    }
    
    public function showAddService(){
        $services = Service::where("user_id",$this->userId)->where("is_deleted",0)->get();
        return view('services')->with("services",$services);
    }
    
    public function serviceDetail($serviceId)
    {
        
        $service = Service::join("companyprofiles","companyprofiles.uid","=","service.user_id")
                    ->where("service.id",$serviceId)
                    ->first();
        
        
        if(isset($service->logo_img) && strlen($service->logo_img) > 0){
            $profile = URL::to("userimages/user_".$service->uid."/medium/".$service->logo_img);
        }else{
            $profile = URL::to("images/user.png");
        }
        
        return view('service_detail')
                ->with("service",$service)
                ->with("profile",$profile)
                ;
    }
    
    public function createService(Request $request){
        
            $validator = Validator::make($request->all(), [

                 'image'                => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg|max:12000',
                 'service_title'        => 'required',
                 'service_description'  => 'required', 

            ]);
            
            if ($validator->fails()) {
                
                return  Redirect::to("service/showadd")
                  ->withErrors($validator,"update")
                ->withInput();
           
                return Response::json(['success' => '0', 'error' => $validator->errors()]);
            }

            $save  =   new Service;
       
            
            
            if(isset($request->image)){
                $image = $request->image;
       

                $extension = $image->getClientOriginalExtension();

                $randomName = uniqid();

                $filename = time() . rand(1000, 9999) . $randomName.".".$extension;
            
                $path               =  public_path('images/services');
            
                $image->move($path, $filename);
            
            
            
                $imageController    =  new ImageController($this->userId);
            
                $imageWithPath      =  $path."/".$filename; 
            
                $optimize      =  $imageController->optimizeImage($imageWithPath);
            
            }else{
                $filename="";
            }
            
            
            if(isset($request->service_id) && $request->service_id > 0 ){
           
                $update = [
                                "service_title"         =>  $request->service_title,
                                "service_description"   =>  $request->service_description,
                          ];
                
                if( strlen($filename) > 0){
                
                    $update = [
                                "service_title"         =>  $request->service_title,
                                "service_description"   =>  $request->service_description,
                                "image"                 =>   $filename
                          ];
                
                }
                
               $update = Service::where('id',$request->service_id)
                            ->update($update);
               
               if($update)
                    return Redirect::to("service/showadd")->with("success","Service updated successfully!!");
               else
                    return Redirect::to("service/showadd")->with("error","Error to update service!!");
            }
            
            $save->image                =   $filename;
            $save->service_title        =   $request->service_title;
            $save->service_description  =   $request->service_description;
            $save->user_id              =   $this->userId;
            $save->save();
            
           if($this->createServicePost($request, $save->id)){
               return Redirect::back()->with("success","Service Added successfully!!");
           }   
         
    }
    
    public function createServicePost($request,$serviceId){
        
        $post                   =   new Post;

        $post->post_owner       =   $this->userId;

        $post->user_id          =   $this->userId;

        $post->post_content     =   "Started a new service";

        $post->publish_status   =   2;

        $post->post_type        =   3;
        
        $post->service_id       =   $serviceId;
        
        $post->save();
        
        return $post->id;
    }
    
    function editService($id){
        $services = Service::where("id",$id)->first();
        $all      = Service::where("user_id",$this->userId)->where("is_deleted",0)->get(); 
        return view('services')
                ->with("oldService",$services)
                ->with("services",$all)
                ->with("fetchToUpdate",true)
                ;
    }
    
    function deleteService($id){
        
        $update = Service::where("id",$id)->update(["is_deleted"=>1]);
        
        $delete = Post::where('service_id',$id)
                ->update([
                 'is_deleted' => 1
                ]);
        if($update && $delete){
            return Response::json(["success"=>true]);
        }else{
            return Response::json(["success"=>false,"message"=>"Error to delete service!!"]);
        }
    }

    
}