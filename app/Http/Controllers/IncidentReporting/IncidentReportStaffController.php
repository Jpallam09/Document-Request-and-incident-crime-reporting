<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use Illuminate\Http\Request;

class IncidentReportStaffController extends Controller
{
    /**
     * Show the staff dashboard.
     */
    public function dashboard()
    {
        return view('incidentReporting.staffReport.staffDashboard');
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
    /**
     * Show deletion requests.
     */
    public function staffDeletionRequests()
    {
        return view('incidentReporting.staffReport.staffDeletionRequests');
    }

    public function staffUpdateRequests()
    {
        return view('incidentReporting.staffReport.staffUpdateRequests');
    }

}
