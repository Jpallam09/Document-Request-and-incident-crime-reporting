<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\IncidentReportUser;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\ReportUser\DeleteRequestStatusNotification;


class DeleteRequestController extends Controller
{
    /**
     * Display a paginated list of all delete requests.
     */
    public function index()
    {
        // Count only delete requests where status is 'pending'
        $totalDeleteRequests = DeleteRequest::where('status', 'pending')->count();
        // Fetch deletion requests with relationships and filtering
        $deleteRequests = DeleteRequest::with(['user', 'report'])
            ->whereIn('status', ['pending', 'rejected'])
            ->latest()
            ->paginate(10);
        // Get count of all delete requests
        return view('incidentReporting.staffReport.staffDeletionRequests', [
            'deleteRequests' => $deleteRequests,
            'totalDeleteRequests' => $totalDeleteRequests,
        ]);
    }

    /**
     * Show a single report related to a delete request.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $report = IncidentReportUser::with(['user', 'images'])
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

        if ($deleteRequest->status !== 'pending') {
            Alert::warning('Already Reviewed', 'This request was already ' . $deleteRequest->status . '.');
            return redirect()->back();
        }

        $report = $deleteRequest->report;

        if ($report) {
            $report->delete();
        }

        $deleteRequest->status = 'accepted';
        $deleteRequest->reviewed_at = now();
        $deleteRequest->save();

        $deleteRequest->user->notify(new DeleteRequestStatusNotification($deleteRequest, 'accepted'));

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

        if ($deleteRequest->status !== 'pending') {
            Alert::warning('Already Reviewed', 'This request was already ' . $deleteRequest->status . '.');
            return redirect()->back();
        }

        $deleteRequest->status = 'rejected';
        $deleteRequest->reviewed_at = now();
        $deleteRequest->save();

        $deleteRequest->user->notify(new DeleteRequestStatusNotification($deleteRequest, 'rejected'));

        Alert::info('Rejected', 'The delete request has been rejected.');
        return redirect()->back();
    }
}
