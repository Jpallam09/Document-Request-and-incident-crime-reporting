<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentReporting\IncidentReportUserController;
use App\Http\Controllers\IncidentReporting\IncidentReportStaffController;
use App\Http\Controllers\IncidentReporting\IncidentReportAdminController;

Route::prefix('incidentReporting')->middleware('auth')->group(function () {

    // STAFF ROUTES
    Route::prefix('staffReporting')
        ->middleware('check.role:incident_reporting,staff')
        ->name('reporting.staff.')
        ->group(function () {
    Route::get('/dashboard', [IncidentReportStaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/staffReportView', [IncidentReportStaffController::class, 'staffReportView'])->name('staffReportView');
    Route::get('/viewReports/{id}', [IncidentReportStaffController::class, 'viewSingle'])->name('viewSingle');
    Route::get('/staffDeletionRequests', [IncidentReportStaffController::class, 'staffDeletionRequests'])->name('staffDeletionRequests');
    Route::get('/staffUpdateRequests', [IncidentReportStaffController::class, 'staffUpdateRequests'])
    ->name('staffUpdateRequests');

    });

// Admin ROUTES
Route::prefix('adminReporting')
        ->middleware(['auth', 'check.role:incident_reporting,admin']) // optional: add role check
        ->name('reporting.admin.')
        ->group(function () {
    Route::get('/dashboard', [IncidentReportAdminController::class, 'dashboard'])->name('dashboard');
    });


});
