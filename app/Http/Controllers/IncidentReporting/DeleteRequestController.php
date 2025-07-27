<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\IncidentReportUser;
use RealRashid\SweetAlert\Facades\Alert;

class DeleteRequestController extends Controller
{
    /**
     * Display a paginated list of all delete requests.
     */
    public function index()
    {
        $deleteRequests = DeleteRequest::with(['user', 'report'])
            ->latest()
            ->paginate(10);

        return view('incidentReporting.staffReport.staffDeletionRequests', compact('deleteRequests'));
    }

    /**
     * Show a single report related to a delete request.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $report = IncidentReportUser::with(['user', 'reportImages'])
            ->findOrFail($id);

        return view('incidentReporting.staffReport.staffDeletionRequests', compact('report'));
    }

    /**
     * Accept a delete request and delete the associated report.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($id)
    {
        $deleteRequest = DeleteRequest::findOrFail($id);
        $report = $deleteRequest->report;

        if ($report) {
            $report->delete(); // or use $report->forceDelete() if not using soft deletes
        }

        $deleteRequest->status = 'accepted';
        $deleteRequest->save();

        Alert::success('Accepted', 'The delete request has been approved and the report deleted.');
        return redirect()->back();
    }

    /**
     * Reject a delete request without deleting the report.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($id)
    {
        $deleteRequest = DeleteRequest::findOrFail($id);
        $deleteRequest->status = 'rejected';
        $deleteRequest->save();

        Alert::info('Rejected', 'The delete request has been rejected.');
        return redirect()->back();
    }
}
