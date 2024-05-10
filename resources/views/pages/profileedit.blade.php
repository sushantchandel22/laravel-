@extends('layouts.main')
@section('mainsection')
    <x-hero-component></x-hero-component>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="container border rounded-4 my-5 px-3 profile-form">
            <div class=" profile-form-bg">
                <img src="{{ asset('storage/profileimages/' . $user->profileimage) }}" alt="Profile Image"
                    style= "width:100px; height:100px" class="rounded-circle">
            </div>
            <div class="d-flex profile-edit justify-content-between align-items-center flex-wrap py-5">
                <div class="d-flex profile-name gap-4 align-items-center flex-wrap ">
                    <div class="rounded-circle bg-secondary-subtle profile-form-img text-center">
                        <img src="{{ asset('storage/profileimages/' . $user->profileimage) }}" alt="Profile Image"
                            style= "width:100px; height:100px" class="rounded-circle">
                    </div>
                    <div>
                        <h5 class="text-dark fw-bold">{{ ucfirst($user->name) }} </h5>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Edit</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="mb-3">
                        <label for="firstname" class="form-label fs-6 fw-semibold">First Name</label>
                        <input type="text" name="firstname" class="form-control bg-body-tertiary py-3 ps-3 fs-6"
                            id="firstname" aria-describedby="firstnameHelp" name="firstname" placeholder="Your First Name"
                            value="{{ $user->firstname }}">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label fs-6 fw-semibold">Country</label>
                        <select name="country" class="form-control bg-body-tertiary py-3 ps-3 fs-6"
                            aria-describedby="countryHelp">
                            <option value="">Select Your Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $userWithCountry && $userWithCountry->country_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fs-6 fw-semibold">Last Name</label>
                        <input type="text" class="form-control bg-body-tertiary py-3 ps-3 fs-6" id="exampleInputEmail11"
                            aria-describedby="emailHelp" name="lastname" placeholder="Your First Name"
                            value="{{ $user->lastname }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label text-secondary fw-bold fs-6">Gender</label>
                        <div class="d-flex gap-2 form-control bg-body-tertiary py-3 ps-3 fs-6">
                            <input class="form-check-input" type="radio" name="gender" value="male"
                                id="flexRadioDefault1" {{ $user->gender == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault1">Male</label>

                            <input class="form-check-input ms-2" type="radio" name="gender" value="female"
                                id="flexRadioDefault2" {{ $user->gender == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary fw-bold fs-6"
                                for="flexRadioDefault2">Female</label>

                            <input class="form-check-input ms-2" type="radio" name="gender" value="other"
                                id="flexRadioDefault3" {{ $user->gender == 'other' ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary fw-bold fs-6"
                                for="flexRadioDefault3">Other</label>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fs-6 fw-semibold">Time Zone</label>
                        <input type="email" class="form-control bg-body-tertiary py-3 ps-3 fs-6" id="exampleInputEmail15"
                            aria-describedby="emailHelp" placeholder="Your First Name">
                    </div> -->
                </div>
                <label for="exampleInputEmail1" class="form-label  text-secondary fw-bold fs-6  fw-semibold">Hobbies</label>
                <div class="  mb-3 form-control d-flex gap-3 bg-body-tertiary py-3 ps-3 fs-6">
                    {{-- <label for="exampleInputEmail1" class="form-label text-secondary fw-bold fs-6">Hobbies</label> --}}
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobbies[]" id="flexCheckDefault1"
                            value="Listening to music"{{ in_array('Listening to music', $hobbies ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault1">
                            Listening to music
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobbies[]" id="flexCheckDefault2"
                            value="Dancing"{{ in_array('Dancing', $hobbies ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault2">
                            Dancing
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobbies[]" id="flexCheckDefault3"
                            value=  "Watching to movies"{{ in_array('Watching to movies', $hobbies ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault3">
                            Watching to movies
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobbies[]" id="flexCheckDefault4"
                            value="Singing"{{ in_array('Singing', $hobbies ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary fw-bold" for="flexCheckDefault4">
                            Singing
                        </label>
                    </div>
                </div>
            </div>
            {{-- <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Update profi</button> --}}
            <div class="py-5 email-heading">
                <h5 class="text-dark fw-bold ">My email Address</h5>
                <div class="d-flex profile-name gap-3 align-items-center flex-wrap pt-3">
                    <div class="rounded-circle bg-info-subtle profile-email text-center">
                        <img src="{{ asset('storage/profileimages/' . $user->profileimage) }}" alt="Profile Image"
                            style= "width:60px; height:60px" class="rounded-circle">
                    </div>
                    <div class="">
                        {{-- <p class="text-dark ">{{$user->name}} </p> --}}
                        <p class="text-dark fs-5">{{ $user->email }} </p>
                        <p class="text-secondary">{{ $user->created_at }}</p>
                    </div>
                </div>
                {{-- <button type="button" class="btn bg-info-subtle text-primary px-4 py-2">+Add Email Address</button> --}}
            </div>
        </div>
    </form>
@endsection
