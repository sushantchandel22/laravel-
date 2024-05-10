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
                    {{-- @if (Auth::check())
                        <a href="{{ url('/profile') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white profile nav-btn">
                                <i class="fa-solid fa-user" style="color: #ffffff;"></i> Profile
                            </button>
                        </a>
                        <a href="{{ url('/logout') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white login nav-btn">Logout</button>
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white login nav-btn">Login</button>
                        </a>
                        <a href="{{ url('/signup') }}" class="link-light link-offset-2 link-underline-opacity-0">
                            <button type="button" class="btn rounded-0 text-white sign nav-btn">Signup</button>
                        </a>
                    @endif --}}

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



    <main>
        @yield('mainsection')
    </main>


    <div class="container-fluid footer ">
        <div class="container pt-4">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5">
                <div class="col mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                        <img src="../assets/images/Group 46.png" alt="">
                    </a>
                    <h5 class="pt-4 lh-lg text-secondary">2021 Award winning Architecture and Lorem ipsum dolor sit amet
                    </h5>
                </div>

                <div class="col mb-3">

                </div>

                <div class="col mb-3">
                    <h5 class="fw-bolder fs-5">Quick Links</h5>
                    <ul class="nav flex-column lh-lg">

                        <li class="nav-item mb-2"><a href="../index.php"
                                class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About
                                Us</a></li>
                        <li class="nav-item mb-2"><a href="../add_images/images.php"
                                class="nav-link p-0 text-body-secondary">Buy a
                                car</a>
                        </li>
                        <li class="nav-item mb-2"><a href="../add_images/album.php"
                                class="nav-link p-0 text-body-secondary">Sell a
                                car</a>
                        </li>
                    </ul>

                </div>

                <div class="col mb-3">
                    <h5 class="fw-bolder fs-5">Follow Us On</h5>
                    <ul class="nav flex-column">
                        <div class="d-flex">
                            <div class="p-2 "><img src="../images/footer/E.png" alt=""></div>
                            <div class="p-2 ps-2 fw-semibold text-secondary lh-lg app-car-p">Facebook</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 "><img src="../images/footer/D.png" alt=""></div>
                            <div class="p-2 ps-2 fw-semibold text-secondary lh-lg app-car-p">Twitter</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 "><img src="../images/footer/Q.png" alt=""></div>
                            <div class="p-2 ps-2 fw-semibold text-secondary lh-lg app-car-p">Instagram</div>
                        </div>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5 class="fw-bolder fs-5">Contact Info</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">2020
                                Lorem ipsum
                                dolor sit amet DE 19080</a></li>
                        <li class="nav-item mb-2"><a href="#"
                                class="nav-link p-0 text-body-secondary">example@21.com</a></li>
                        <li class="nav-item mb-2"><a href="#"
                                class="nav-link p-0 text-body-secondary">598-632-4789</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#country').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#search-form').on('change keyup', function(e) {
                e.preventDefault();
                var query = $('#search').val();
                var country = $('#country').val();
                var gender = $('input[name="gender"]:checked').val();
                var hobbies = []; // Initialize an array for hobbies
                $('input[name="hobbies[]"]:checked').each(function() { // Loop through each checked hobby
                    hobbies.push($(this).val()); // Push the value to the hobbies array
                });
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {
                        'search': query,
                        'country': country,
                        'gender': gender,
                        'hobbies': hobbies,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#search-list').html(data);
                    }
                });
            });
        });
    </script>


</body>


</html>


{{-- @if (count($data) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Gender</th>
                <th scope="col">Hobbies</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->country_name }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>
                        @foreach (json_decode($row->hobbies) as $hobby)
                            {{ $hobby }},
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No result found</p>
@endif --}}
