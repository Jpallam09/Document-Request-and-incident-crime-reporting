<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\EditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;


class IncidentReportStaffController extends Controller
{
    /**
     * Show the staff dashboard.
     */
    public function dashboard()
    {
        // Count all incident reports, regardless of status
        $totalIncidentReports = IncidentReportUser::count();
        // Get the total count of all pending delete requests
        $totalPendingDeleteRequests = DeleteRequest::where('status', 'pending')
            ->count();
        // Get the all pending edit request
        $totalPendingEditRequests = EditRequest::where('status', 'pending')
            ->count();

        // Pass it to the dashboard view
        return view('incidentReporting.staffReport.staffDashboard', [
            'totalPendingDeleteRequests' => $totalPendingDeleteRequests,
            'totalPendingEditRequests' => $totalPendingEditRequests,
            'totalIncidentReports' => $totalIncidentReports,
        ]);
    }
    /**
     * Get the monthly report trend.
     */
    public function getMonthlyReportTrend(): JsonResponse
    {
        $currentYear = Carbon::now()->year;

        // Get counts grouped by month (Jan to Dec)
        $reportCounts = DB::table('incident_report_users')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Build complete 12-month list with zero-fill
        $labels = [];
        $data = [];
        foreach (range(1, 12) as $month) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $data[] = $reportCounts[$month] ?? 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
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

    public function staffUpdateRequests()
    {
        $reports = IncidentReportUser::latest()->get();
        return view('incidentReporting.staffReport.staffUpdateRequests', compact('reports'));
    }
}
