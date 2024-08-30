<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Meeting;
use Carbon\Carbon;

class MeetingController extends Controller
{
    // Show the list of all approved adoption requests
    public function showApprovedAdoptionRequests()
    {
        // Get all approved adoption requests with the related animal data
        $approvedRequests = AdoptionRequest::with('animalProfile')->where('approved', true)->get();

        // Return the view with the approved requests
        return view('admin.Meeting', compact('approvedRequests'));
    }

    // Show the form to schedule a meeting
    public function showScheduleMeetingForm($id)
    {
        // Get the specific approved adoption request
        $adoptionRequest = AdoptionRequest::findOrFail($id);

        // Return the view with the adoption request data
        return view('admin.ScheduleMeeting', compact('adoptionRequest'));
    }

    // Handle the scheduling of the meeting
    public function scheduleMeeting(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'adoption_request_id' => 'required|exists:adoption_requests,id',
            'meeting_date' => 'required|date',
        ]);

        // Create a new meeting
        $meeting = new Meeting();
        $meeting->adoption_request_id = $request->input('adoption_request_id');
        $meeting->meeting_date = $request->input('meeting_date');
        $meeting->status = 'Scheduled';
        $meeting->save();

        // Redirect to the meetings list with a success message
        return redirect()->route('admin.meetings.list')->with('success', 'Meeting scheduled successfully.');
    }

    // View all scheduled meetings
    public function viewMeetings()
    {
        // Get all meetings with their related adoption requests
        $meetings = Meeting::with('adoptionRequest.animalProfile')->get();

        // Return the view with the meetings data
        return view('admin.MeetingsList', compact('meetings'));
    }

    // Fetch events for a specific date
    public function fetchEventsForDate(Request $request)
    {
        $date = $request->query('date');
        $meetings = Meeting::whereDate('meeting_date', $date)
                           ->with('adoptionRequest.animalProfile')
                           ->get();

        return response()->json($meetings);
    }

    // View the list of all appointments
    public function viewAppointmentList()
    {
        // Retrieve all scheduled appointments with related adoption request data
        $appointments = Meeting::with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                               ->orderBy('meeting_date', 'asc')
                               ->get();

        // Return the view with the appointments
        return view('admin.AppointmentList', compact('appointments'));
    }

    // Method to fetch appointments by date
    public function getAppointmentsByDate(Request $request)
    {
        // Validate the incoming date
        $date = $request->query('date');

        // Fetch meetings scheduled for the selected date
        $appointments = Meeting::whereDate('meeting_date', $date)
                               ->with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                               ->get();

        // Return the appointments as JSON
        return response()->json($appointments);
    }

    public function getAllAppointments()
    {
        $appointments = Meeting::with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                                ->orderBy('meeting_date', 'asc')
                                ->get();
                                
        return response()->json($appointments);
    }

}
