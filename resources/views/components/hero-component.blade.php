<div class="profile-home">
    <img src="{{asset('assets/images/home/Rectangle 619.png')}}" alt="" height="100%" width="100%">
</div>

<div class="border-bottom">
    <div class="container">
        <div class="py-4 d-flex logout justify-content-center gap-5">
            <p class="fs-5 text-secondary fw-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Molestie ultricies <br> pretium, enim id amet,
                dapibus sit nullam. Vel, facilisi interdum morbi id. </p>
            <div class="profile-btn-group d-flex gap-3" role="group" aria-label="Basic example">
                <a href="{{url('profile')}}" class="link-light link-offset-2 link-underline-opacity-0"><button type="button" class="btn btn-primary border-0 fw-semibold rounded-0 btn-box">Profile</button></a>
                <a href="{{route('gallery.index')}}" class="link-light link-offset-2 link-underline-opacity-0"><button type="button" class="btn btn-light text-primary rounded-0 border-2 fw-bold border border-primary btn-box1">Album</button></a>
                <a href="{{url('websearch')}}" class="link-light link-offset-2 link-underline-opacity-0"><button type="button" class="btn btn-light rounded-0 text-primary fw-bold border-2 border border-primary btn-box1">Search</button></a>
            </div>
        </div>
    </div>
</div>