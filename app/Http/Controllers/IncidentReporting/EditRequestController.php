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
        $requests = EditRequest::with(['user', 'report'])->latest()->get();

        // Pass the collection to the view — you’ll loop over it in the Blade file
        return view('incidentReporting.staffReport.staffUpdateRequests', compact('requests'));
    }

    public function accept($id)
    {
        $editRequest = EditRequest::findOrFail($id);

        if ($editRequest->status !== 'pending') {
            Alert::toast('This request has already been processed.', 'error')->autoClose(3000);
            return back();
        }

        $editRequest->status = 'accepted';
        $editRequest->reviewed_by = auth()->id();
        $editRequest->reviewed_at = now();
        $editRequest->save();

        Alert::toast('Edit request accepted successfully.', 'success')->autoClose(3000);
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
