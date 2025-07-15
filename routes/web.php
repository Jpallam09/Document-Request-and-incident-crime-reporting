<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\IncidentReporting\IncidentReportUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// ------------------ HOME ROUTE ------------------
Route::get('/', function () {
    return view('auth.index');
});

// ------------------ AUTH ROUTES ------------------
Route::prefix("auth")->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/index', function () {
    return view('auth.index');
    })->name("index");
});

// ------------------ GLOBAL LOGOUT ROUTE ------------------
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ------------------ USER INCIDENT REPORT ROUTES ------------------
Route::prefix('user/report')
    ->as('user.report.')
    ->group(function () {
    Route::middleware('auth')->group(function () {
    Route::get('/userDashboardReporting', [IncidentReportUserController::class, 'dashboard'])
    ->name("userDashboardReporting");
    Route::resource('userIncidentReporting', IncidentReportUserController::class);
    Route::get('viewReports/{id}', [IncidentReportUserController::class, 'viewReport'])->name('viewReports');
    });

// ------------------ STATIC VIEWS ------------------
    Route::get('/editReports', function () {
    return view('user.report.editReports');
    })->name("editReports");

    Route::get('/userProfileReporting', function () {
    return view('user.report.userProfileReporting');
    })->name("userProfileReporting");
    });

// ------------------ USER MAIN DASHBOARD ------------------
Route::get('user/userMainDashboard', function () {
    return view('user.userMainDashboard');
})->name("userMainDashboard");

// ------------------ IMPORT ROUTE FILES ------------------
require __DIR__.'/incidentReporting.php';
require __DIR__.'/documentRequest.php';
