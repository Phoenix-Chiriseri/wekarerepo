<?php

namespace App\Http\Controllers;

use App\Models\JobDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function deleteJob($id){
        $job = Job::find($id);
        if ($job) {
            $job->delete();      
            // Optionally, you can redirect to a page after deletion
            return redirect()->route('home')->with('success', 'Job deleted successfully');
        } else {
            // Handle the case where the job with the given ID was not found
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobDetails $jobDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobDetails $jobDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobDetails $jobDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobDetails $jobDetails)
    {
        //
    }
}
