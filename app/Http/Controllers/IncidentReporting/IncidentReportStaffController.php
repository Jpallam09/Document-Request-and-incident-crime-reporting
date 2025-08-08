<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\EditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IncidentReportStaffController extends Controller
{
    /**
     * Show the staff dashboard.
     */
    public function dashboard()
    {
        $totalIncidentReports = IncidentReportUser::count();
        $totalPendingDeleteRequests = DeleteRequest::where('status', 'pending')->count();
        $totalPendingEditRequests = EditRequest::where('status', 'pending')->count();
        $user = Auth::user();

        return view('incidentReporting.staffReport.staffDashboard', [
            'totalPendingDeleteRequests' => $totalPendingDeleteRequests,
            'totalPendingEditRequests' => $totalPendingEditRequests,
            'totalIncidentReports' => $totalIncidentReports,
        ]);
    }
    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications->firstWhere('id', $id);
        if (!$notification) {
            abort(404);
        }

        $notification->markAsRead();
        return back();
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
     * Get the Report Type Distribution Chart
     */
    public function getReportTypeChart(): JsonResponse
    {
        // Query to count number of reports per type
        $rawCounts = DB::table('incident_report_users')
            ->select('report_type', DB::raw('count(*) as total'))
            ->groupBy('report_type')
            ->pluck('total', 'report_type'); // result: ['Safety' => 10, 'Security' => 5, ...]

        // Ensure all report types are always present, even if 0
        $types = ['Safety', 'Security', 'Operational', 'Environmental'];
        $labels = [];
        $data = [];

        foreach ($types as $type) {
            $labels[] = $type;
            $data[] = $rawCounts[$type] ?? 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    /**
     * notification for new reports.
     */
    public function notifications()
    {
        $notifications = Auth::user()->notifications; // all notifications
        $unread = Auth::user()->unreadNotifications;  // only unread

        return view('incidentReporting.staffReport.notifications', compact('notifications', 'unread'));
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
