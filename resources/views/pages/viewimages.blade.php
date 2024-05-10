@extends('layouts.main')
@section('mainsection')
    <x-hero-component></x-hero-component>
    <div class="container-fluid col-md-12 row">
        <a href="{{ route('add-images', ['gallery_id' => $id]) }}">
            <button class=" addimagesbutton btn btn-primary float-end border-0 fw-semibold rounded-0 btn-box">Add
                images</button>
        </a>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('storage/galleryimages/' . $image->image) }}" class="img-fluid center" alt="Image"
                        style =" width:350px; height:350px; ">
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
