<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  <title>Carsafe</title>
  <link rel="icon" type="image/x-icon" href="{{asset ('assets/images/Group 46.png')}}">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet"href="{{ asset('assets/style.css') }}">
  <link rel="stylesheet" href="../assets/css/album.css">
  <!-- <link rel="shortcut icon" href="../assets/images/Group 46.png" type="image/x-icon"> -->
</head>
<body>
{{-- {{$status}} --}}
  <nav class="navbar navbar-expand-lg nav bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{('/')}}"><img src="{{ asset('assets/images/logo.png') }}" class="nav-logo" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-primary menu"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 justify-content-center  mb-lg-0">
          <li class="nav-item fs-5 fw-medium">
            <a class="nav-link text-light" href="{{('/')}}">Home</a>
          </li>
          <li class="nav-item fs-5 fw-medium">
            <a class="nav-link text-light" href="#">About Us</a>
          </li>
        </ul>
        <div class="button-group d-flex gap-2">
              
                    <a href="{{url('/logout')}}" class="link-light link-offset-2 link-underline-opacity-0">
                        <button type="button" class="btn rounded-0 text-white login nav-btn">Logout</button>
                    </a>
              
            </div>
      </div>

    </div>
  </nav>
   
   @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  