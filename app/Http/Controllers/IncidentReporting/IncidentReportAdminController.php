<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncidentReportAdminController extends Controller
{
        public function dashboard()
    {
        return view('incidentReporting.adminReport.adminDashboard');
    }
}
