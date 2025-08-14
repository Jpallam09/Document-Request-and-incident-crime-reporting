<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IncidentReporting\IncidentReportUserController;
use App\Http\Controllers\ProfileControllers\UserProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// ------------------ HOME ROUTE ------------------
Route::get('/', function () {
    return view('auth.index');
});
// ------------------ AUTH ROUTES ------------------
Route::prefix("auth")->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register'); // ✅ FIXED: Now GET
    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.post');

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

    Route::get('/index', function () {
        return view('auth.index');
    })
        ->name("index");
});

// ------------------ GLOBAL LOGOUT ROUTE ------------------
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ------------------ USER INCIDENT REPORT ROUTES ------------------
Route::prefix('user/report')
    ->as('user.report.')
    ->middleware('auth')
    ->group(function () {
        Route::middleware('auth')->group(function () {
            // User Dashboard for Incident Reporting
            Route::get('/userDashboardReporting', [IncidentReportUserController::class, 'index'])
                ->name("userDashboardReporting");
            // User Make report
            Route::resource('userIncidentReporting', IncidentReportUserController::class);
            //viewReports table
            Route::get('viewReports/{id}', [IncidentReportUserController::class, 'viewReport'])
                ->name('viewReports');
            //editRequest
            Route::put('requestUpdate/{id}', [IncidentReportUserController::class, 'requestUpdate'])
                ->name('requestUpdate');
            // edit
            Route::get('/editReports/{id}', [IncidentReportUserController::class, 'edit'])
                ->name('user.report.edit');
            // delete Request
            Route::delete('/requestDelete/{incidentReportUser}', [IncidentReportUserController::class, 'requestDelete'])
                ->name('delete');
        });
        Route::get('/userProfileReporting', function () {
            return view('user.report.userProfileReporting');
        })
            ->name("userProfileReporting");
        //notification
        Route::get('notifications/{id}/mark-read', [IncidentReportUserController::class, 'markAsRead'])
            ->name('notifications.markRead');

        // Show current user's profile
        Route::get('/userProfile', [UserProfileController::class, 'show'])
            ->name('user.profile.show');
        // Update current user's profile
        Route::put('/userProfile/update', [UserProfileController::class, 'updateInfo'])
            ->name('user.profile.update');
    });
// ------------------ USER MAIN DASHBOARD ------------------
Route::get('user/userMainDashboard', function () {
    return view('user.userMainDashboard');
})
    ->name("userMainDashboard");
// ------------------ IMPORT ROUTE FILES ------------------
require __DIR__ . '/incidentReporting.php';
require __DIR__ . '/documentRequest.php';
