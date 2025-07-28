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
use Illuminate\Support\Arr;

class IncidentReportUserController extends Controller
{
    /**
     * Display user dashboard with all reports.
     */
    public function dashboard(): View
    {
        $reports = IncidentReportUser::where('user_id', auth()
            ->id())
            ->latest()
            ->paginate(5);

        return view('user.report.userDashboardReporting', compact('reports'));
    }
    /**
     * Display the details of a single report.
     */
    public function viewReport($id)
    {
        $report = IncidentReportUser::with(['editRequest']) // request
            ->where('user_id', auth()->id())
            ->find($id);

        if (!$report) {
            abort(404, 'Report not found.');
        }

        return view('user.report.viewReports', compact('report'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reports = IncidentReportUser::where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('user.report.userIncidentReporting', compact('reports'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.report.userIncidentReporting');
    }

    /**
     * Store a newly created resource in storage.
     */ public function store(Request $request)
    {
        $validated = $request->validate([
            'report_title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_type' => 'required|string',
            'report_description' => 'required|string',
            'report_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $report = new IncidentReportUser();
        $report->report_title = $validated['report_title'];
        $report->report_date = $validated['report_date'];
        $report->report_type = $validated['report_type'];
        $report->report_description = $validated['report_description'];
        $report->user_id = auth()->id(); // or set this as needed
        $report->save();

        // Handle images
        if ($request->hasFile('report_image')) {
            foreach ($request->file('report_image') as $image) {
                $path = $image->store('incident_images', 'public');

                // Save to another table if needed, or store in a JSON column
                $report->images()->create([
                    'file_path' => $path,
                ]);
            }
        }
        Alert::success('Submitted', 'Incident report submitted successfully.');
        return redirect()->route('user.report.userIncidentReporting.index');
    }

    public function images()
    {
        return $this->hasMany(IncidentReportImage::class);
    }

    /**
     * Display the specified resource (single-report fallback via resource route).
     */
    public function show(IncidentReportUser $userIncidentReporting): View
    {
        return view('user.report.userDashboardReporting', [
            'reports' => collect([$userIncidentReporting]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = IncidentReportUser::with('images')->findOrFail($id);

        // Make sure the current logged-in user owns this report
        if (auth()->id() !== $report->user_id) {
            abort(403);
        }
        return view('user.report.editReports', compact('report'));
    }
    /**
     * Request an edit to the report.
     */
    public function requestUpdate(Request $request, $id)
    {
        // Validate form fields
        $request->validate([
            'title' => 'required|string',
            'requested_report_date' => 'required|date',
            'incident_type' => 'required|string',
            'incident_description' => 'required|string',
            'requested_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Prepare image paths array
        $imagePaths = [];

        // Handle image uploads (if any)
        if ($request->hasFile('requested_image')) {
            foreach ($request->file('requested_image') as $image) {
                $path = $image->store('edit_request_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create the edit request record
        EditRequest::create([
            'incident_report_id' => $id,
            'requested_by' => auth()->id(),
            'requested_title' => $request->input('title'),
            'requested_description' => $request->input('incident_description'),
            'requested_type' => $request->input('incident_type'),
            'requested_report_date' => $request->input('requested_report_date'),
            'requested_image' => $imagePaths, // ← Just pass the array directly
            'status' => 'pending',
            'requested_at' => now(),
        ]);
        Alert::success('Success', 'Update request sent successfully.');
        return back();
    }

    public function discardUpdateRequest($id)
    {
        $editRequest = EditRequest::where('incident_report_id', $id)
            ->where('requested_by', auth()->id())
            ->where('status', 'pending') // Only allow discarding if still pending
            ->firstOrFail();

        $editRequest->delete();
        Alert::success('Request Discarded', 'Your edit request has been discarded.');
        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentReportUser $incidentReportUser)
    {
        $validated = $request->validate([
            'report_title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_type' => 'required|string',
            'report_description' => 'required|string',
            'report_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'remove_images' => 'array|nullable',
            'remove_images.*' => 'integer|exists:incident_report_images,id',
        ]);

        // Update main fields
        $incidentReportUser->update([
            'report_title' => $validated['report_title'],
            'report_date' => $validated['report_date'],
            'report_type' => $validated['report_type'],
            'report_description' => $validated['report_description'],
        ]);

        // Remove selected images
        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = $incidentReportUser->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->file_path);
                    $image->delete();
                }
            }
        }

        // Upload new images
        if ($request->hasFile('report_image')) {
            foreach ($request->file('report_image') as $image) {
                $path = $image->store('incident_images', 'public');
                $incidentReportUser->images()->create(['file_path' => $path]);
            }
        }
        Alert::success('Updated', 'Report updated successfully.');
        return redirect()->route('user.report.userIncidentReporting.edit', $incidentReportUser->id);
    }


    public function requestDelete(IncidentReportUser $incidentReportUser): RedirectResponse
    {
        // Ensure the report belongs to the currently authenticated user
        if ($incidentReportUser->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Check if a delete request for this report already exists
        $existingRequest = DeleteRequest::where('report_id', $incidentReportUser->id)->first();
        if ($existingRequest) {
            Alert::error('Unauthorized', 'You already sent a delete request.');
            return redirect()->back();
        }
        // Create a new delete request
        DeleteRequest::create([
            'user_id' => Auth::id(),
            'report_id' => $incidentReportUser->id,
            'status' => 'pending',
            'reason' => 'User requested to delete the report.', // optionally set a default or get from form
            'requested_at' => now(),
        ]);
        Alert::success('Request Sent', 'Your delete request has been submitted.');
        return redirect()->back();
    }
}
