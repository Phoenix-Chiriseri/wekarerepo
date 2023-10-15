<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class ApiController extends Controller
{
    //
    public function viewLatestJob(){

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
    ->whereRaw('job_details.created_at = (SELECT MAX(created_at) FROM job_details)')
    ->get();

    return response()->json($jobsWithDetails);
    
    }

    
}
