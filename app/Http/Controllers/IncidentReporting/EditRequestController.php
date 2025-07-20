<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\EditRequest;

class EditRequestController extends Controller
{
    // Show all edit requests for staff
    public function index()
    {
        $requests = EditRequest::with(['user', 'report'])->latest()->get();

        return view('incidentReporting.staffReport.staffUpdateRequests', compact('requests'));
    }

}
