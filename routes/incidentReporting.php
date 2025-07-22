<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentReporting\IncidentReportStaffController;
use App\Http\Controllers\IncidentReporting\IncidentReportAdminController;
use App\Http\Controllers\IncidentReporting\EditRequestController;

Route::prefix('incidentReporting')->middleware('auth')->group(function () {

    // STAFF ROUTES
    Route::prefix('staffReporting')
        ->middleware('check.role:incident_reporting,staff')
        ->name('reporting.staff.')
        ->group(function () {
    Route::get('/dashboard', [IncidentReportStaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/staffReportView', [IncidentReportStaffController::class, 'staffReportView'])->name('staffReportView');
    Route::get('/staffViewReportsFullDetails/{id}', [IncidentReportStaffController::class, 'staffViewReportsFullDetails'])->name('staffViewReportsFullDetails');
    Route::get('/staffDeletionRequests', [IncidentReportStaffController::class, 'staffDeletionRequests'])->name('staffDeletionRequests');
    // Route to view edit requests
    Route::get('/staffUpdateRequests', [EditRequestController::class, 'index'])->name('staffUpdateRequests');
    // Route to view a specific edit request
    Route::get('/edit-request/{id}', [EditRequestController::class, 'show'])->name('editRequest.show');
        // Accept edit requests
     Route::post('/edit-request/{id}/accept', [EditRequestController::class, 'accept'])
    ->name('updateRequest.accept');
    //reject edit requests
    Route::post('/edit-request/{id}/reject', [EditRequestController::class, 'reject'])
    ->name('updateRequest.reject');
    }); 

// Admin ROUTES
Route::prefix('adminReporting')
        ->middleware(['auth', 'check.role:incident_reporting,admin']) // optional: add role check
        ->name('reporting.admin.')
        ->group(function () {
    Route::get('/dashboard', [IncidentReportAdminController::class, 'dashboard'])->name('dashboard');
    });


});
