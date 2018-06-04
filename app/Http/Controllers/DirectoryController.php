<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\URL;

class DirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('directory');
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
    public function destroy($id)
    {
        //
    }
    
    public function search(Request $request){
        
        /*print_r($request->all());*/
        
        
        $location  = $request->location;
        $explode   = explode(",",$location);
        
        $lat       = trim($explode[0],"(");
        
        $lng       = trim($explode[1],")");
        
        $allCompany = \App\CompanyProfile::select("latlong","uid")->get();
        
        $ids  =  [];
        $startLocation = "$lat,$lng";
        foreach($allCompany as $company){
            
            $distance = $this->milesNeedsToTravel($startLocation, $company->latlong);
            
            if($distance <= 10){
                $ids[] = $company->uid;
            }
            
        }
        
        
        $searchedResults  = \App\CompanyProfile::whereIn("uid",$ids)->get();
        $finalResult =[];
        foreach($searchedResults as $res){
            
            list($lat,$lng) = explode(",",$res->latlong);
            
            $finalResult[]=[
              'geometry_location'   =>  array(
                                            "lat" => floatval($lat),
                                            "lng" => floatval($lng)
                                        ),
               "name"               =>  $res->company_name,
               "icon"               =>  URL::to("userimages/user_".$res->uid."/medium/".$res->logo_img),
               "opening_hour"       =>  "null",
               "photos"             =>  "null",
               "place_id"           =>  "null",
               "rating"             =>  "null",
               "reference"          =>  "null",
               "scope"              =>  "GOOGLE",
               "types"              =>  [$res->company_type],
               "vicinity"           =>  "null",
               "html_attributions"  =>  [] 
            ]; 
        }
        
        /*$result = [
            
                [
                    "geometry_location"  => array('lat' => 52.3711114, 'lng' => 4.895433300000036),
                    "name"               => "Webcoir It solution PVT LTD"
                ],
                
                [   
                    "geometry_location"  => array('lat' => 52.3711114, 'lng' => 4.895433300000036),
                    "name"               => "Nano smart technologies",
                
                ],
                
                [
                    "geometry_location"  => array('lat' => 52.37208799999999, 'lng' =>4.894867999999974),
                    "name"               => "ericos Pvt Ltd"   
                    
                ],
            
            
        ];*/
        
        //echo "<pre>";  
        //print_r($finalResult);
        //echo "</pre>";
        
        return Response::json(["result"=>$finalResult]);
    }
    
    public function milesNeedsToTravel($startLocation,$endLocation, $earthRadius = 3959) {
        // convert from degrees to radians
        
        
       $stEx = explode(",", $startLocation); 
       
       $endEx = explode(",", $endLocation);
       
       
       $latitudeFrom   = $stEx[0];
       $longitudeFrom  = $stEx[1];  
        
       $latitudeTo     = $endEx[0];
       $longitudeTo    = $endEx[1];
                
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        //return 2.85;
        return $angle * $earthRadius;
    }
}