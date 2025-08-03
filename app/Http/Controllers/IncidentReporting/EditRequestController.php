<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;

class EditRequestController extends Controller
{
    // Show all edit requests for staff
    public function index()
    {   
        // Eager-load 'user' and 'report' relationships, return a collection
        $editrequests = EditRequest::with(['user', 'report'])
            ->whereIn('status', ['pending', 'rejected', 'approved'])
            ->latest()
            ->paginate(10);

        // Pass the collection to the view — you’ll loop over it in the Blade file
        return view('incidentReporting.staffReport.staffUpdateRequests', [
            'requests'=> $editrequests,
    ]);
    }

    /**
     * Accept an edit request
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($id)
    {
        /** @var EditRequest $editRequest */
        $editRequest = EditRequest::with('report')->findOrFail($id);

        if ($editRequest->status !== 'pending') {
            Alert::toast('This request has already been processed.', 'error')->autoClose(3000);
            return back();
        }

        $report = $editRequest->report;

        // Apply requested changes to the report
        $report->report_title = $editRequest->requested_title;
        $report->report_date = $editRequest->requested_report_date;
        $report->report_type = $editRequest->requested_type;
        $report->report_description = $editRequest->requested_description;

        // Handle requested images (optional, if you support image editing)
        if (is_array($editRequest->requested_image)) {
            $report->images()->delete(); // Clear previous images first

            foreach ($editRequest->requested_image as $imagePath) {
                $report->images()->create([
                    'file_path' => $imagePath,
                ]);
            }
        }
        $report->save();

        // Mark edit request as approved
        $editRequest->status = 'approved';
        $editRequest->reviewed_by = auth()->id();
        $editRequest->reviewed_at = now();
        $editRequest->save();

        Alert::toast('Edit request accepted and applied successfully.', 'success')->autoClose(3000);
        return back();
    }


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

        Alert::toast('Edit request rejected.', 'error')->autoClose(3000);
        return back();
    }
}
