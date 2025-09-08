<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use App\Models\IncidentReporting\IncidentReportUser;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\IncidentReporting\IncidentReportImage;
use App\Models\IncidentReporting\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\IncidentReporting\DeleteRequest;
use App\Models\User;
use App\Notifications\NewReportNotification;
use App\Notifications\EditRequestNotification;
use App\Notifications\DeleteRequestNotification;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


class IncidentReportUserController extends Controller
{
    /**
     * Display user dashboard with all reports.
     */
    public function index(): View
    {
        $userId = auth()->id();

        // Fetch all reports for counts
        $allReports = IncidentReportUser::where('user_id', $userId)->get();
        $editRequests = editRequest::where('user_id', $userId)->get();
        $deleteReports = deleteRequest::where('user_id', $userId)->get();

        // Counts for widgets
        $totalReports    = $allReports->count();
        $pendingReports  = $allReports->where('report_status', 'pending')->count();
        $successReports  = $allReports->where('report_status', 'success')->count();
        $canceledReports = $allReports->where('report_status', 'canceled')->count();
        $editRequest = $editRequests->where('status', 'pending')->count();
        $deleteRequest = $deleteReports->where('status', 'pending')->count();

        // Latest reports for table/pagination
        $reports = IncidentReportUser::where('user_id', $userId)
            ->latest()
            ->paginate(5);

        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('user.report.userDashboardReporting', compact(
            'reports',
            'unreadNotifications',
            'totalReports',
            'pendingReports',
            'successReports',
            'canceledReports',
            'editRequest',
            'deleteRequest'

        ));
    }

    /**
     * Display the details of a single report.
     */
    public function viewReport($id)
    {
        $report = IncidentReportUser::with(['editRequest', 'deleteRequest']) // request
            ->where('user_id', auth()->id())
            ->find($id);

        if (!$report) {
            abort(404, 'Report not found.');
        }

        return view('user.report.viewReports', compact('report'));
    }

    /**
     * Show the form for creating new report
     */
    public function create(): View
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $notifications = auth()->user()->notifications;

        return view('user.report.userIncidentReporting', compact('unreadNotifications', 'notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $validated = $request->validate([
            'report_title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_type'   => ['required', Rule::in(IncidentReportUser::$types)],
            'report_description' => 'required|string',
            'barangay' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'report_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:40960', // 40MB max
        ]);

        // Check max 5 images
        if ($request->hasFile('report_image') && count($request->file('report_image')) > 5) {
            Alert::error('Too Many Images', 'You can upload a maximum of 5 images only.');
            return redirect()->back()->withInput();
        }

        // 2️⃣ Save the report
        $report = new IncidentReportUser();
        $report->user_name = auth()->user()->user_name;
        $report->report_title = $validated['report_title'];
        $report->report_date = $validated['report_date'];
        $report->report_type = $validated['report_type'];
        $report->report_description = $validated['report_description'];
        $report->barangay = $validated['barangay'] ?? null;
        $report->latitude = $validated['latitude'] ?? null;
        $report->longitude = $validated['longitude'] ?? null;
        $report->report_status      = 'pending';
        $report->user_id = auth()->id();
        $report->save();

        // 3️⃣ Save images
        if ($request->hasFile('report_image')) {
            foreach ($request->file('report_image') as $imageFile) {
                $path = $imageFile->store('incident_images', 'public');
                $report->images()->create(['file_path' => $path]);
            }
        }

        // 4️⃣ Notify staff/admin
        $staffMembers = User::whereHas('roles', function ($query) {
            $query->where('app', 'incident_reporting')
                ->whereIn('role', ['staff', 'admin']);
        })->get();

        foreach ($staffMembers as $staff) {
            $staff->notify(new NewReportNotification($report));
        }


        Alert::success('Submitted', 'Your report has been submitted successfully.');
        return redirect()->route('user.report.userIncidentReporting.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = IncidentReportUser::with(['images', 'editRequest'])->findOrFail($id);

        if (auth()->id() !== $report->user_id) {
            abort(403);
        }

        if ($report->editRequest && $report->editRequest->status === 'pending') {
            Alert::error('Pending Request', 'You already have a pending edit request for this report.');
            // Redirect to a safe page to avoid redirect loop
            return redirect()->route('user.report.viewReports', $id);
        }

        return view('user.report.editReports', compact('report'));
    }
    /**
     * Request an edit to the report.
     */

