<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentReporting\IncidentReportUserController;
use App\Http\Controllers\ProfileControllers\UserProfileController;
use App\Http\Controllers\IncidentReporting\FeedbackCommentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPassController;

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
    })->name("index");

    Route::get('/forgot', [ForgotPassController::class, 'showForgot'])->name("forgot");
    Route::post('/forgot', [ForgotPassController::class, 'sendResetLink'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ForgotPassController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPassController::class, 'resetPassword'])->name('password.update');
});

// ------------------ GLOBAL LOGOUT ROUTE ------------------
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ------------------ USER INCIDENT REPORT ROUTES ------------------
Route::prefix('user/report')
    ->as('user.report.')
    ->middleware(['auth', 'prevent-back-history'])
    ->group(function () {
        Route::middleware('auth')->group(function () {
            // User Main Dashboard
            Route::get('/userMainDashboard', function () {
                return view('user.userMainDashboard');
            })
                ->name("userMainDashboard");
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
        //notification
        Route::get('notifications/{id}/mark-read', [IncidentReportUserController::class, 'markAsRead'])
            ->name('notifications.markRead');

        // Show current user's profile
        Route::get('/userProfile', [UserProfileController::class, 'show'])
            ->name('user.profile.show');
        // Update current user's profile
        Route::post('/userProfile/update', [UserProfileController::class, 'updateInfo'])
            ->name('user.profile.update');

        // Feedback and Comments
        // Submit feedback
        Route::post('/viewReports/{id}/feedback', [FeedbackCommentController::class, 'store'])
            ->name('feedback.store');
        // View my feedback
        Route::get('/myFeedback', [FeedbackCommentController::class, 'myFeedback'])
            ->name('feedback.myFeedback');
    });

// ------------------ IMPORT ROUTE FILES ------------------
require __DIR__ . '/incidentReporting.php';
require __DIR__ . '/documentRequest.php';
