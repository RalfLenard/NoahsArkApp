<!DOCTYPE html>
<html>
<head>
    <title>Schedule Meeting</title>
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="/admin/assets/css/custom.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Schedule Meeting for Adoption Request #{{ $adoptionRequest->id }}</h2>
                        <form action="{{ route('admin.schedule.meeting') }}" method="POST">
                            @csrf
                            <input type="hidden" name="adoption_request_id" value="{{ $adoptionRequest->id }}">
                            <div class="form-group">
                                <label for="meeting_date">Meeting Date:</label>
                                <input type="datetime-local" name="meeting_date" id="meeting_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Schedule Meeting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/admin/assets/js/jquery-1.10.2.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
</body>
</html>
