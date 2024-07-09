<!DOCTYPE html>
<html>
<head>
    <title>City Bus</title>
    <!-- Include your CSS stylesheets or external stylesheets here -->
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />


<!-- Other libraries (if needed) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/home.css">
@yield('styles')
<!-- Leaflet JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- jQuery -->
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>

<body>

    <div class="container">
        
        <div class="navbar-brand">
            <img src="{{ asset('images/supermetrologo.png') }}" class="logo">
            
                <ul>
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    
                    
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>
            

        </div>
     
        < <div class="container_d">
        

                  @yield('content')
             </div>
        
        
   
    <!-- <script src="{{ asset('build/assets/app-d6a225ef.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
 -->



    <!-- Include your JavaScript files or external scripts here -->
    
    <!-- Rest of your page content -->
    
    @yield('scripts')
    <!-- Add your JavaScript files and closing body and html tags -->
</body>
</html>

    
