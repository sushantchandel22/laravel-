@extends('layouts.main')
@section('mainsection')
    <x-hero-component></x-hero-component>
    <div class="container-fluid mt-5">

        <a href = "{{ url('/viewform') }}" class="link-light link-offset-2 link-underline-opacity-0">
            <button type="button"
                class=" addgallerybutton float-end btn btn-primary border-0 fw-semibold rounded-0 btn-box">Add
                gallery</button>
        </a>


    </div>

    <div class="row container-fluid mt-5">
        @foreach ($galleries as $gallery)
            <div class="col-md-4">
                <div style="width: 350px;">
                    <div class="gallery-item">
                        <a href="{{ route('view.images', ['gallery_id' => $gallery->id]) }}">
                            <img class="fixed-image card-img-top"
                                src="{{ asset('storage/galleryimages/' . $gallery->gallery_cover_image) }}"
                                alt="{{ $gallery->gallery_name }}">
                        </a>
                        <div class="gallery-overlay d-flex justify-content-between">
                            <a href="{{ route('view.images', ['gallery_id' => $gallery->id]) }}"
                                class="btn btn-primary">View Images</a>
                            <button class="btn btn-danger delete-toggle"
                                data-gallery-id="{{ $gallery->id }}">Delete</button>
                        </div>
                    </div>
                    <div class="text-center ">
                        <h3 class="fs-1">{{ ucfirst($gallery->gallery_name) }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <script>
        document.querySelectorAll('.delete-toggle').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const galleryId = this.getAttribute('data-gallery-id');
                    fetch(`/gallery/${galleryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        if (response.ok) {
                            // Item deleted successfully, remove from DOM
                            this.closest('.col-md-4').remove();
                        } else {
                            alert('Failed to delete item');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete item');
                    });
                }
            });
        });
    </script>
@endsection
