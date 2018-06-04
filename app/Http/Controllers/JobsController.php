<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobpost;

use Auth;

use Response;   

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $jobs     =  Jobpost::leftJoin('companyprofiles','companyprofiles.uid','=','jobposts.cmp_id')->paginate(10);
        
        //return view('jobs.jobs')->with('jobs',$jobs);
        return view('jobs.jobs',array('jobs'=>$jobs));
    }
    
    public function jobDetail($jobId) {
        
        $job     =  Jobpost::leftJoin('companyprofiles','companyprofiles.uid','=','jobposts.cmp_id')
                       ->where('jobposts.job_id',$jobId)  
                       ->first() 
                     ;
        
        return view('jobs.job_detail')->with("job",$job);
        
    }
    
    public function addJobs(Request $request) {
        
         $validator = Validator::make($request->all(), [
            'jobtitle'              => 'required',
            'aboutcomp'             => 'required',
            'experience'            => 'required',
            'company_state'         => 'required',
            'location'              => 'required',
            'specialization'        => 'required',
            'industry'              => 'required',
            'interviewprocess'      => 'required',   
            'skills'                => 'required',  
            'desc'                  => 'required', 
        ]);

        
        if ($validator->fails()) {
            
            return  Redirect::back()
                  ->withErrors($validator,"jobs")
                ->withInput();
        }
     
        $temp                   = new Jobpost();
        
        $temp->	title           =  $request->get('jobtitle');
        
        $temp->aboutcomp        =  $request->get('aboutcomp');
        
        $temp->experience       =  $request->get('experience');
        
        $temp->joblocation      =  $request->get('location');
        
        $temp->specialization   =  $request->get('specialization');
        
        $temp->jobsalaries      =  $request->get('salary');
        
        $temp->	employertype    =  $request->get('industry');
        
        $temp->process          =  $request->get('interviewprocess');
        
        $temp->jobskill         =  $request->get('skills');
        
        $temp->description      =  $request->get('desc');
        
        $temp->cmp_id           =  Auth::user()->id;
        
        $temp->save();
         
         return back();
     
   }
   
   public function  getRelatedJobs(){
       
   }
 
   public function ApplyToTheJob($postedBy,$jobid){
       
       $apply               =       new \App\JobApply;
       
       $apply->postedby     =       $postedBy;
       
       $apply->appliedby    =       Auth::user()->id;
       
       $apply->jobid        =       $jobid;
       
       $apply->save();
       
       return Response::json(["success"=>true,'error'=>0]);
   }
   
   public function searchJobs(Request $request){
       
       $keywords = $request->keywords;
       
       $location = $request->location;
       
       $jobs     =  Jobpost::leftJoin('companyprofiles','companyprofiles.uid','=','jobposts.cmp_id')
                       ->where("jobposts.joblocation",'like',"%$location%")
                       ->where(function ($query) use ($keywords) {

                            $query->where("companyprofiles.company_name",'like',"%$keywords%")
                                   ->orWhere("jobposts.title",'like',"%$keywords%")
                                   ->orWhere("jobposts.jobskill",'like',"%$keywords%") 
                                    
                                    ;
                         
                         })
                        ->paginate(10); 
                        
       return view('jobs.jobs')->with('jobs',$jobs);
   }
   
}
