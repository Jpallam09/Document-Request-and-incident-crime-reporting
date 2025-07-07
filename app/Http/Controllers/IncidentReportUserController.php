<?php

namespace App\Http\Controllers;

use App\Models\IncidentReportUser;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IncidentReportUserController extends Controller
{
    /**
     * Display user dashboard with all reports.
     */
    public function dashboard(): View
    {
        $reports = IncidentReportUser::latest()->get();
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
        $reports = IncidentReportUser::latest()->get();
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
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'report_title'       => 'required|string|min:5|max:150',
            'report_date'        => 'required|date',
            'report_type'        => 'required|in:Safety,Security,Operational,Environmental',
            'report_description' => 'required|string|min:10',
            'report_image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('report_image')) {
            $validated['report_image'] = $request
                ->file('report_image')
                ->store('incident_images', 'public');
        }

        IncidentReportUser::create($validated);

        return redirect()->back()->with('success', 'Report submitted successfully.');
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
