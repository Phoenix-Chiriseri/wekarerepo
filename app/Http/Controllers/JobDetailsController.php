<?php

namespace App\Http\Controllers;

use App\Models\JobDetails;
use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;


class JobDetailsController extends Controller
{


    public function searchJobDetailsByName($id){

        $job = Job::find($id);
        $shiftOptions = [
            'morning' => 'Morning Shift',
            'late' => 'Late Shift',
            'night' => 'Night Shift',
            'long' => 'Long Day',
        ];
        $name = Auth::user()->name;
        return view("pages.searchJob")->with("name",$name)->with("shiftOptions",$shiftOptions)->with("job",$job);
    }

   public function deleteJob($id){
        $job = Job::find($id);
        if ($job) {
            $job->delete();      
            // Optionally, you can redirect to a page after deletion
            return redirect()->route('dashboard')->with('success', 'Job deleted successfully');
        } else {
            // Handle the case where the job with the given ID was not found
            //return view('pages.nojobsfound');
            return redirect()->route('nojobsfound')->with('success', 'No jobs Found');
        }
    }

    public function getTotal(Request $request){
        
        $validatedData = $request->validate([
            'shift' => 'required|string',
            'date' => 'required|date',
            'id'=>'required|string'
        ]);
        
        $shift = $validatedData['shift'];
        $date = $validatedData['date'];
        $id = $validatedData['id'];

        $name = Auth::user()->name;

        $jobsWithDetails = DB::table('jobs')
            ->leftJoin('job_details', 'jobs.id', '=', 'job_details.job_id')
            ->select(
                'jobs.job',
                'job_details.date',
                'job_details.shift',
                DB::raw('SUM(job_details.num_people) as total_num_people')
            )
            ->where('jobs.id', $id)
            ->where('job_details.date', $date)
            ->where('job_details.shift', $shift)
            ->groupBy('jobs.job', 'job_details.date', 'job_details.shift')
            ->get();
            return view('pages.showJobCount')->with("jobWithDetails",$jobsWithDetails)->with("name",$name);
            //return redirect()->route('editJob')->with('jobWithDetails',$jobsWithDetails);
    }

    public function editJob($id)
    {
 
        $name = Auth::user()->name;
        $job = Job::find($id);
        $jobId = $job->id;
        $shiftOptions = [
            'morning' => 'Morning Shift',
            'late' => 'Late Shift',
            'night' => 'Night Shift',
            'long' => 'Long Day',
        ];
        return view('pages.editJob')->with("shiftOptions",$shiftOptions)->with("job",$job)->with(
        "name",$name
        );   
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function createJobDetails(Request $request)
    {
        // Validate the form data
        //store the job with the details
        $validatedData = $request->validate([
            // Ensure that the selected job exists
           'date' => 'required|date',
           'num_people' => 'required|integer',
           'shift' => 'required|string',
       ]);
       // Create a new job detail
       $jobDetail = new JobDetails();
       $jobDetail->job_id = $request->input('id');
       $jobDetail->date = $validatedData['date'];
       $jobDetail->num_people = $validatedData['num_people'];
       $jobDetail->shift = $validatedData['shift'];
       // Save the job detail to the database
       $jobDetail->save();
       return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
}
