<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\CompanyProfile;
use Intervention\Image\Facades\Image;



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
        $make_image = URL('/').'/'.$imageWithPath;
        $img = Image::make($make_image);
        
        $img->resize(null, 400, function ($constraint) {
             $constraint->aspectRatio();
             $constraint->upsize();
         });
        
        $img->save($imageWithPath);
        
        return true;
    }
    
}
