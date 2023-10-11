<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/', [DashboardController::class, 'welcome'])->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/viewJob/{id}', [JobController::class, 'viewJobById'])->name("viewJob");
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('search-job', [SearchController::class, 'searchJob'])->name("search-job");
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
//routes for the application tied to the auth middleware
Route::group(['middleware' => 'auth'], function () {
	Route::get('/createJob', [JobController::class, 'index'])->name("createJob");
	Route::get('/searchJob', [JobDetailsController::class, 'viewSearchJobScreen'])->name("searchJob");
    Route::post('/submitJob', [JobController::class, 'store'])->name("submitJob");
    Route::get('/deleteJob/{id}', [JobDetailsController::class, 'deleteJob'])->name("deleteJob");
	Route::get('/editJob/{id}', [JobDetailsController::class, 'editJob'])->name("editJob");
	Route::get('/updateJob/{id}', [JobDetailsController::class, 'updateJob'])->name("updateJob");
	Route::get('/searchJob/{id}', [JobDetailsController::class, 'searchJobDetailsByName'])->name("searchJob");
	Route::get('/changeName/{id}', [JobController::class, 'changeJobName']);
	Route::get('/search', 'JobDetailsController@searchData')->name('searchData');
	Route::get('/searchData', [JobDetailsController::class, 'searchData']);
	Route::post('/submitJobDetails', [JobDetailsController::class, 'createJobDetails'])->name('submitJobDetails');
	Route::put('/submitChangeJobName/{$id}', [JobController::class, 'submitChangeJobName'])->name('submitChangeJobName');
	Route::put('/submitChangeJobName/{$id}', [JobController::class, 'submitChangeJobName'])->name('submitChangeJobName');
	Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
	Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
	Route::post('user-profile', [ProfileController::class, 'update']);
	Route::post('/search-data', [JobDetailsController::class, 'getTotal'])->name('search-data');
});