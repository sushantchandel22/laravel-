<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <title>Carsafe</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Group 46.png') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet"href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="../assets/css/album.css">
    <!-- <link rel="shortcut icon" href="../assets/images/Group 46.png" type="image/x-icon"> -->
    <style>
        .sidenav {
            width: 10%;
            height: 100vh;
            /* Set height to full viewport height */
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            z-index: 2;
            background-color: #192222;
            /* Adjust background color as needed */
            padding-top: 20px;
            /* Adjust top padding as needed */
        }

        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            /* Adjust font size as needed */
            color: white;
            display: block;
        }

        .sidenav a:hover {
            background-color: #ddd;
            /* Adjust hover background color as needed */
            color: black;
        }

        nav {
            z-index: 3;
        }
    </style>
</head>

<body>
    {{-- {{$status}} --}}
    <nav class="navbar navbar-expand-lg nav bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ '/' }}"><img src="{{ asset('assets/images/logo.png') }}"
                    class="nav-logo" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-primary menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 justify-content-center  mb-lg-0">
                    <li class="nav-item fs-5 fw-medium">
                        <a class="nav-link text-light" href="{{ '/' }}">Home</a>
                    </li>
                    <li class="nav-item fs-5 fw-medium">
                        <a class="nav-link text-light" href="#">About Us</a>
                    </li>
                </ul>
                <div class="button-group d-flex gap-2">
                    @if (Auth::check())
                        <a href="{{ url('/profile') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white profile nav-btn">
                                <i class="fa-solid fa-user" style="color: #ffffff;"></i> Profile
                            </button>
                        </a>
                        @if (Auth::user()->isadmin)
                            <a href="{{ url('/logout') }}" class="link-light link-offset-2 link-underline-opacity-0">
                                <button type="button" class="btn rounded-0 text-white login nav-btn">Admin
                                    Logout</button>
                            </a>
                        @else
                            <a href="{{ url('/logout') }}" class="link-light link-offset-2 link-underline-opacity-0">
                                <button type="button" class="btn rounded-0 text-white login nav-btn">Logout</button>
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/login') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white login nav-btn">Login</button>
                        </a>
                        <a href="{{ url('/signup') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white sign nav-btn">Signup</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    @if (Auth::user()->isadmin)
        <div>
            <div class="sidenav">

                <a href="{{ url('/addrole') }}" style="margin-top: 150px">Roles</a>
                {{-- <a href="#services">Permissions</a> --}}
                <a href="#clients">View</a>
                <a href="{{ url('/admin') }}">Users</a>
            </div>
            <div class="content">
                <main>
                    @yield('mainsection')
                </main>
            </div>
        </div>
    @else
        <main>
            @yield('mainsection')
        </main>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterInput = document.getElementById('username-filter');

            filterInput.addEventListener('input', function() {
                const filterValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const username = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                    if (username.includes(filterValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
