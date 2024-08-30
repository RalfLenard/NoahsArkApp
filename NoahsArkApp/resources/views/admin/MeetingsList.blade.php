<!DOCTYPE html>
<html>
<head>
    <title>Scheduled Meetings</title>
    <!-- Bootstrap CSS -->
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="/admin/assets/css/custom.css" rel="stylesheet" />
    
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

    <!-- Inline CSS for Calendar -->
    <style>
        #calendar {
            width: 4.5in; /* Set width to 4.5 inches */
            height: 4.5in; /* Set height to 4.5 inches */
            margin: 0 auto; /* Center the calendar horizontally */
            overflow: hidden; /* Hide any overflow to avoid scroll bars */
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Scheduled Meetings</h2>
                        <!-- Calendar Container -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FullCalendar JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach($meetings as $meeting)
                    {
                        title: 'Meeting for Request #{{ $meeting->adoptionRequest->id }} - {{ $meeting->adoptionRequest->animalProfile->name }}',
                        start: '{{ Carbon\Carbon::parse($meeting->meeting_date)->format('Y-m-d\TH:i:s') }}',
                        url: '{{ route('admin.schedule.meeting.form', ['id' => $meeting->adoptionRequest->id]) }}'
                    },
                    @endforeach
                ],
                editable: true,
                eventClick: function(info) {
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                }
            });
            calendar.render();
        });
    </script>




    <!-- jQuery and Bootstrap JavaScript -->
    <script src="/admin/assets/js/jquery-1.10.2.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
</body>
</html>
