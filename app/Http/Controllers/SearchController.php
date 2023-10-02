<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchJob(Request $request){

        //validate the data
        $validatedData = $request->validate([
            'search_job' => 'required|string|max:255', // Adjust validation rules as needed
        ]); 
        //search the job and store it in a variable
        $requestedJob = $request->input("search_job");
        $jobs = DB::table('jobs')
        ->where('job', 'like', '%' . $requestedJob . '%')
        ->get();    
        if(!$jobs){
            echo "No Job Found";
        }
        return view("welcome")->with("jobs",$jobs);        
    }
}
