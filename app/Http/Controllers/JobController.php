<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $name = Auth::user()->name;
        return view("pages.createJob")->with("name",$name);
    }

    public function updateJob(Request $request,$id){

        $request->validate([
            'job' => 'required|max:255',
          ]);
        $query = "UPDATE jobs SET job = :job WHERE id = :id";
        // Bind parameters to the query
        $params = [
        'job' => $request->input('job'),
        'id' => $id,
        ];
        DB::statement($query, $params);
        return redirect()->back()->with('success', 'Job updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'job' => 'required|string',
        ]);
        // Create a new Job instance and fill it with the validated data
        $job = new Job();
        $job->job = $validatedData['job'];
        // Save the job to the database
        $job->save();
        return redirect('/dashboard');
    }

    public function changeJobName($id){

        $name = Auth::user()->name;
        $job = Job::find($id);
        return view("pages.changeJobName")->with("job",$job)->with("name",$name);

    }

    public function viewAvailableJobs(){

     
    }


    public function submitChangeJobName(Request $request,$id){

        
       $validatedData = $request->validate([
            'job' => 'required|string',
        ]);
       $job = Job::find($id);
       $job->update($request->all());
       echo "done";

    }


    //view the job by an id and pass it to the view
    public function viewJobById($id){        
       
        //get the job from the database using the id
        $job = Job::find($id); 
        //Get the job ID from the retrieved Job model
        //get the job name and the job id
        $jobId = $job->id;
        $jobName = $job->job;
        $startDate = now()->toDateString();
        $endDate = now()->addDays(6)->toDateString();
        $jobsWithDetails = DB::table('jobs')
        ->leftJoin('job_details', 'jobs.id', '=', 'job_details.job_id')
        ->select('jobs.job', 'job_details.date', 'job_details.shift',
         DB::raw('CASE WHEN SUM(job_details. num_people) 
         < 0 THEN 0 ELSE SUM(job_details.num_people) 
         END as total_num_people'))
        ->where('jobs.id', $jobId)
        ->whereBetween('job_details.date', [$startDate, $endDate])
        ->groupBy('jobs.job', 'job_details.date', 'job_details.shift')
        ->get();
        return view('pages.viewJobById')
        ->with('jobsWithDetails', $jobsWithDetails)
        ->with("jobName",$jobName);
    }

}
