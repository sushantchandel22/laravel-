{{-- @include('common/header') --}}
@extends('layouts.main')
@section('mainsection')

<x-hero-component></x-hero-component>

<div class=" container">

    <div class="row row-cols-1 row-cols-md-3 g-4 flex-wrap detail-col">

        <div class="col-sm-6 col-md-12 col-lg-5 mb-3 mb-sm-0 detail-row">
            <div class="card bg-body-tertiary d-flex justify-content-center align-items-center py-5 h-100">
            <div id="profile-image-container" style="cursor: pointer; border-radius:50%">
                @if($user->profileimage)
                    <img src="{{ asset('storage/profileimages/' . $user->profileimage) }}" alt="Profile Image" style= "width:150px; height:150px"  class="rounded-circle">
                @else
                <img src="{{ asset('assets/images/home/download (1).jpeg') }}" alt="Profile Image" style= "width:150px; height:150px"  class="rounded-circle">
                @endif
            </div>
           
            <form id="profile-form" method="POST" action="/profile" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="file" name="profileimage" id="profile-image-input">
                <!-- Other fields -->
                <button type="submit">Update Profile</button>
            </form>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                var profileImageContainer = document.getElementById('profile-image-container');
                var profileForm = document.getElementById('profile-form');
                profileImageContainer.addEventListener('click', function() {   
                    document.getElementById('profile-image-input').click();
                });
                document.getElementById('profile-image-input').addEventListener('change', function() { 
                    profileForm.submit();
                });
               });
            </script>
                
            {{-- @foreach ($gallery as $galleries )
                {{$galleries->user_id}}
            @endforeach --}}

            <div class="card-body text-center">
                    <h2 class="text-dark fw-semibold">{{ucfirst($user->name)}}</h2>
                    <p class="fw-bold fs-5">Email- {{ $user->email }}</p>
                    <a href="{{url('/profile/edit')}}"><button type="button" class="btn btn-primary rounded-0 fs-5">Edit</button></a>
            </div>
        </div>
    </div>

        <div class="col-sm-6 col-md-12 col-lg-7 detail-row">
            <div class="card bg-body-tertiary p-5 h-100">
                <div class="row flex-wrap flex">
                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">First Name</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg  fw-semibold text-dark">{{ucfirst($user->firstname)}}</div>
                    
                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">Last Name</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg  fw-semibold text-dark">{{ucfirst($user->lastname)}}</div>

                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">Gender</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg  fw-semibold text-dark">{{ucfirst($user->gender)}}</div>

                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">Country</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg  fw-semibold text-dark">
                        {{ isset($userWithCountry->country) ? $userWithCountry->country : null }}  
                    </div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">Email</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg  fw-semibold text-dark">{{ $user->email }}</div>

                    <div class="col-6 col-sm-4 col-md-6 col-lg-4 fs-5 lh-lg fw-semibold text-dark">Hobbies</div>
                    <div class="col-6 col-sm-4 col-md-6 col-lg-8 fs-5 lh-lg fw-semibold text-dark">
                    @php
                        $hobbies = json_decode($user->hobbies);
                    @endphp
                    @if ($hobbies)
                        @foreach ($hobbies as $hobby)
                            {{ $hobby }}
                        @endforeach
                    @else
                        No hobbies found.
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


