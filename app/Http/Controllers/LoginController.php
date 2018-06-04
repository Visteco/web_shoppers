<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        public function doLogin(Request $request){
         
            $validator = Validator::make($request->all(), [
                  'email'           =>      'required|email',
                  'password'        =>      'required|min:6',
             ]);

            if ($validator->fails()) {

                return Redirect::back()
                        
                        ->withErrors($validator)
                        
                        ->withInput();
                        
                        ;
                
            }
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                
                 if(Auth::user()->login_role==USER_PROFILE){
                   $profilePic = \App\Userprofile::where("uid",'=',Auth::user()->id)->value("img"); 
                }else{
                   $profilePic = \App\CompanyProfile::where("uid",'=',Auth::user()->id)->value("logo_img"); 
                }
                
                session(['profilepic' =>$profilePic]);
                
                return  Redirect::to('my-network');
                
            }else{
                
                $validator->errors()->add('autherror', 'Email or password is incorrect!');
                
                return  redirect('/')
                          ->withErrors($validator,'login')
                          ->withInput();
            }
            
        }
    
    
        public function index()
        {
        //
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function doLogout()
    {
        if(Auth::check())
            Auth::logout();
        
        return Redirect::to('/'); 
            
    }
    
    
}
