@extends('layouts.main')
@section('mainsection')
    <div class="container login-form">

        <div class="row  justify-content-center g-1 gap-2">

            <div class="col col-sm-12 col-lg-7 form-img">
                <img src="{{ asset('assets/images/signupimages/Group 1597882533 (1).png') }}" alt="Signup Image">

            </div>

            <div class="col col-sm-12 col-lg-4 form">


                <form method="post">
                    @csrf

                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }} </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-danger">
                            {{ session('success') }} </div>
                    @endif

                    <div class="d-flex justify-content-center align-items-center flex-column">

                        <h3 class=" fs-2 fw-bold">Signup to your account</h3>

                        <div class="mb-3">
                            <label for="fname" class="form-label pt-4 text-secondary fw-bold fs-6">First
                                Name</label>
                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/signupimages/Vector (1).png') }}" class=" login-logo mx-1"
                                    alt="" height="21" width="25">
                                <input type="text" name="firstname"
                                    class="form-control d-block fs-5  rounded-0  input border border-0" id="firstName"
                                    placeholder="Johan" value ="{{ old('firstname') }}">
                            </div>
                            <span class="error text-danger">
                                @error('firstname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="lname" class="form-label  text-secondary fw-bold fs-6">Last
                                Name</label>

                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/signupimages/Vector (1).png') }}" class=" login-logo mx-1"
                                    alt="" height="21" width="25">
                                <input type="text" class="form-control d-block fs-5  rounded-0  input border border-0"
                                    id="lastName" name="lastname" placeholder="Deo" value ="{{ old('lastname') }}">
                            </div>
                            <span class="error text-danger">
                                @error('lastname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary fw-bold fs-6">E-mail</label>
                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/signupimages/Suche.png') }}" class=" login-logo mx-1"
                                    alt="" height="21" width="25">
                                <input type="text" class="form-control d-block fs-5  rounded-0  input border border-0"
                                    id="exampleInputEmail13" name="email" placeholder="example.com"
                                    value ="{{ old('email') }}">
                            </div>
                            <span class="error text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-secondary fw-bold fs-6">Password</label>
                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/signupimages/Suche (1).png') }}" class=" login-logo mx-1"
                                    alt="" height="14" width="26">
                                <input type="password" class="form-control d-block fs-5 rounded-0  input border border-0"
                                    name="password" placeholder="Enter passwords">
                                <img src="{{ asset('assets/images/signupimages/Suche (2).png') }}" class="ms-auto ps-2"
                                    alt="">
                            </div>
                            <span class="error text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label  text-secondary fw-bold fs-6">Country</label>

                            <div class="login-input border d-flex p-2 align-items-center">
                                <img src="{{ asset('assets/images/signupimages/Vector (1).png') }}"
                                    class=" login-logo mx-1" alt="" height="21" width="25">
                                <select class="form-select border-0 fs-5" aria-label="Default select example"
                                    name="country">
                                    <option value="">Select your country</option>
                                    @foreach ($country as $countries)
                                        <option value="{{ $countries->id }}"
                                            {{ old('country') == $countries->id ? 'selected' : '' }}>
                                            {{ $countries->country }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <span class="error text-danger">
                                @error('country')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-1">
                            <label for="gender" class="form-label  text-secondary fw-bold fs-6">Gender</label>

                            <div class="login-input d-flex gap-2">
                                <input class="form-check-input" type="radio" name="gender" value="male"
                                    id="flexRadioDefault1" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault1">
                                    Male
                                </label>
                                <input class="form-check-input ms-2" type="radio" name="gender" value="female"
                                    id="flexRadioDefault12" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault1">
                                    Female
                                </label>
                                <input class="form-check-input ms-2" type="radio" name="gender" value="other"
                                    id="flexRadioDefault12" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault1">
                                    Other
                                </label>
                            </div>
                            <span class="error text-danger">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1"
                                class="form-label  text-secondary fw-bold fs-6">Hobbies</label>

                            <div class="login-input d-flex gap-4">
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobbies[]"
                                            value="Listeningtomusic" id="flexCheckDefault1"
                                            {{ is_array(old('hobbies')) && in_array('Listeningtomusic', old('hobbies')) ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault">
                                            Listening to music
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobbies[]" value="Dancing"
                                            id="flexCheckDefault2"
                                            {{ is_array(old('hobbies')) && in_array('Dancing', old('hobbies')) ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault">
                                            Dancing
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobbies[]"
                                            value="Watchingtomovies" id="flexCheckDefault3"
                                            {{ is_array(old('hobbies')) && in_array('Watchingtomovies', old('hobbies')) ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault">
                                            Watching to movies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hobbies[]" value="Singing"
                                            id="flexCheckDefault4"
                                            {{ is_array(old('hobbies')) && in_array('Singing', old('hobbies')) ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault">
                                            Singing
                                        </label>
                                    </div>
                                </div>
                            </div><br>
                            <span class="error text-danger">
                                @error('hobbies')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="mb-3 form-check pt-3 pb-3">
                            <input type="checkbox" class="form-check-input rounded-1 p-2 border border-2 border-secondary"
                                id="exampleCheck18">
                            <label class="form-check-label text-secondary fw-bold fs-6 lh-base ps-1 pt-1"
                                for="exampleCheck1">I have
                                read the <a
                                    class="link-dark link-offset-2 link-underline-opacity-50 link-underline-secondary">Terms
                                    & Conditions</a>
                            </label>
                        </div>
                        <button type="submit" name="submit"
                            class="btn btn-primary rounded-0 btn-lg login-form-btn rounded-1 form-btn fw-bold border-0">Sign
                            Up</button>
                        <button type="button" onclick="window.location='{{ route('redirect.google') }}'"
                            class="btn text-black fw-bold fs-5 btn-outline-secondary rounded-1 mt-3 btn-lg form-btn">
                            <img src="{{ asset('assets/images/loginimages/icons8-google-48.png') }}" alt=""
                                height="28">
                            Continue with Google
                        </button>
                        <div class="pt-3 ">
                            <p class="text-black fw-bold fs-5">Don't have an account yet? <a
                                    class="link-primary link-offset-2 fw-bold link-underline-opacity-0">Sign In</a></p>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
