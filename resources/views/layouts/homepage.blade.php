<!DOCTYPE html>
<html>
<head>
    <title>Super Metro</title>
    <!-- Include your CSS stylesheets or external stylesheets here -->
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Other libraries (if needed) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>


</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo and Brand -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/supermetrologo.png') }}" alt="Your Logo" width="30" height="30" class="d-inline-block align-text-top">
            Super Metro
        </a>
    
        <!-- Navigation Links -->
        <nav class="navbar-nav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/bus-routes">Bus Routes</a></li>
                <li class="nav-item"><a class="nav-link" href="/about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            </ul>
        </nav>
        
        <!-- Login and Register Links -->

    <!-- <header>
        <div class="logo">
            <img src="{{ asset('images/supermetrologo.png') }}" alt="Your Logo">
            <h1>Super Metro</h1>
        </div>
    
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/bus-routes">Bus Routes</a></li>
                <li><a href="/about-us">About Us</a></li>
                <li><a href="/contact">Contact Us</a></li>
                
                    Show login and register links for guests (unauthenticated users) -->
                    <!-- <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                
            </ul>
        </nav>  -->


        
    </header>
    <div class="content-wrapper">
    @yield('content')<!-- /.content -->
  </div> 
   
    <!-- <script src="{{ asset('build/assets/app-d6a225ef.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
 -->



    <!-- Include your JavaScript files or external scripts here -->
    
    <!-- Rest of your page content -->
    
    <!-- Add your JavaScript files and closing body and html tags -->
</body>
</html>

    
