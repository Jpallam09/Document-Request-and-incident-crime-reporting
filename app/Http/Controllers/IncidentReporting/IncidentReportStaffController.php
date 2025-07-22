<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use App\Models\IncidentReporting\EditRequest;
use Illuminate\Support\Facades\Log;

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
    // Accept or reject edit requests
public function accept($id)
{
    $editRequest = EditRequest::where('incident_report_id', $id)->firstOrFail();

    if ($editRequest->status !== 'pending') {
        return back()->with('error', 'This request has already been processed.');
    }

    $editRequest->update([
        'status' => 'accepted',
        'reviewed_by' => auth()->id(),
        'reviewed_at' => now(),
    ]);

    return back()->with('success', 'Edit request accepted successfully.');
}
//reject edit requests
public function reject($id)
{
    $editRequest = EditRequest::findOrFail($id);

    if ($editRequest->status !== 'pending') {
        return back()->with('error', 'This request has already been processed.');
    }

    $editRequest->status = 'rejected';
    $editRequest->reviewed_by = auth()->id();
    $editRequest->reviewed_at = now();
    $editRequest->save();

    return back()->with('success', 'Edit request rejected successfully.');
}
    /**
     * Show deletion requests.
     */
    public function staffDeletionRequests()
    {
        $reports = IncidentReportUser::latest()->get();
        return view('incidentReporting.staffReport.staffDeletionRequests', compact('reports'));
    }

    public function staffUpdateRequests()
    {
        $reports = IncidentReportUser::latest()->get();
        return view('incidentReporting.staffReport.staffUpdateRequests', compact('reports'));
    }

}
