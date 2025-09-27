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
        $totalDeleteRequests = DeleteRequest::where('status', 'pending')->count();

        $deleteRequests = DeleteRequest::with(['user', 'report.images'])
            ->whereIn('status', ['pending', 'rejected'])
            ->latest()
            ->paginate(10);

        return view('incident-reporting.staff-report.staff-delete-tbl', [
            'deleteRequests' => $deleteRequests,
            'totalDeleteRequests' => $totalDeleteRequests,
        ]);
    }

    /**
     * Show a single delete request (standalone page)
     */
    public function show($id)
    {
        // Eager load relationships:
        // - user who submitted the delete request
        // - the report itself + its images
        $request = DeleteRequest::with(['user', 'report.images'])->findOrFail($id);

        return view('incident-reporting.staff-report.staff-show-delete-request', compact('request'));
    }

    /**
     * Accept a delete request and delete the associated report.
     */
    public function accept($id)
    {
        $deleteRequest = DeleteRequest::with('report')->findOrFail($id);

        if ($deleteRequest->status !== 'pending') {
            Alert::warning('Already Reviewed', 'This request was already ' . $deleteRequest->status . '.');
            return redirect()->back();
        }

        $report = $deleteRequest->report;
        if ($report) {
            $report->delete();
        }

        $deleteRequest->status = 'approved';
        $deleteRequest->reviewed_at = now();
        $deleteRequest->save();

        $deleteRequest->user->notify(new DeleteRequestStatusNotification($deleteRequest, 'approved'));

        Alert::success('Accepted', 'The delete request has been approved and the report deleted.');
        return redirect()->back();
    }

    /**
     * Reject a delete request without deleting the report.
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
