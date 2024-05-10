@extends('layouts.main')
@section('mainsection')
    <div class="container login-form">

        <div class="row align-items-center justify-content-center g-1 gap-2">

            <div class="col col-sm-12 col-lg-7 form-img">
                <img src="{{ asset('assets/images/loginimages/Illustration.png') }}" class="img-fluid" alt="..."
                    height="80%" width="95%">
            </div>
            <div class="col col-sm-12 col-lg-4 form">
                @if (session('status'))
                    <div class='alert alert-success'>
                        {{ session('status') }}
                    </div>
                @endif
                <form method="post">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center flex-column">

                        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMessage">
                                    <h3 class='fs-5 fw-bold'></h3>
                                </div> -->


                        <h3 class=" fs-2 fw-bold">Login to your account</h3>
                        <div class="mb-3">
                            <label for="exampleInputEmail1"
                                class="form-label pt-4 text-secondary fw-bold fs-6">E-mail</label>

                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/loginimages/Suche.png') }}" class=" login-logo mx-1"
                                    alt="" height="21" width="25">
                                <input type="text" name="email"
                                    class="form-control d-block fs-5  rounded-0  input border border-0"
                                    placeholder="Your e-mail" value="{{ old('email') }}">
                            </div>
                            <span class="error text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1"
                                class="form-label text-secondary fw-bold fs-6">Password</label>
                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/loginimages/Suche (1).png') }}" class=" login-logo mx-1"
                                    alt="" height="14" width="26">
                                <input type="password" class="form-control d-block fs-5 rounded-0  input border border-0"
                                    aria-describedby="emailHelp" name="password" placeholder="Enter passwords">
                                <img src="{{ asset('assets/images/loginimages/Suche (2).png') }}"
                                    class="toggle-password ms-auto ps-2" alt="">

                            </div>
                            <span class="error text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="mb-3 form-check py-2">
                            <input type="checkbox" class="form-check-input rounded-1 p-2 border border-2 border-secondary"
                                id="exampleCheck2">
                            <label class="form-check-label text-secondary fw-bold fs-6 lh-base ps-1 pt-1"
                                for="exampleCheck1">Remember me
                            </label>
                            <a href="" class="ms-3">Forget password?</a>
                        </div>
                        <button
                            type="submit"class="btn btn-primary rounded-0 btn-lg login-form-btn rounded-1 form-btn fw-bold border-0">Log
                            In</button>
                        {{-- <button type="button" class="btn text-black fw-bold fs-5 btn-outline-secondary rounded-1 mt-3 btn-lg form-btn">
                            <img src="{{asset('assets/images/loginimages/icons8-google-48.png')}}" alt="" height="28">
                            Continue with Google
                        </button> --}}
                        <!-- Add this button within your existing form -->
                        <button type="button" onclick="window.location='{{ route('google-auth-login') }}'"
                            class="btn text-black fw-bold fs-5 btn-outline-secondary rounded-1 mt-3 btn-lg form-btn">
                            <img src="{{ asset('assets/images/loginimages/icons8-google-48.png') }}" alt=""
                                height="28">
                            Continue with Google
                        </button>


                        <div class="pt-3 ">
                            <p class="text-black fw-bold fs-5">Don't have an account yet? <a href="{{ url('/signup') }}"
                                    class="link-primary link-offset-2 fw-bold link-underline-opacity-0">Sign Up</a></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Add this script at the end of your HTML file, just before the closing </body> tag -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const togglePasswordBtn = document.querySelector('.toggle-password');

            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Change the eye icon based on the password visibility
                if (type === 'password') {
                    togglePasswordBtn.src = "{{ asset('assets/images/loginimages/Suche (2).png') }}";
                } else {
                    togglePasswordBtn.src = "{{ asset('assets/images/loginimages/Suche (2).png') }}";
                }
            });
        });
    </script>
@endsection
