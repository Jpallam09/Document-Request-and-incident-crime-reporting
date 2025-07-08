<?php

namespace App\Http\Controllers;

use App\Models\IncidentReportUser;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class IncidentReportUserController extends Controller
{
    /**
     * Display user dashboard with all reports.
     */
    public function dashboard(): View
    {
        $reports = IncidentReportUser::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.report.userDashboardReporting', compact('reports'));
    }
    /**
     * Display the details of a single report.
     */
    public function viewReport($id)
    {
        $report = IncidentReportUser::find($id);
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
     */public function store(Request $request)
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
            $report->images()->create(['file_path' => $path]);
        }
    }

    return redirect()->route('user.report.userIncidentReporting.index')
                     ->with('success', 'Incident report submitted successfully.');
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
    public function edit(IncidentReportUser $incidentReportUser): View
    {
        return view('user.report.editReports', compact('incidentReportUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentReportUser $incidentReportUser): RedirectResponse
    {
        // Placeholder update logic
        return redirect()->back()->with('message', 'Update functionality not implemented yet.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentReportUser $incidentReportUser): RedirectResponse
    {
        // Placeholder delete logic
        return redirect()->back()->with('message', 'Delete functionality not implemented yet.');
    }
}
