<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
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
use Illuminate\Validation\Rule;




class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userId;
    
    public function __construct($userId = null) {
        $this->userId = Input::get('user_id');
    }
    
    public function index($json=false)
    {
        
        
         $PostController = new PostController($this->userId);
         
         $trendingPosts =  $PostController->getAllPost();
         
         $company       =  CompanyProfile::where('uid','=',$this->userId)
                           ->first();
         
         if(empty($company->logo_img)){
             $profilePic = URL::to("images/user.png");
         }else{
             $profilePic = URL::to("userimages/user_".$this->userId."/medium/".$company->logo_img);
         }
         
         if(empty($company->background_img)){
             $coverPic = URL::to("images/user.png");
         }else{
             $coverPic = URL::to("userimages/user_".$this->userId."/profile_background/".$company->background_img);
         }
         
         
         
         return Response::json(
                        [   'success'=>'1',
                            'trendingPosts'=>$trendingPosts,
                            'company'   =>  $company,
                            'profilePic'=>  $profilePic,
                            'coverPic'  =>  $coverPic,
                            
                        ]
                 );
         
    }

    public function updateCompanyProfile(Request $request){
        
        $validateName=Validator::make(['company_name'=>$request->company_name], [
        
            'company_name' => [
            'required',
                Rule::exists('companyprofiles')->where(function ($query) {
                 $query->where('uid',$this->userId);
                }),
            ],
        ]);
        
        
        if($validateName->passes()){
            echo __FUNCTION__;
            $cvalidation = 'required|max:100';
        }else{
            $cvalidation = 'required|unique:companyprofiles|max:100';
        }
        
        
        
        $validator = Validator::make($request->all(), [
            'company_name'        => $cvalidation,
            'incorporation_date'  => 'required',
            'company_city'        => 'required',
            'company_state'       => 'required',
            'company_zip'         => 'required',
            'country'             => 'required',
            'contact_number'      => 'required',
            'contact_email'       => 'required',   
            'about_us'            => 'required',  
        ]);

        if ($validator->fails()) {
            
             return Response::json([
                'success' => '0',
                'error'   => $validator->errors(),       
        ]);
        }
        
        $profile  = \App\CompanyProfile::where('uid','=',$this->userId)->update(
                        
                            [
                                'company_name'          =>      $request->company_name,
                                'incorporation_date'    =>      $request->incorporation_date,
                                'company_city'          =>      $request->company_city,
                                'company_state'         =>      $request->company_state,
                                'company_zip'           =>      $request->company_zip,
                                'country'               =>      $request->country,
                                'contact_number'        =>      $request->contact_number,
                                'contact_email'         =>      $request->contact_email,
                                'about_us'              =>      $request->about_us,
                             ]
                        
                        );
        
        return Response::json([
                'success' => '1',
                'error'   => '0',       
        ]);
    }
    
     public function uploadProfilePic(Request $request) {
         
         
         $validator = Validator::make($request->all(), [
            
             'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            
        ]);

       if ($validator->fails()) {
           
           return Response::json(['success' => '0', 'error' => $validator->errors()]);
       }

        
            $profile = $request->profile;
       
            $DIR = 'userimages/user_' . $this->userId;
            
            $SMALL = $DIR . '/' . 'small/';
            
            $MEDIUM = $DIR . '/' . 'medium/';
            
            $ORG = $DIR . '/' . 'original/';

                if(!file_exists($DIR))
                    mkdir($DIR);

                if (!file_exists($SMALL))
                    mkdir($SMALL);

                if (!file_exists($MEDIUM))
                    mkdir($MEDIUM);

                if (!file_exists($ORG))
                    mkdir($ORG);
            

            /* new code added for remove replacement of iphone posts from other posts date:3/10/2016 */
            $extension = $profile->getClientOriginalExtension();

            $randomName = uniqid();

            $filename = time() . rand(1000, 9999) . $randomName.".".$extension;
            
            $profile->move($ORG, $filename);

            

            $imageController =  new ImageController($this->userId);
            
            $thumbMedium            =  $imageController->resizeImage(140, 140, $filename, $ORG.$filename, $MEDIUM."/".$filename);  
            
            $thumbSmall             =  $imageController->resizeImage(35,30, $filename, $ORG.$filename, $SMALL."/".$filename);  
            
            if($thumbMedium && $thumbSmall) {
                $update =   CompanyProfile::where('uid', $this->userId)
                    
                        ->update(
                              [
                                  'logo_img' => $filename,
                              ]
                        );
                return Response::json(array('success' => true, 'img' => URL($MEDIUM . $filename)), 200);
            }else{
                return Response::json(array('success' => false, 'message'=>'Error to upload image'), 200);
            }
            
            /*$helper = new HelperController();
            $helper->createImgThumb($ORG . $img, $img);
            $helper->createImgProfile($ORG . $img, $img);*/
            
            
            
        
    }
    
     public function uploadCoverPic(Request $request) {
         
         
         $validator = Validator::make($request->all(), [
            
             'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            
        ]);

       if ($validator->fails()) {
           
           return Response::json(['success' => '0', 'error' => $validator->errors()]);
       }

        
            $profile = $request->cover;
       
            $DIR = 'userimages/user_' . $this->userId;
            
            $cover = $DIR . '/' . 'profile_background/';
            
            
                if(!file_exists($DIR))
                    mkdir($DIR);

                if (!file_exists($cover))
                    mkdir($cover);

            $extension = $profile->getClientOriginalExtension();

            $randomName = uniqid();

            $filename = time() . rand(1000, 9999) . $randomName.".".$extension;
            
            $profile->move($cover, $filename);

            

            $imageController =  new ImageController($this->userId);
            $imageWithPath   =  $cover.$filename; 
            $coverOptimize   =  $imageController->optimizeImage($imageWithPath);
            
            
            if($coverOptimize) {
                
                $update =   CompanyProfile::where('uid', $this->userId)
                    
                        ->update(
                              [
                                  'background_img' =>$filename,
                              ]
                        );
                
                return Response::json(array('success' => true, 'img' => URL($cover . $filename)), 200);
            }else{
                return Response::json(array('success' => false, 'message'=>'Error to upload image'), 200);
            }
            
    }
    
    public function showCompany($name){
        
        
        $companyName    = str_replace("-"," ",$name);
        
        $this->userId   = CompanyProfile::where('company_name','=',$companyName)->value("uid");
        
        $data           = $this->index(true); 
        
        extract($data);
       
        
        return view('company_show')
         
                    
                    
                    ->with('company',$company)
                    
                    ->with('profilePic',$profilePic)
                    
                    ->with('coverPic',$coverPic)
                    
                 ;
        
    }
    
    
}
