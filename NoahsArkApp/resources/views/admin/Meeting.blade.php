<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Adoption Requests</title>
    <!-- Bootstrap and Custom CSS -->
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/admin/assets/css/font-awesome.css" rel="stylesheet">
    <link href="/admin/assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Approved Adoption Requests</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                   
                    <th>Adopter Name</th>
                    <th>Animal Name</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($approvedRequests as $request)
                    <tr>
                       
                        <td>{{ $request->user->name ?? 'N/A' }}</td>
                        <td>{{ $request->animalProfile->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.schedule.meeting.form', ['id' => $request->id]) }}" class="btn btn-primary">
                            Schedule Meeting
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No approved adoption requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    @include('admin.AppointmentList')

    <!-- Scripts -->
    <script src="/admin/assets/js/jquery-1.10.2.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
</body>
</html>
