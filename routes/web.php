<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\IncidentReportUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Route grouped.........................................
Route::prefix("auth")->group(function(){

    Route::get('/index', function () {
    return view('auth.index');
})->name("index");

    Route::get('/register', function () {
    return view('auth.register');
})->name("regitser");

    Route::get('/login', function () {
    return view('auth.login');
})->name("login");

});



//POST Login route...............................................
    Route::post('/auth/register', function () {
        // Handle the registration logic here
        // For example, you can validate the request and create a new user
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        // ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
})->name("register");

// Incident reporting CRUD Route grouped (Controller-based)------------------
Route::prefix('user/report')
    ->as('user.report.')
    ->group(function () {
    Route::resource('userIncidentReporting', IncidentReportUserController::class);
    Route::get('/userDashboardReporting', [IncidentReportUserController::class, 'dashboard'
    ])->name("userDashboardReporting");
    Route::get('viewReports/{id}', [IncidentReportUserController::class, 'viewReport'])
    ->name('user.report.viewReports');
});

// Page-based routes for static views (non-controller)...................
Route::prefix('user/report')
    ->as('user.report.')
    ->group(function () {
    Route::get('/editReports', function () {
        return view('user.report.editReports');
})->name("editReports");
    Route::get('/userProfileReporting', function () {
        return view('user.report.userProfileReporting');
    })->name("userProfileReporting");
});
    Route::get('user/userMainDashboard', function () {
        return view('user.userMainDashboard');
})->name("userMainDashboard");

// Staff Route grouped.........................................
Route::prefix("/incidentReporting/staffReport/")->group(function(){

    Route::get('/viewReports', function () {
    return view('incidentReporting.staffReport.viewReportsStaff');
})->name("viewReportsStaff");

    // Route::resource('viewReports', viewReportStaffContoller::class);

});
