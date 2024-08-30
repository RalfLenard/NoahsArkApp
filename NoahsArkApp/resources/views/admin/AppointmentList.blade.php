<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Appointments</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        h2, h4 {
            text-align: center;
        }
        #calendar {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }

        .highlighted-date {
        background-color: #ffeb3b !important; /* Change this to your preferred color */
        border-radius: 5px;
        color: #000;
    </style>
</head>
<body>

<div class="container">
    <h2>Scheduled Meetings</h2>

    <div id="calendar"></div> <!-- Calendar placeholder -->

    <!-- Button to show all appointments -->
    <div class="text-center">
        <button id="show-all-appointments" style="margin: 20px; padding: 10px 20px;">Show All Appointments</button>
    </div>

    <div class="mt-4">
        <h4 id="selected-date-heading">Meetings for <span id="selected-date">All Dates</span></h4>
        <table class="table table-striped" id="appointments-table">
            <thead>
                <tr>
                    <th>Meeting Date</th>
                    <th>Adopter Name</th>
                    <th>Animal Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->meeting_date)->format('d-m-Y H:i') }}</td>
                        <td>{{ $appointment->adoptionRequest->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->adoptionRequest->animalProfile->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery (required for FullCalendar AJAX operations) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var selectedDate = null;

            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dateClick: function(info) {
                    if (selectedDate) {
                        // Remove highlight from previously selected date
                        document.querySelector(`.fc-day[data-date="${selectedDate}"]`).classList.remove('highlighted-date');
                    }

                    selectedDate = info.dateStr;
                    // Add highlight to the currently selected date
                    info.dayEl.classList.add('highlighted-date');
                    
                    fetchAppointmentsForDate(info.dateStr);
                }
            });

            calendar.render();

            // Fetch appointments for the selected date
            function fetchAppointmentsForDate(date) {
                $.ajax({
                    url: '{{ route("admin.appointments.byDate") }}',
                    method: 'GET',
                    data: { date: date },
                    success: function(response) {
                        $('#selected-date').text(date);
                        populateAppointmentsTable(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching appointments:', textStatus, errorThrown);
                        alert('Failed to fetch appointments. Please try again.');
                    }
                });
            }

            // Populate the appointments table
            function populateAppointmentsTable(appointments) {
                var tbody = $('#appointments-table tbody');
                tbody.empty(); // Clear existing rows

                if (appointments.length === 0) {
                    tbody.append('<tr><td colspan="4">No appointments found.</td></tr>');
                } else {
                    // Insert appointment rows
                    $.each(appointments, function(index, appointment) {
                        tbody.append(`
                            <tr>
                                <td>${appointment.meeting_date}</td>
                                <td>${appointment.adoption_request.user ? appointment.adoption_request.user.name : 'N/A'}</td>
                                <td>${appointment.adoption_request.animal_profile ? appointment.adoption_request.animal_profile.name : 'N/A'}</td>
                                <td>${appointment.status}</td>
                            </tr>
                        `);
                    });
                }
            }

            // Show all appointments when the button is clicked
            $('#show-all-appointments').on('click', function() {
                $('#selected-date').text('All Dates');
                $.ajax({
                    url: '{{ route("admin.appointments.all") }}',
                    method: 'GET',
                    success: function(response) {
                        populateAppointmentsTable(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching all appointments:', textStatus, errorThrown);
                        alert('Failed to fetch all appointments. Please try again.');
                    }
                });
            });
        });

</script>

</body>
</html>
