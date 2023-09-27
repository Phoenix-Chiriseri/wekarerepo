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

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
    
    }

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

    public function submitChangeJobName(Request $request,$id){

        
       $validatedData = $request->validate([
            'job' => 'required|string',
        ]);
       $job = Job::find($id);
       $job->update($request->all());
       echo "done";

    }


    public function viewJobById($id){
        
        $jobId = Job::find($id)->id; // Get the job ID from the retrieved Job model
        $startDate = now()->toDateString();
        $endDate = now()->addDays(7)->toDateString();
        $jobsWithDetails = DB::table('jobs')
        ->leftJoin('job_details', 'jobs.id', '=', 'job_details.job_id')
        ->select('jobs.job', 'job_details.date', 'job_details.shift', DB::raw('SUM(job_details.num_people)   as total_num_people'))
        ->where('jobs.id', $jobId) // Filter by the specific job ID
        ->whereBetween('job_details.date', [$startDate, $endDate])
        ->groupBy('jobs.job', 'job_details.date', 'job_details.shift')
        ->get();
        return view('pages.viewJobById')->with('jobsWithDetails', $jobsWithDetails);
    }
    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
