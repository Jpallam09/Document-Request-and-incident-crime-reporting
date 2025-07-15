<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentRequest\DocumentRequestStaffController;
use App\Http\Controllers\DocumentRequest\DocumentRequestAdminController;

Route::prefix('documentRequest')->middleware('auth')->group(function () {
    // ================= STAFF =================
    Route::prefix('staffRequest')
        ->middleware('check.role:document_request,staff')
        ->name('request.staff.')
        ->group(function () {
        Route::get('/staffDashboard', [DocumentRequestStaffController::class, 'staffDashboard'])->name('staffDashboard');
        Route::get('/StaffReviewRequests', [DocumentRequestStaffController::class, 'viewRequests'])->name('viewRequests');
        Route::get('/StaffApprove/{id}', [DocumentRequestStaffController::class, 'approve'])->name('approve');
        });

    // ================= ADMIN =================
    Route::prefix('adminRequest')
        ->middleware('check.role:document_request,admin')
        ->name('request.admin.')
        ->group(function () {
        Route::get('/adminDashboard', [DocumentRequestAdminController::class, 'adminDashboard'])->name('adminDashboard');
        Route::get('/manageRoles', [DocumentRequestAdminController::class, 'manageRoles'])->name('manageRoles');
        });
});
