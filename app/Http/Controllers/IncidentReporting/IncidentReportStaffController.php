<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\IncidentReporting\EditRequest;
use App\Models\IncidentReporting\StaffLocation;
use App\Notifications\IncidentReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;


class IncidentReportStaffController extends Controller
{

    // Show the track report page
    public function ShowTrackReport($id)
    {
        $report = IncidentReportUser::findOrFail($id);
        return view('incidentReporting.staffReport.staffTrackReport', compact('report'));
    }

    // Receive AJAX location updates
    public function trackReport(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:incident_report_users,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Save or update staff location
        StaffLocation::updateOrCreate(
            [
                'report_id' => $request->report_id,
                'staff_id' => auth()->id()
            ],
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]
        );

        return response()->json(['success' => true]);
    }

    public function successTrack($id)
    {
        $report = IncidentReportUser::findOrFail($id);
        $report->report_status = IncidentReportUser::STATUS_SUCCESS; // 'success'
        $report->save();

        // 🔔 Notify the user
        $report->user->notify(new IncidentReportNotification($report->id, 'success', auth()->user()->user_name));

        Alert::success('Success', 'Report marked as successful.');
        return back();
    }

    public function cancelTrack($id)
    {
        $report = IncidentReportUser::findOrFail($id);
        $report->report_status = IncidentReportUser::STATUS_CANCELED; // 'canceled'
        $report->save();

        // 🔔 Notify the user
        $report->user->notify(new IncidentReportNotification($report->id, 'canceled', auth()->user()->user_name));

        Alert::warning('Canceled', 'Report has been canceled.');
        return back();
    }

    // Export report as PDF
    public function exportPdf($id)
    {
        $report = IncidentReportUser::with('user', 'images')->findOrFail($id);

        $pdf = Pdf::loadView('incidentReporting.staffReport.staffReportPdf', compact('report'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('report_' . $report->id . '.pdf');
    }

    /**
     * Show the staff dashboard.
     */
    public function dashboard()
    {
        $totalIncidentReports = IncidentReportUser::count();
        $totalPendingDeleteRequests = DeleteRequest::where('status', 'pending')->count();
        $totalPendingEditRequests = EditRequest::where('status', 'pending')->count();
        $totalResolvedReports = IncidentReportUser::where('report_status', 'success')->count();
        $totalCanceledReports = IncidentReportUser::where('report_status', 'canceled')->count();

        return view('incidentReporting.staffReport.staffDashboard', [
            'totalPendingDeleteRequests' => $totalPendingDeleteRequests,
            'totalPendingEditRequests' => $totalPendingEditRequests,
            'totalIncidentReports' => $totalIncidentReports,
            'totalResolvedReports' => $totalResolvedReports,
            'totalCanceledReports' => $totalCanceledReports,
        ]);
    }

    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications->firstWhere('id', $id);
        if (!$notification) {
            abort(404);
        }

        $notification->markAsRead();

        // Check notification data and redirect accordingly
        $data = $notification->data;

        // Redirect depending on type of notification
        if (isset($data['report_id'])) {
            // Redirect to specific report details
            return redirect()->route('reporting.staff.staffViewReportsFullDetails', $data['report_id']);
        } elseif (isset($data['edit_request_id'])) {
            // Redirect to specific edit request details
            return redirect()->route('reporting.staff.editRequest.show', $data['edit_request_id']);
        } elseif (isset($data['delete_request_id'])) {
            // Redirect to specific delete request details
            return redirect()->route('reporting.staff.staffDeletionRequests.show', $data['delete_request_id']);
        }

        // Default fallback redirect to dashboard
        return redirect()->route('reporting.staff.dashboard');
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
     * Notification page (if used).
     */
    public function notifications()
    {
        // If you have a specific notifications page
        return view('incidentReporting.staffReport.notifications');
    }

    /**
     * View all submitted reports.
     */
    public function staffReportView()
    {
        $reports = IncidentReportUser::latest()
            ->paginate(10);

        return view('incidentReporting.staffReport.staffReportView', compact('reports'));
    }

    /**
     * Show a single report.
     */
    public function staffViewReportsFullDetails($id)
    {
        $report = IncidentReportUser::with('images', 'user')->findOrFail($id);

        $phoneNumber = $report->user->phone;

        return view('incidentReporting.staffReport.staffViewReportsFullDetails', compact('report'));
    }

    /**
     * Show edit requests.
     */
    public function staffUpdateRequests()
    {
        $reports = IncidentReportUser::latest()->get();

        return view('incidentReporting.staffReport.staffUpdateRequests', compact('reports'));
    }
}
