<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\CompanyProfile;
use App\Jobpost;
use Response;
use App\Service;
use Illuminate\Validation\Rule;
use Auth;

define("STAFF_APPROVED",1);


class CompanyController extends Controller
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
                
                if(Auth::check())    
                    $this->userId= auth()->user()->id;

                return $next($request);
            });
        }
    }
    
    public function index($view=false)
    {
     
        if(!$view){
            if(!Auth::check()){
            return Redirect::to("/");
            }
        }
         
        
         $PostController = new PostController($this->userId);
         
         $trendingPosts =  $PostController->getAllPost(true);
         
         $bookMarks     =   $PostController->getBookMarkPosts();
         
         $company       = CompanyProfile::where('uid','=',$this->userId)
                          ->first();
         
         $countries       = [
                            "AD"=> "Andorra",
                            "AE"=> "United Arab Emirates",
                            "AF"=> "Afghanistan",
                            "AG"=> "Antigua and Barbuda",
                            "AI"=> "Anguilla",
                            "AL"=> "Albania",
                            "AM"=> "Armenia",
                            "AO"=> "Angola",
                            "AQ"=> "Antarctica",
                            "AR"=> "Argentina",
                            "AS"=> "American Samoa",
                            "AT"=> "Austria",   
                            "AU"=> "Australia",
                            "AW"=> "Aruba",
                            "AX"=> "\u00c5land Islands",
                            "AZ"=> "Azerbaijan",
                            "BA"=> "Bosnia and Herzegovina",
                            "BB"=> "Barbados",
                            "BD"=> "Bangladesh",
                            "BE"=> "Belgium",
                            "BF"=> "Burkina Faso",
                            "BG"=> "Bulgaria",
                            "BH"=> "Bahrain",
                            "BI"=> "Burundi",
                            "BJ"=> "Benin",
                            "BL"=> "Saint Barthélemy",
                            "BM"=> "Bermuda",
                            "BN"=> "Brunei Darussalam",
                            "BO"=> "Bolivia, Plurinational State of",
                            "BR"=> "Brazil",
                            "BS"=> "Bahamas",
                            "BT"=> "Bhutan",
                            "BV"=> "Bouvet Island",
                            "BW"=> "Botswana",
                            "BY"=> "Belarus",
                            "BZ"=> "Belize",
                            "CA"=> "Canada",
                            "CC"=> "Cocos (Keeling) Islands",
                            "CD"=> "Congo, the Democratic Republic of the",
                            "CF"=> "Central African Republic",
                            "CG"=> "Congo",
                            "CH"=> "Switzerland",
                            "CI"=> "C\u00f4te d'Ivoire",
                            "CK"=> "Cook Islands",
                            "CL"=> "Chile",
                            "CM"=> "Cameroon",
                            "CN"=> "China",
                            "CO"=> "Colombia",
                            "CR"=> "Costa Rica",
                            "CU"=> "Cuba",
                            "CV"=> "Cape Verde",
                            "CW"=> "Cura\u00e7ao",
                            "CX"=> "Christmas Island",
                            "CY"=> "Cyprus",
                            "CZ"=> "Czech Republic",
                            "DE"=> "Germany",
                            "DJ"=> "Djibouti",
                            "DK"=> "Denmark",
                            "DM"=> "Dominica",
                            "DO"=> "Dominican Republic",
                            "DZ"=> "Algeria",
                            "EC"=> "Ecuador",
                            "EE"=> "Estonia",
                            "EG"=> "Egypt",
                            "EH"=> "Western Sahara",
                            "ER"=> "Eritrea",
                            "ES"=> "Spain",
                            "ET"=> "Ethiopia",
                            "FI"=> "Finland",
                            "FJ"=> "Fiji",
                            "FK"=> "Falkland Islands (Malvinas)",
                            "FM"=> "Micronesia, Federated States of",
                            "FO"=> "Faroe Islands",
                            "FR"=> "France",
                            "GA"=> "Gabon",
                            "GB-ENG"=> "England",
                            "GB-NIR"=> "Northern Ireland",
                            "GB-SCT"=> "Scotland",
                            "GB-WLS"=> "Wales",
                            "GB"=> "United Kingdom",
                            "GD"=> "Grenada",
                            "GE"=> "Georgia",
                            "GF"=> "French Guiana",
                            "GG"=> "Guernsey",
                            "GH"=> "Ghana",
                            "GI"=> "Gibraltar",
                            "GL"=> "Greenland",
                            "GM"=> "Gambia",
                            "GN"=> "Guinea",
                            "GP"=> "Guadeloupe",
                            "GQ"=> "Equatorial Guinea",
                            "GR"=> "Greece",
                            "GS"=> "South Georgia and the South Sandwich Islands",
                            "GT"=> "Guatemala",
                            "GU"=> "Guam",
                            "GW"=> "Guinea-Bissau",
                            "GY"=> "Guyana",
                            "HK"=> "Hong Kong",
                            "HM"=> "Heard Island and McDonald Islands",
                            "HN"=> "Honduras",
                            "HR"=> "Croatia",
                            "HT"=> "Haiti",
                            "HU"=> "Hungary",
                            "ID"=> "Indonesia",
                            "IE"=> "Ireland",
                            "IL"=> "Israel",
                            "IM"=> "Isle of Man",
                            "IN"=> "India",
                            "IO"=> "British Indian Ocean Territory",
                            "IQ"=> "Iraq",
                            "IR"=> "Iran, Islamic Republic of",
                            "IS"=> "Iceland",
                            "IT"=> "Italy",
                            "JE"=> "Jersey",
                            "JM"=> "Jamaica",
                            "JO"=> "Jordan",
                            "JP"=> "Japan",
                            "KE"=> "Kenya",
                            "KG"=> "Kyrgyzstan",
                            "KH"=> "Cambodia",
                            "KI"=> "Kiribati",
                            "KM"=> "Comoros",
                            "KN"=> "Saint Kitts and Nevis",
                            "KP"=> "Korea, Democratic People's Republic of",
                            "KR"=> "Korea, Republic of",
                            "KW"=> "Kuwait",
                            "KY"=> "Cayman Islands",
                            "KZ"=> "Kazakhstan",
                            "LA"=> "Lao People's Democratic Republic",
                            "LB"=> "Lebanon",
                            "LC"=> "Saint Lucia",
                            "LI"=> "Liechtenstein",
                            "LK"=> "Sri Lanka",
                            "LR"=> "Liberia",
                            "LS"=> "Lesotho",
                            "LT"=> "Lithuania",
                            "LU"=> "Luxembourg",
                            "LV"=> "Latvia",
                            "LY"=> "Libya",
                            "MA"=> "Morocco",
                            "MC"=> "Monaco",
                            "MD"=> "Moldova, Republic of",
                            "ME"=> "Montenegro",
                            "MF"=> "Saint Martin",
                            "MG"=> "Madagascar",
                            "MH"=> "Marshall Islands",
                            "MK"=> "Macedonia, the former Yugoslav Republic of",
                            "ML"=> "Mali",
                            "MM"=> "Myanmar",
                            "MN"=> "Mongolia",
                            "MO"=> "Macao",
                            "MP"=> "Northern Mariana Islands",
                            "MQ"=> "Martinique",
                            "MR"=> "Mauritania",
                            "MS"=> "Montserrat",
                            "MT"=> "Malta",
                            "MU"=> "Mauritius",
                            "MV"=> "Maldives",
                            "MW"=> "Malawi",
                            "MX"=> "Mexico",
                            "MY"=> "Malaysia",
                            "MZ"=> "Mozambique",
                            "NA"=> "Namibia",
                            "NC"=> "New Caledonia",
                            "NE"=> "Niger",
                            "NF"=> "Norfolk Island",
                            "NG"=> "Nigeria",
                            "NI"=> "Nicaragua",
                            "NL"=> "Netherlands",
                            "NO"=> "Norway",
                            "NP"=> "Nepal",
                            "NR"=> "Nauru",
                            "NU"=> "Niue",
                            "NZ"=> "New Zealand",
                            "OM"=> "Oman",
                            "PA"=> "Panama",
                            "PE"=> "Peru",
                            "PF"=> "French Polynesia",
                            "PG"=> "Papua New Guinea",
                            "PH"=> "Philippines",
                            "PK"=> "Pakistan",
                            "PL"=> "Poland",
                            "PM"=> "Saint Pierre and Miquelon",
                            "PN"=> "Pitcairn",
                            "PR"=> "Puerto Rico",
                            "PS"=> "Palestine",
                            "PT"=> "Portugal",
                            "PW"=> "Palau",
                            "PY"=> "Paraguay",
                            "QA"=> "Qatar",
                            "RE"=> "Réunion",
                            "RO"=> "Romania",
                            "RS"=> "Serbia",
                            "RU"=> "Russian Federation",
                            "RW"=> "Rwanda",
                            "SA"=> "Saudi Arabia",
                            "SB"=> "Solomon Islands",
                            "SC"=> "Seychelles",
                            "SD"=> "Sudan",
                            "SE"=> "Sweden",
                            "SG"=> "Singapore",
                            "SH"=> "Saint Helena, Ascension and Tristan da Cunha",
                            "SI"=> "Slovenia",
                            "SJ"=> "Svalbard and Jan Mayen Islands",
                            "SK"=> "Slovakia",
                            "SL"=> "Sierra Leone",
                            "SM"=> "San Marino",
                            "SN"=> "Senegal",
                            "SO"=> "Somalia",
                            "SR"=> "Suriname",
                            "SS"=> "South Sudan",
                            "ST"=> "Sao Tome and Principe",
                            "SV"=> "El Salvador",
                            "SX"=> "Sint Maarten (Dutch part)",
                            "SY"=> "Syrian Arab Republic",
                            "SZ"=> "Swaziland",
                            "TC"=> "Turks and Caicos Islands",
                            "TD"=> "Chad",
                            "TF"=> "French Southern Territories",
                            "TG"=> "Togo",
                            "TH"=> "Thailand",
                            "TJ"=> "Tajikistan",
                            "TK"=> "Tokelau",
                            "TL"=> "Timor-Leste",
                            "TM"=> "Turkmenistan",
                            "TN"=> "Tunisia",
                            "TO"=> "Tonga",
                            "TR"=> "Turkey",
                            "TT"=> "Trinidad and Tobago",
                            "TV"=> "Tuvalu",
                            "TW"=> "Taiwan, Province of China",
                            "TZ"=> "Tanzania, United Republic of",
                            "UA"=> "Ukraine",
                            "UG"=> "Uganda",
                            "UM"=> "US Minor Outlying Islands",
                            "US"=> "United States",
                            "UY"=> "Uruguay",
                            "UZ"=> "Uzbekistan",
                            "VA"=> "Holy See (Vatican City State)",
                            "VC"=> "Saint Vincent and the Grenadines",
                            "VE"=> "Venezuela, Bolivarian Republic of",
                            "VG"=> "Virgin Islands, British",
                            "VI"=> "Virgin Islands, U.S.",
                            "VN"=> "Viet Nam",
                            "VU"=> "Vanuatu",
                            "WF"=> "Wallis and Futuna Islands",
                            "WS"=> "Samoa",
                            "YE"=> "Yemen",
                            "YT"=> "Mayotte",
                            "ZA"=> "South Africa",
                            "ZM"=> "Zambia",
                            "ZW"=> "Zimbabwe"
                          ];

         $getFollowersList=$this->getCompanyFollowers($this->userId);
        $getFollowingsList=$this->getCompanyFollowings($this->userId);
        
        $getFollowersList['follower_user']=$this->checkAlreadyFollowing($getFollowersList['follower_user']);
        $getFollowersList['follower_company']=$this->checkAlreadyFollowing($getFollowersList['follower_company']); 
        
        
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
         
         $services      = Service::where("user_id",$this->userId)
                                ->where("is_deleted",0)
                            ->get();
         
         $letters       = $this->getVletters();
         extract($letters);
         
         $galleries         =   $this->getGallariesImages($this->userId); 
         
         $approvels         =   $this->getApprovals();
         
         $staff             =   $this->getStaff();
         
         $usersToSendCard   =   
         
         extract($galleries);
         
         if($view){
             
             return [
                        
                        'trendingPosts'  =>    $trendingPosts,
                        'company'       =>    $company,
                        'profilePic'    =>    $profilePic,
                        'coverPic'      =>    $coverPic,
                        'getFollowersUserList'=> $getFollowersList['follower_user'],
                        'getFollowersCompanyList'=> $getFollowersList['follower_company'],
                        'getFollowingsUserList'=> $getFollowingsList['following_user'],
                        'getFollowingsCompanyList'=> $getFollowingsList['following_company'],
                        "services"           =>  $services,
                        "bookmarks"           => $bookMarks, 
                        
                        
                        
                    ];
         }else{
             return view('company_profile')
             
                    ->with('trendingPosts',$trendingPosts)
         
                    ->with('company',$company)
                    
                    ->with('profilePic',$profilePic)
                    
                    ->with('coverPic',$coverPic)
                     
                     ->with('getFollowersUserList', $getFollowersList['follower_user'])
                     
                     ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                     
                     ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                     
                     ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                     
                     ->with('services',$services)
                     
                     ->with("bookmarks",$bookMarks)
                     
                     ->with("pendingCards",$pendingCards)
                     
                     ->with("approvedCards",$approvedCards)
                     
                     ->with("profilePics",$profilePics)
                     
                     ->with("coverPics",$coverPics)
                     
                     ->with("postImages",$postImages)
                     
                     ->with("serviceImages",$serviceImages)
                     
                     ->with("approvels",$approvels)
                     
                     ->with("staff",$staff)
                     
                     ->with("countries",$countries)
                 ;
         }
         
         
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
            $cvalidation = 'required|max:100';
        }else{
            $cvalidation = 'required|unique:companyprofiles|max:100';
        }
        
        
        
        $validator = Validator::make($request->all(), [
            'company_name'        => $cvalidation,
            'incorporation_date'  => 'required|date|date_format:Y-m-d|before:tomorrow',
            'company_city'        => 'required',
            'company_state'       => 'required',
            'company_zip'         => 'required',
            'country'             => 'required',
            'contact_number'      => 'required',
            'contact_email'       => 'required',   
            'about_us'            => 'required',  
        ]);

        
       
        
        
        if ($validator->fails()) {
            
            return  Redirect::to("company/profile")
                  ->withErrors($validator,"update")
                ->withInput();
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
                                'latlong'               =>      $this->getLatLong($request->company_zip),  
                             ]
                        
                        );
                        
                   
        
        
        
        return  Redirect::to("company/profile")
                    ->with('flash_error',"Profile Saved");
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
                session(['profilepic' =>$filename]);
                
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
       $getFollowersList=$this->getCompanyFollowers($this->userId);
        $getFollowingsList=$this->getCompanyFollowings($this->userId);
        $getFollowersList['follower_user']=$this->checkAlreadyFollowing($getFollowersList['follower_user']);
        $getFollowersList['follower_company']=$this->checkAlreadyFollowing($getFollowersList['follower_company']); 
        $getFollowingsList['following_user']=$this->checkAlreadyFollowing($getFollowingsList['following_user']);
        $getFollowingsList['following_company']=$this->checkAlreadyFollowing($getFollowingsList['following_company']); 
        
        $PostController = new PostController($this->userId);
        $trendingPosts =  $PostController->getAllPost();
        $galleries      = $this->getGallariesImages($this->userId); 
        extract($galleries);
        $services      = Service::where("user_id",$this->userId)
                                ->where("is_deleted",0)
                            ->get();
        $alreadyFollowingUser = DB::table('userfollowings')
                    ->where('following_id', "=", $this->userId)
                    ->where('user_id', "=", Auth::user()->id)
                    ->where('following_status', '=', 1)
                    ->count();
        if($alreadyFollowingUser)
            $UserAlreadyFollowing="1";
        else
            $UserAlreadyFollowing="0";
        return view('company_show')
                    ->with('company',$company)
                    ->with('profilePic',$profilePic)
                    ->with('coverPic',$coverPic)
                    ->with('UserAlreadyFollowing',$UserAlreadyFollowing)
                    ->with('getFollowersUserList', $getFollowersList['follower_user'])
                    ->with('getFollowersCompanyList', $getFollowersList['follower_company'])
                    ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                    ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                    ->with('trendingPosts',$trendingPosts)
                    ->with("profilePics",$profilePics)
                    ->with("coverPics",$coverPics)
                    ->with("postImages",$postImages)
                    ->with("serviceImages",$serviceImages)
                    ->with('services',$services)
                 ;
        
    }
    
    public function redirectToName($uid){
        
        $companyName = CompanyProfile::where('uid','=',$uid)->value("company_name");
        
        $name    = str_replace(" ","-",$companyName);
        
        return Redirect::to("/".$name);
        
    } 
    
    public function getCompanyFollowers($id,$flag='limited') {
        $userFollowersUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $id)
                       ->select("userprofiles.uid as followingUser","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
         $userFollowersCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.user_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.following_id', '=', $id)
                       ->select("companyprofiles.uid as followingUser","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city")
                       ->get();
         
         if($flag=='all')
         {
         $userRecord = CompanyProfile::where('uid','=',$id)->get();
         $getFollowingsList=$this->getCompanyFollowings($id);
         $companyfollowing="companylogin";
          return view('hana.userfollowers')
                      ->with('followerCompany', $userFollowersCompany)
                      ->with('followerUser', $userFollowersUser)
                      ->with('userRecord',$userRecord)
                      ->with('companyfollowing',$companyfollowing)
                      ->with('getFollowingsUserList', $getFollowingsList['following_user'])
                      ->with('getFollowingsCompanyList', $getFollowingsList['following_company'])
                      ->with('userID',$id);
         }
         else
         {
            return["follower_user"=>$userFollowersUser,"follower_company"=>$userFollowersCompany];
         }

    }
    
     public function getCompanyFollowings($id,$flag='limited') {
        $userFollowingsUser =   DB::table('userfollowings')
                       ->join('userprofiles','userprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $id)
                       ->select("userprofiles.uid as followingUser","userprofiles.img as image","userprofiles.pres_desg as designation","userprofiles.fname as fname","userprofiles.lname as lname" ,"userprofiles.pres_org as user_company")
                       ->get();
        $userFollowingsCompany =   DB::table('userfollowings')
                       ->join('companyprofiles','companyprofiles.uid','=','userfollowings.following_id')
                       ->where('userfollowings.following_status', '=', 1)
                       ->where('userfollowings.user_id', '=', $id)
                       ->select("companyprofiles.uid as followingUser","companyprofiles.logo_img as image","companyprofiles.company_name as name","companyprofiles.company_city as city")
                       ->get();
       

         if($flag=='all')
         {
             $companyfollowing="companylogin";
             $userRecord = CompanyProfile::where('uid','=',$id)->get();
         $getFollowersList=$this->getCompanyFollowers($id);
          return view('hana.userfollowings')
                      ->with('followingCompany', $userFollowingsCompany)
                      ->with('followingUser', $userFollowingsUser)
                      ->with('userRecord',$userRecord)
                      ->with('companyfollowing',$companyfollowing)
                      ->with('getFollowersUserList', $getFollowersList['follower_user'])
                      ->with('getFollowerscompanyList', $getFollowersList['follower_company'])
                      ->with('userID',$id);
         }
         else
         {       
           return["following_user"=>$userFollowingsUser,"following_company"=>$userFollowingsCompany];
         }

    }
    public function getVletters(){
        
        
        $vcard  =  new VcardController($this->userId);
        
        
        $pendingCard    =  $vcard->getBusinessCards(0);
        
        
        $approvedCard   =  $vcard->getBusinessCards(1);
        
        
        return ["pendingCards"=>$pendingCard,"approvedCards"=>$approvedCard];
        
    } 
   public function getGallariesImages($id=null){
        
       if(is_null($id)){
           $id=$this->userId;
       } 
       
        $profilePics = "userimages/user_".$id."/medium/";
        $coverPics   = "userimages/user_".$id."/profile_background/";
        
        $galleries   = [];
        
        $galleries["postImages"]    = [];
        $galleries["serviceImages"] = [];
        $galleries["coverPics"]     = [];
        $galleries["profilePics"]   = [];
        
        if(is_dir($profilePics)){
        $pr          =      scandir($profilePics);
        }
        
        if(is_dir($coverPics)){
        $cv          =      scandir($coverPics);  
        }
        
        
        $services    =      Service::where("user_id",$this->userId)
                                  
                                    ->where("is_deleted",0)
                
                                    ->take(1)
                
                                    ->orderBy("id","DESC")
                                    
                                    ->get();
         
        
        $posts      =       \App\Post::where("user_id",$this->userId)
                                  
                                    ->where("is_deleted",0)
                                    
                                    ->where("post_type",1)
                                    
                                    ->where("content_type",1)
                                    
                                    ->whereRaw("LENGTH(post_image)>3")
                
                                    ->orderBy("post_id","DESC")
                
                                    ->take(1)
                
                                    ->get(); 
        
       
        
        foreach($services as $service){
            $service->image = URL::to("images/services/".$service->image); 
            $galleries["serviceImages"][]= $service->image;
        }
        
       
        
        foreach($posts as $post){
            $post->post_image = URL::to("images/posts/".$post->post_image); 
            $galleries["postImages"][]= $post->post_image; 
        }
        
        if(is_dir($coverPics))
        {
            for($i=2; $i < 3; $i++)
            {
                $galleries["coverPics"][] = URL::to($coverPics.$cv[$i]);
            }
        }
        
        if(is_dir($profilePics))
        {
            for($i=2; $i < 3; $i++)
            {
                $galleries["profilePics"][] = URL::to($profilePics.$pr[$i]);
            }
        }
        
        
        
        
        return $galleries;
    }
    
    
    public function getGalleriesImages($cat,$id){
        
        $images = [];
        
        
        
        $profilePics = "userimages/user_".$id."/medium/";
        
        
        $coverPics   = "userimages/user_".$id."/profile_background/";
        
        
        switch($cat){
            case 1:
                
                $posts      =       \App\Post::where("user_id",$id)
                                  
                                    ->where("is_deleted",0)
                    
                                    ->whereRaw("LENGTH(post_image)>3")
                
                                    ->pluck("post_image"); 
        
                foreach($posts as $post){
                    $images[] = URL::to("images/posts/".$post); 
                }
        
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Uploads")
                        ->with("userID",$id)
                        ;
                
                break;
            
              case 2:
                
                $services    =      Service::where("user_id",$id)
                                  
                                    ->where("is_deleted",0)
                                    
                                    
                                    ->pluck("image");
        
        
                foreach($services as $service){
                    
                        
                        $images[] = URL::to("images/services/".$service); 
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Services Images")
                        ->with("userID",$id)
                        ;
                
                break;
            
           
            case 3:
                
                if(is_dir($profilePics)){
                    $pr          =      scandir($profilePics);
                }
                
                for($i=2; $i < count( $pr ); $i++){
                
                    $images[] = URL::to($profilePics.$pr[$i]);
            
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Profile Pictures")
                        ->with("userID",$id)
                        ;
                
                break;
            
            case 4:
                
                if(is_dir($coverPics)){
                    $cv          =      scandir($coverPics);  
                    
                    for($i=2; $i < count( $cv ); $i++){
                
                    $images[] = URL::to($coverPics.$cv[$i]);
            
                }
                
                }
                
                return view("posts.gallery")
                        ->with("images",$images)
                        ->with("tag","Cover Pictures")
                        ->with("userID",$id)
                        ;
                
                break;
        }
    }
    
    
    public function getGallery($id){
        
        $galleries      = $this->getGallariesImages($id); 
        
        extract($galleries);
        //print_r($profilePics);die;
        return view("posts.galleries")
                ->with("profilePics",$profilePics)
                ->with("coverPics",$coverPics)
                ->with("postImages",$postImages)
                ->with("serviceImages",$serviceImages)
                ->with("userID",$id)
                ;
   }

   public function getApprovals(){
       
       $approvals = \App\ApprovalRequest::join("userprofiles","userprofiles.uid","=","approval_requests.user_id")
                        
                        ->where("approval_requests.company_id",$this->userId)
               
                        ->where("approval_requests.is_approved",0)
                        
                        ->get();
       
       return $approvals;
                    
   } 
   
   public function getStaff(){
       
       $approvals = \App\ApprovalRequest::join("userprofiles","userprofiles.uid","=","approval_requests.user_id")
                        
                        ->where("approval_requests.company_id",$this->userId)
               
                        ->where("approval_requests.is_approved",STAFF_APPROVED)
                        
                        ->paginate(10);
       
       return $approvals;
                    
   }
   
   
   public function approveRequest($id){
       
       $approvals = \App\ApprovalRequest::where("apr_id",$id)
               
                        ->update(["is_approved"=>STAFF_APPROVED]);
       
       return Redirect::back()->with("st",$approvals);
                    
   }
   
   public function approveRequestDelete($id){
       
       $approvals = \App\ApprovalRequest::where("apr_id",$id)
               
                        ->delete();
       
       return Redirect::back()->with("st",$approvals);
                    
   }
   
   public function checkAlreadyFollowing($check)
{
    foreach($check as $follower)
        {
            $alreadyFollowing = DB::table('userfollowings')
                    ->where('following_id', "=", $follower->followingUser)
                    ->where('user_id', "=", Auth::user()->id)
                    ->where('following_status', '=', 1)
                    ->count();
        if($alreadyFollowing)
            $follower->alreadyFollowing="1";
        else
            $follower->alreadyFollowing="0";
        }
return $check;        
}
   
 public function addJobs(Request $request)
 {
     //print_r($request);die;
     $temp = new Jobpost();
        $temp->	title = $request->get('jobtitle');
        $temp->aboutcomp = $request->get('aboutcomp');
        $temp->experience = $request->get('experience');
        $temp->joblocation = $request->get('location');
        $temp->specialization =  $request->get('specialization');
        $temp->jobsalaries =  $request->get('salary');
        $temp->	employertype =  $request->get('industry');
        $temp->process =  $request->get('interviewprocess');
        $temp->jobskill =  $request->get('skills');
        $temp->description =  $request->get('desc');
        
        $temp->cmp_id = Auth::user()->id;
         $temp->save();
         
         return back();
     
 }

 
 public function getLatLong($zip){
        
        $url = "http://maps.google.com/maps/api/geocode/json?address=$zip&sensor=false&region=India";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);

        curl_close($ch);

        $response_a = json_decode($response);

        return  $response_a->results[0]->geometry->location->lat.",".$response_a->results[0]->geometry->location->lng;

 }
    
}
