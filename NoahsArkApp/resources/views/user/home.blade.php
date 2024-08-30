<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="user/assets/css/fontawesome.css">
    <link rel="stylesheet" href="user/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="user/assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="" style="position: relative; top: 0;">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Sixteen <em>Clothing</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('home')}}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{url('report/abuse')}}">Report Animal Abuse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('chatify')}}">Message</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Notification</a>
              </li>


              @if(Route::has('login'))

  				@auth
  				<x-app-layout>
    
				</x-app-layout>
  				@else
                

               <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
              </li>

               <li class="nav-item">
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>
              </li>

                @endauth

                @endif
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <!-- Banner Ends Here -->

    <div class="latest-products" style="margin-top: 15px;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>OUR PETS</h2>
            </div>
          </div>

          @foreach($animalProfiles as $animal)
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="{{ Storage::url($animal->profile_picture) }}" class="card-img-top" alt="{{ $animal->name }}"></a>
              <div class="down-content">
                <a href="#"><h4>{{ $animal->name }}</h4></a>
                <h6>{{ $animal->age }}</h6>
                <p class="description" data-description="{{ $animal->description }}"></p>
                
                <span> <a href="{{ route('animals.show', $animal->id) }}">View Profile</a> </span>
              </div>
            </div>
          </div>
          @endforeach


         

    
   


    <!-- Bootstrap core JavaScript -->
    <script src="user/vendor/jquery/jquery.min.js"></script>
    <script src="user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="user/assets/js/custom.js"></script>
    <script src="user/assets/js/owl.js"></script>
    <script src="user/assets/js/slick.js"></script>
    <script src="user/assets/js/isotope.js"></script>
    <script src="user/assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

    <script>
                  document.addEventListener("DOMContentLoaded", function() {
                      const descriptions = document.querySelectorAll('.description');

                      descriptions.forEach(desc => {
                          const fullText = desc.getAttribute('data-description');
                          const wordLimit = 8;
                          const words = fullText.split(' ');

                          if (words.length > wordLimit) {
                              const truncatedText = words.slice(0, wordLimit).join(' ') + '...';
                              desc.textContent = truncatedText;
                          } else {
                              desc.textContent = fullText;
                          }
                      });
                  });
                  </script>


  </body>

</html>
