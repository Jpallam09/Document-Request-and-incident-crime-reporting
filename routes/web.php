<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\IncidentReportUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// ------------------ AUTH ROUTES ------------------
Route::prefix("auth")->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/index', function () {
        return view('auth.index');
    })->name("index");
});

// ------------------ INCIDENT REPORT ROUTES ------------------
Route::prefix('user/report')
    ->as('user.report.')
    ->group(function () {

    Route::middleware('auth')->group(function () {
        Route::get('/userDashboardReporting', [IncidentReportUserController::class, 'dashboard'])
            ->name("userDashboardReporting");

        // Protected routes go here if needed
    });

    Route::resource('userIncidentReporting', IncidentReportUserController::class);

    Route::get('viewReports/{id}', [IncidentReportUserController::class, 'viewReport'])
        ->name('viewReports');
});

// ------------------ STATIC VIEWS ------------------
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

// ------------------ STAFF ROUTES ------------------
Route::prefix("/incidentReporting/staffReport")->group(function () {
    Route::get('/viewReports', function () {
        return view('incidentReporting.staffReport.viewReportsStaff');
    })->name("viewReportsStaff");
});
