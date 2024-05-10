@extends('layouts.main')
@section('mainsection')
    <x-hero-component></x-hero-component>
    <form id="search-form">
        <div class="container  border rounded-4 my-5 px-3 profile-form py-5">
            <div class="row">
                <div class="col-sm-2">
                    <label class="form-label">Name</label>
                    <input class="form-control rounded-0" type="text" name="name" id="search"
                        placeholder="Search Name ">
                </div>
                <div class="col-sm-2">
                    <label class="form-label">Country</label>
                    <select class="form-control rounded-0" name="country" id="country">
                        <option class="form-control" value="">select the country</option>
                        <option>
                            @foreach ($country as $countries)
                        <option value="{{ $countries->id }}" {{ old('country') == $countries->id ? 'selected' : '' }}>
                            {{ $countries->country }}</option>
                        @endforeach
                        </option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="gender" class="form-label text-secondary fw-bold    fs-6">Gender</label>
                    <div class="d-flex gap-2 form-control bg-body-tertiary ps-3 fs-6 rounded-0">
                        <input class="form-check-input " type="radio" name="gender" value="male"
                            id="flexRadioDefault1">
                        <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault1">Male</label>
                        <input class="form-check-input ms-2" type="radio" name="gender" value="female"
                            id="flexRadioDefault2">
                        <label class="form-check-label text-secondary fw-bold fs-6" for="flexRadioDefault2">Female</label>
                    </div>
                </div>
                <div class="col-sm-4 rounded-0">
                    <label for="exampleInputEmail1"
                        class="form-label  text-secondary fw-bold fs-6  fw-semibold">Hobbies</label>
                    <div class="  mb-3 form-control d-flex gap-2 bg-body-tertiary ps-3 fs-6 rounded-0">
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
                <div class="col-sm-2 " style="padding-top:32px">
                    <button class="btn btn-success rounded-0" name="button" style="width: 100px">Search</button>
                </div>
            </div>
            <div class="container" id="search-list">

            </div>
        </div>
        </div>
    </form>
@endsection
