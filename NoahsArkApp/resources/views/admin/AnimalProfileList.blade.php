<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="/admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="/admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 

        @if(Route::has('login'))

                @auth
                <x-app-layout>
    
                </x-app-layout>
                @else
                
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>

                @endauth

                @endif

    </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="/admin/assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a href="{{url('home')}}"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                      
                    <li>
                        <a href="{{ url('animal-profiles/create') }}"><i class="fa fa-square-o fa-3x"></i> Uploading Animal</a>
                    </li>

                    <li>
                        <a class="active-menu"  href="{{ url('animal-profiles') }}"><i class="fa fa-square-o fa-3x"></i>Animal List</a>
                    </li>	

                    <li>
                        <a href="{{ url('adoption-requests') }}"><i class="fa fa-square-o fa-3x"></i>Adoption Request</a>
                    </li>

                    <li>
                        <a href="{{ url('animal-abuse-reports') }}"><i class="fa fa-square-o fa-3x"></i>Animal Report</a>
                    </li> 

                     <li>
                        <a href="{{ url('meetings') }}"><i class="fa fa-square-o fa-3x"></i>Schedule Meeting</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Blank Page</h2>   
                        <h5>Welcome Jhon Deo , Love to see you back. </h5>

                       <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Age</th>
                                            <th>Medical History</th>
                                            <th>Profile Picture</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($animalProfiles as $animal)
                                        <tr class="odd gradeX">
                                            <td>{{ $animal->name }}</td>
                                            <td>{{ $animal->description }}</td>
                                            <td>{{ $animal->age }}</td>
                                            <td>{{ $animal->medical_records }}</td>
                                            <td><img width="40px" height="40px" src="{{ Storage::url($animal->profile_picture) }}" class="card-img-top" alt="{{ $animal->name }}"></td>
                                        

                                            <td>
                                                <a href="{{url('update-animal', $animal->id)}}" class="btn btn-warning btn-sm">Update</a>
                                            </td>

                                            <td>
                                                <a href="{{url('delete-animal', $animal->id)}}" class="btn btn-warning btn-sm">Delete</a>
                                            </td>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="/admin/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="/admin/assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="/admin/assets/js/custom.js"></script>
    
   
</body>
</html>
