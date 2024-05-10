@extends('layouts.main')
@section('mainsection')
    <x-hero-component></x-hero-component>
    <div class="center">
        <div class="container my-5 py-5 border rounded-4">
            <form action="{{ route('uploadimages') }}" alt="galleryimages" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="gallery_id" value="{{ $gallery_id }}">
                {{-- <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 fw-semibold">Album Name</label>
                <input type="text" class="form-control bg-body-tertiary py-3 ps-3 fs-6 " id="exampleInput" placeholder="Enter Your Album Name" name="uploadimagename">
            </div> --}}
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Large file input example</label>
                    <input class="form-control form-control-lg " id="formFileLg" type="file" name="uploadimage[]"
                        multiple required>
                </div>
                <button type="submit" class="btn btn-primary my-3 rounded-0 px-5 py-2">Upload</button>
                <p class="text-dark fw-bolder">Upload image will be resized to fit within: <br>
                    Width of 500 pixels and Height of 500 Pixels</p>
            </form>
        </div>
    </div>
@endsection
