<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //the controller for the api controller
    public function viewAvailableJobs(){

          //return all the jobs by their name that are available as json to the android application
          $jobsWithDetails = DB::table('jobs')
          ->join('job_details', 'jobs.id', '=', 'job_details.job_id')
          ->select('jobs.job as job_name','job_details.date')
          ->get();
  
          if(!$jobsWithDetails){
              return response()->json("error","no jobs found");  
          }
          return response()->json($jobsWithDetails);
    }    
}

?>
