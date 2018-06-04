<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\CompanyProfile;
use Intervention\Image\Facades\Image;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userId;
    
    public function __construct($userId = null) {
        
        if(is_null($userId)){
                
                $this->middleware(function ($request, $next) {
                
                $this->userId= auth()->user()->id;

                return $next($request);
            });
        }
    }
    
    public function resizeImage($height,$width,$image,$imageWithPath,$savingPath){
        
        $img = Image::make($imageWithPath);
        
        
        /*$img->resize($width,$height);*/
        
        
        $img->resize($width, null, function ($constraint) {
             $constraint->aspectRatio();
        });
        
        
        
        $img->save($savingPath);
        
        return true;
        
    }
    
    public function optimizeImage($imageWithPath){
        
        $img = Image::make($imageWithPath);
        
        $img->resize(null, 400, function ($constraint) {
             $constraint->aspectRatio();
             $constraint->upsize();
         });
        
        $img->save($imageWithPath);
        
        return true;
    }
    
}
