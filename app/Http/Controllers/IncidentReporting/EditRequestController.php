<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\EditRequest;

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
    $editRequest->status = 'approved'; // ✅ wrapped in quotes — correct
    $editRequest->reviewed_by = auth()->id();
    $editRequest->reviewed_at = now(); // ✅ add this line
    $editRequest->save();

    return back()->with('success', 'Edit request accepted.');
}
    public function reject($id)
{
    // Find the edit request by ID
    $editRequest = EditRequest::findOrFail($id);

    // Optional: Check if the request is still pending
    if ($editRequest->status !== 'pending') {
        return back()->with('error', 'This request has already been processed.');
    }

    // Mark it as rejected
    $editRequest->status = 'rejected';
    $editRequest->reviewed_by = auth()->id(); // Optional: who rejected it
    $editRequest->reviewed_at = now();        // Optional: when it was rejected
    $editRequest->save();

    return back()->with('success', 'Edit request rejected successfully.');
}

}
