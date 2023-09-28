<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        /*$jobId = Job::find($id)->id; // Get the job ID from the retrieved Job model
        /*$jobsWithDetails = DB::table('jobs')
        ->leftJoin('job_details', 'jobs.id', '=', 'job_details.job_id')
        ->select('jobs.job', 'job_details.date', 'job_details.shift', DB::raw('SUM(job_details.num_people)   as total_num_people'))
        ->where('jobs.id', $jobId) // Filter by the specific job ID
        ->whereBetween('job_details.date', [$startDate, $endDate])
        ->groupBy('jobs.job', 'job_details.date', 'job_details.shift')
        ->get();*/
        //return the jobs to the front end
        //$countOfJobs = Db::table(Db::raw('select count(id) from jobs as jobCount'));
        //dd($countOfJobs);
        $numberOfJobs = DB::table('jobs')->count();
        $lastEnteredJob = DB::table('jobs')->latest()->first();
        //dd($lastEnteredJob);
        //collect all the patients from the database
        //dd($numberOfJobs);
        $jobs = Job::orderBy('id', 'desc')->paginate(5);
        return view('dashboard.index')->with("jobs",$jobs)->with("numberOfJobs",$numberOfJobs)->with("latest",$lastEnteredJob);
    }

    public function welcome(){

        $jobs = Job::orderBy('id', 'desc')->get();
        return view("welcome")->with("jobs",$jobs);
    }
}
