<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'desc')->get();
        return view('dashboard.index')->with("jobs",$jobs);
    }
}
