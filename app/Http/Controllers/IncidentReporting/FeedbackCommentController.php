<?php

namespace App\Http\Controllers\IncidentReporting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedbackComment;
use RealRashid\SweetAlert\Facades\Alert;

class FeedbackCommentController extends Controller
{
    /**
     * User submits feedback.
     * - Validates input.
     * - Stores feedback linked to the authenticated user.
     * - Redirects back with a success flash message (SweetAlert2 will catch it).
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        FeedbackComment::create([
            'user_id' => auth()->id(),
            'report_id' => $id,
            'comment' => $request->comment,
        ]);

        // This will be caught by @include('sweetalert::alert')
        Alert::success('Thank you!', 'Your feedback has been submitted successfully.');

        // Flash message: triggers SweetAlert2 in the view
        return redirect()->back();
    }

    /**
     * User views only their own feedback.
     * - Retrieves feedback linked to the logged-in user.
     * - Passes it to the user feedback view.
     */
    public function myFeedback()
    {
        $feedbacks = FeedbackComment::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('incidentReporting.userFeedback.myFeedback', compact('feedbacks'));
    }

    /**
     * Staff/Admin views all feedback.
     * - Eager loads user relationship to avoid N+1 queries.
     * - Sends data to admin feedback listing view.
     */
    public function index()
    {
        $feedbacks = FeedbackComment::with('user')
            ->latest()
            ->get();

        return view('incidentReporting.adminFeedback.index', compact('feedbacks'));
    }

    /**
     * Staff/Admin views a specific feedback for a report.
     * - Ensures the feedback belongs to the correct report.
     * - Loads the user who made the feedback.
     */
    public function show($report_id, $feedback_id)
    {
        $feedback = FeedbackComment::where('report_id', $report_id)
            ->where('id', $feedback_id)
            ->with('user')
            ->firstOrFail();

        return view('incidentReporting.staffFeedback.show', compact('feedback', 'report_id'));
    }

    /**
     * Staff/Admin deletes a feedback.
     * - Finds the feedback by ID or fails if not found.
     * - Deletes it from database.
     * - Redirects back with success flash message (SweetAlert2 will catch it).
     */
    public function destroy($id)
    {
        $feedback = FeedbackComment::findOrFail($id);
        $feedback->delete();

        // Flash message: triggers SweetAlert2 in the view
        return redirect()->back()->with('success', 'Feedback has been deleted!');
    }
}
