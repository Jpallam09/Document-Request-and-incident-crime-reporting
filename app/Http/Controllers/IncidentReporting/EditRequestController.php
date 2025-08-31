<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\ReportUser\EditRequestStatusNotification;
use Illuminate\Http\Request;

class EditRequestController extends Controller
{
    /**
     * Show all edit requests for staff (paginated)
     */
    public function index()
    {
        $editRequests = EditRequest::with(['user', 'report.images'])
            ->whereIn('status', ['pending', 'rejected', 'approved'])
            ->latest()
            ->paginate(10);

        return view('incidentReporting.staffReport.staffUpdateRequests', [
            'requests' => $editRequests,
        ]);
    }

    /**
     * Show a single edit request (for standalone page)
     */
    public function show($id)
    {
        $request = EditRequest::with(['user', 'report'])->findOrFail($id);
        $report = $request->report; // original report

        return view('incidentReporting.staffReport.staffShowEditRequest', compact('request', 'report'));
    }

    /**
     * Accept an edit request and apply changes
     */
    public function accept($id)
    {
        $editRequest = EditRequest::with('report.images', 'user')->findOrFail($id);

        if ($editRequest->status !== 'pending') {
            Alert::warning('This request has already been processed.', 'Error')->autoClose(3000);
            return back();
        }

        $report = $editRequest->report;

        // ✅ Apply requested changes only if provided
        $report->update([
            'report_title'       => $editRequest->requested_title       ?? $report->report_title,
            'report_date'        => $editRequest->requested_report_date ?? $report->report_date,
            'report_type'        => $editRequest->requested_type        ?? $report->report_type,
            'report_description' => $editRequest->requested_description ?? $report->report_description,
            'latitude'           => $editRequest->requested_latitude    ?? $report->latitude,
            'longitude'          => $editRequest->requested_longitude   ?? $report->longitude,
        ]);

        // ✅ Handle requested images
        if (!empty($editRequest->requested_image)) {
            $images = is_string($editRequest->requested_image)
                ? json_decode($editRequest->requested_image, true)
                : $editRequest->requested_image;

            if (is_array($images)) {
                // remove old images
                $report->images()->delete();

                // add new images
                foreach ($images as $imagePath) {
                    $report->images()->create([
                        'file_path' => $imagePath,
                    ]);
                }
            }
        }

        // ✅ Update the edit request
        $editRequest->update([
            'status'       => 'approved',
            'reviewed_by'  => auth()->id(),
            'reviewed_at'  => now(),
        ]);

        // ✅ Notify the user
        if ($editRequest->user) {
            $editRequest->user->notify(new EditRequestStatusNotification($editRequest, 'approved'));
        }

        Alert::success('Edit request accepted and applied successfully.', 'Success')->autoClose(3000);

        return redirect()->route('reporting.staff.staffUpdateRequests'); // go back to list instead of same page
    }

    /**
     * Reject an edit request
     */
    public function reject($id)
    {
        $editRequest = EditRequest::findOrFail($id);

        if ($editRequest->status !== 'pending') {
            Alert::toast('This request has already been processed.', 'error')->autoClose(3000);
            return back();
        }

        $editRequest->status = 'rejected';
        $editRequest->reviewed_by = auth()->id();
        $editRequest->reviewed_at = now();
        $editRequest->save();

        $editRequest->user->notify(new EditRequestStatusNotification($editRequest, 'rejected'));

        // ✅ Use SweetAlert "error" type so it shows a red ❌ icon
        Alert::error('Edit Request Rejected', 'The request has been rejected successfully.')->autoClose(3000);

        return back();
    }
}
