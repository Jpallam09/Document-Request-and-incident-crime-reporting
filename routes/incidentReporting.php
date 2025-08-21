<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentReporting\IncidentReportStaffController;
use App\Http\Controllers\IncidentReporting\IncidentReportAdminController;
use App\Http\Controllers\IncidentReporting\EditRequestController;
use App\Http\Controllers\IncidentReporting\DeleteRequestController;
use App\Http\Controllers\ProfileControllers\ReportStaffProfileController;

Route::prefix('incidentReporting')->middleware('auth')->group(function () {

    // STAFF ROUTES
    Route::prefix('staffReporting')
        ->middleware(['check.role:incident_reporting,staff', 'prevent-back-history'])
        ->name('reporting.staff.')
        ->group(function () {

            //redirect to dashboard
            Route::get('/dashboard', [IncidentReportStaffController::class, 'dashboard'])
                ->name('dashboard');
            // View all reports
            Route::get('/staffReportView', [IncidentReportStaffController::class, 'staffReportView'])
                ->name('staffReportView');
            // View a single report
            Route::get('/staffViewReportsFullDetails/{id}', [IncidentReportStaffController::class, 'staffViewReportsFullDetails'])
                ->name('staffViewReportsFullDetails');

            // Export report as PDF
            Route::get('/staffViewReportsFullDetails/{id}/export-pdf', [IncidentReportStaffController::class, 'exportPdf'])
                ->name('exportPdf');

            // Show Track Report page for a specific report
            Route::get('/staffViewReportsFullDetails/{id}/track', [IncidentReportStaffController::class, 'ShowTrackReport'])
                ->name('staffViewReports.track');

            Route::post('/trackReport', [IncidentReportStaffController::class, 'trackReport'])
                ->name('trackReport');

            //----------edit group----------//
            // Route to view edit requests
            Route::get('/staffUpdateRequests', [EditRequestController::class, 'index'])
                ->name('staffUpdateRequests');
            // Route to view a specific edit request
            Route::get('/edit-request/{id}', [EditRequestController::class, 'show'])
                ->name('editRequest.show');
            // Accept edit requests
            Route::post('/edit-request/{id}/accept', [EditRequestController::class, 'accept'])
                ->name('updateRequest.accept');
            //reject edit requests
            Route::post('/edit-request/{id}/reject', [EditRequestController::class, 'reject'])
                ->name('updateRequest.reject');

            //----------deletion group----------//
            // View all delete requests
            Route::get('/staffDeletionRequests', [DeleteRequestController::class, 'index'])
                ->name('staffDeletionRequests');
            // Create a delete request
            Route::post('/delete-request/{id}/accept', [DeleteRequestController::class, 'accept'])
                ->name('staffDeletionRequests.accept');
            // Discard a delete request
            Route::post('/delete-request/{id}/reject', [DeleteRequestController::class, 'reject'])
                ->name('staffDeletionRequests.reject');

            //chart dashboard
            Route::get('/monthlyTrend', [IncidentReportStaffController::class, 'getMonthlyReportTrend'])
                ->name('monthlyTrend');
            //chart Report Type Distribution
            Route::get('/reportType', [IncidentReportStaffController::class, 'getReportTypeChart'])
                ->name('reportType');

            //staff profile
            Route::get('/profile', [ReportStaffProfileController::class, 'show'])
                ->name('profile.show');
            Route::post('/profile/update', [ReportStaffProfileController::class, 'updateInfo'])
                ->name('profile.update');
        });

    Route::prefix('staffReporting')
        ->middleware('check.role:incident_reporting,staff')
        ->name('reporting.staff.')
        ->group(function () {

            // existing routes...

            // Mark notification as read
            Route::get('/notifications/mark-read/{id}', [IncidentReportStaffController::class, 'markNotificationRead'])
                ->name('notifications.markRead');
        });


    // Admin ROUTES
    Route::prefix('adminReporting')
        ->middleware(['auth', 'check.role:incident_reporting,admin']) // optional: add role check
        ->name('reporting.admin.')
        ->group(function () {
            Route::get('/dashboard', [IncidentReportAdminController::class, 'dashboard'])->name('dashboard');
        });
});
