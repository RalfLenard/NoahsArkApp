<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimalProfileController;
use App\Http\Controllers\AnimalAbuseReportController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\MeetingController;

//home page controller
Route::get('/home', [HomeController::class, 'homepage']);


// Animal profile uploading
// Route to show the form for creating a new animal profile
Route::get('/animal-profiles/create', [AnimalProfileController::class, 'create'])->name('admin.uploading-animal-profile');

// Route to store a newly created animal profile
Route::post('/animal-profiles', [AnimalProfileController::class, 'store'])->name('admin.store-animal-profile');

// Route to list all animal profiles
Route::get('/animal-profiles', [AnimalProfileController::class, 'list'])->name('admin.animal-profile-list');

// delete animal
Route::get('/delete-animal/{id}', [AnimalProfileController::class, 'deleteanimal']);

// update animal
Route::get('/update-animal/{id}', [AnimalProfileController::class, 'updateanimal']);


// Animal view profile
Route::get('/animals/{id}', [HomeController::class, 'show'])->name('animals.show');



//adoption
Route::get('/adopt/{animalprofile}/request', [AdoptionRequestController::class, 'showAdoptionForm'])->name('adopt.show');

Route::post('/adopt/{id}/request', [AdoptionRequestController::class, 'submitAdoptionRequest'])->name('adoption.submit');

Route::get('/adoption-requests', [AdoptionRequestController::class, 'submitted'])->name('admin.adoption.requests');

Route::post('adoption-request/{id}/approve', [AdoptionRequestController::class, 'approveAdoption'])->name('admin.adoption.approve');
Route::delete('adoption-request/{id}/reject', [AdoptionRequestController::class, 'rejectAdoption'])->name('admin.adoption.reject');



// animal report
// Route to show the form for creating a new animal abuse report
Route::get('/report/abuse', [AnimalAbuseReportController::class, 'create'])->name('report.abuse.form');

// Route to store the submitted animal abuse report
Route::post('/report-abuse', [AnimalAbuseReportController::class, 'store'])->name('report.abuse.store');

// Route to display a listing of animal abuse reports for admin
Route::get('/animal-abuse-reports', [AnimalAbuseReportController::class, 'index'])->name('admin.animal-abuse-reports');


// meeting
// Display approved adoption requests
Route::get('/approved-requests', [MeetingController::class, 'showApprovedAdoptionRequests'])->name('admin.approved.requests');

// Show the form to schedule a meeting
Route::get('/schedule-meeting/{id}', [MeetingController::class, 'showScheduleMeetingForm'])->name('admin.schedule.meeting.form');

// Handle scheduling of the meeting
Route::post('/schedule-meeting', [MeetingController::class, 'scheduleMeeting'])->name('admin.schedule.meeting');

// View all scheduled meetings
Route::get('/meetings', [MeetingController::class, 'viewMeetings'])->name('admin.meetings.list');

Route::get('/meetings/events', [MeetingController::class, 'fetchEventsForDate'])->name('admin.meetings.events');

Route::get('/appointments', [MeetingController::class, 'viewAppointmentList'])->name('admin.appointments.list');

// Route to fetch appointments for a specific date
Route::get('/appointments/by-date', [MeetingController::class, 'getAppointmentsByDate'])->name('admin.appointments.byDate');

// Route to get all appointments
Route::get('/appointments/all', [MeetingController::class, 'getAllAppointments'])->name('admin.appointments.all');















Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});