    public function requestUpdate(Request $request, $id)
    {
        // Check existing pending request
        $existingEditRequest = EditRequest::where('edit_report_id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($existingEditRequest) {
            Alert::error('Duplicate Request', 'You already sent an edit request for this report.');
            return redirect()->back();
        }

        // Validate form
        $validated = $request->validate([
            'title' => 'required|string',
            'requested_report_date' => 'required|date',
            'incident_type' => 'required|string',
            'incident_description' => 'required|string',
            'barangay' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'requested_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:40960', // 40MB max
        ]);

        // ✅ Add SweetAlert max images check here
        if ($request->hasFile('requested_image') && count($request->file('requested_image')) > 5) {
            Alert::error('Too Many Images', 'You can upload a maximum of 5 images only.');
            return redirect()->back()->withInput();
        }

        // Handle images
        $imagePaths = [];
        if ($request->hasFile('requested_image')) {
            foreach ($request->file('requested_image') as $imageFile) {
                $path = $imageFile->store('edit_request_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create edit request
        $editRequest = EditRequest::create([
            'edit_report_id' => $id,
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->user_name,
            'requested_title' => $validated['title'],
            'requested_description' => $validated['incident_description'],
            'requested_type' => $validated['incident_type'],
            'requested_report_date' => $validated['requested_report_date'],
            'requested_barangay' => $request->barangay ?? null,
            'requested_latitude' => $request->latitude ?? null,
            'requested_longitude' => $request->longitude ?? null,
            'requested_image' => $imagePaths,
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        // Notify staff/admin
        $staffMembers = User::whereHas('roles', function ($query) {
            $query->where('app', 'incident_reporting')
                ->whereIn('role', ['staff', 'admin']);
        })->get();

        foreach ($staffMembers as $staff) {
            $staff->notify(new EditRequestNotification($editRequest));
        }

        Alert::success('Success', 'Update request sent successfully.');
        return back();
    }

    //handles delete requests
    public function requestDelete(IncidentReportUser $incidentReportUser): RedirectResponse
    {
        // Ensure the report belongs to the currently authenticated user
        if ($incidentReportUser->user_id !== Auth::id()) {
            Alert::error('Unauthorized', 'You are not allowed to request deletion for this report.');
            return redirect()->back();
        }

        // Check if a delete request for this report already exists
        $existingRequest = DeleteRequest::where('delete_report_id', $incidentReportUser->id) // instead of report_id
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();


        if ($existingRequest) {
            Alert::error('Duplicate Request', 'You already sent a delete request for this report.');
            return redirect()->back();
        }

        // Create a new delete request with snapshot data
        $deleteRequest = DeleteRequest::create([
            'user_id' => Auth::id(),
            'delete_report_id' => $incidentReportUser->id,
            'user_name' => Auth::user()->user_name,
            'report_title' => $incidentReportUser->report_title,
            'report_date' => $incidentReportUser->report_date,
            'report_type' => $incidentReportUser->report_type,
            'report_description' => $incidentReportUser->report_description,
            'requested_image' => $incidentReportUser->images->pluck('file_path')->toArray(), // Optional: include image paths
            'reason' => 'User requested to delete the report.',
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        // Notify all staff/admin in incident_reporting about the delete request
        $staffMembers = User::whereHas('roles', function ($query) {
            $query->where('app', 'incident_reporting')
                ->whereIn('role', ['staff', 'admin']);
        })->get();

        foreach ($staffMembers as $staff) {
            $staff->notify(new DeleteRequestNotification($deleteRequest));
        }

        Alert::success('Request Sent', 'Your delete request has been submitted.');
        return redirect()->back();
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->firstWhere('id', $id);
        if (!$notification) {
            abort(404);
        }

        $notification->markAsRead();
        $data = $notification->data;

        if (isset($data['edit_request_id'])) {
            $editRequest = EditRequest::find($data['edit_request_id']);
            if ($editRequest) {
                return redirect()->route('user.report.viewReports', $editRequest->edit_report_id);
            }
        }

        if (isset($data['delete_request_id'])) {
            $deleteRequest = DeleteRequest::find($data['delete_request_id']);

            if ($deleteRequest) {
                if ($deleteRequest->status === 'accepted') {
                    return redirect()->route('user.report.userDashboardReporting');
                } elseif ($deleteRequest->status === 'rejected') {
                    Alert::error('Rejected', 'Your delete request has been rejected.');
                    return redirect()->route('user.report.viewReports', $deleteRequest->delete_report_id);
                }
            }
        }

        // ✅ Redirect to report page if report_id exists
        if (isset($data['report_id'])) {
            return redirect()->route('user.report.viewReports', $data['report_id']);
        }

        // Last fallback (if absolutely no report found)
        return redirect()->route('user.report.userDashboardReporting');
    }
}
