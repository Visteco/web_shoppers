<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adboard_information;
use Validator;
use Redirect;
use Image;
use Auth;

class AdsManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public $userId;
    
    public function __construct(){
        
      
      //$this->userId = Auth::user()->id;
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
        $credit = 5;
        $temp = new adboard_information();
        $temp->title = $request->get('title');
        $temp->description = $request->get('description');
        $temp->url = $request->get('url');
        $temp->time = $displayTime = $request->get('time');
        $temp->user_id = Auth::user()->id;
        $image = $request->file('image');
       if ($displayTime != '' && $displayTime != 0) {

            $dayPerCredit = 2;
            $temporary = $displayTime / $dayPerCredit;
            $newCredit = $credit - $temporary;
            if ($newCredit >= 0) {
                $credit = $credit - $newCredit;

                if ($image != '') {
                    $filename = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/adboard/');
                    $image->move($location, $filename);
                    $temp->image = $filename;
                }
                $temp->save();
               return redirect()->back()
                                ->with('status', 'Successfully Addeed!')
                                ->with('advertisementAdd', '1')
                                ->with('myAds', $this->getMyAds())
                       ;
               // return view('adBoardsuccessful');
            } else {
              //  $displayCreditBalance="* Credit : ".$credit."  \n   * Required Credit : ".$temporary;
              //  return view('unsufficientCreadit')->with('displayCB',$displayCreditBalance);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    public function getMyAds(){
       $ads = adboard_information::where('user_id','=',Auth::user()->id)
               ->paginate(10);
       return $ads;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSave(Request $request,$id)
    {
        $credit = 10;
        $displayTime = $request->get('time');
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
                if($request->file('image'))
                    $image = $request->file('image');
                if ($request->file('image') != '') 
                {
                    $filename = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/adboard/');
                    $image->move($location, $filename);
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
            }
        }
    return back();
    }
      

    
    
        public function update($id)
        {
        $updateAd = adboard_information::all()->where('Advertisement_id', $id);
        return view('hana.updateAdsForm')->with('updateAd',$updateAd);
        }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMyAds($id)
    {
        //die("neha");
              $deleteAds = adboard_information::where('Advertisement_id','=',$id)
              ->delete();
         return response()->json([
        'status' => 'Record has been deleted successfully!'
    ]);
       
    }
}
