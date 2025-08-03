<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\EditRequest;



class IncidentReportStaffController extends Controller
{
    /**
     * Show the staff dashboard.
     */
    public function dashboard()
    {
        // Count all incident reports, regardless of status
        $totalIncidentReports = IncidentReportUser::count();
        // Get the total count of all pending delete requests
        $totalPendingDeleteRequests = DeleteRequest::where('status', 'pending')
            ->count();
        // Get the all pending edit request 
        $totalPendingEditRequests =EditRequest::where('status', 'pending')
            ->count();

        // Pass it to the dashboard view
        return view('incidentReporting.staffReport.staffDashboard', [
            'totalPendingDeleteRequests' => $totalPendingDeleteRequests,
            'totalPendingEditRequests' => $totalPendingEditRequests,
            'totalIncidentReports' => $totalIncidentReports,
        ]);
    }

    /**
     * View all submitted reports.
     */
    public function staffReportView()
    {
        $reports = IncidentReportUser::latest()->get();

        return view('incidentReporting.staffReport.staffReportView', compact('reports'));
    }

    /**
     * Show a single report.
     */
    public function staffViewReportsFullDetails($id)
    {
        $report = IncidentReportUser::with('images', 'user')->findOrFail($id);

        return view('incidentReporting.staffReport.staffViewReportsFullDetails', compact('report'));
    }

    public function staffUpdateRequests()
    {
        $reports = IncidentReportUser::latest()->get();
        return view('incidentReporting.staffReport.staffUpdateRequests', compact('reports'));
    }
}
