@extends('layouts.admin')
@section('mainsection')

<div class="container border">
    <form>
        <div class="d-flex">
            <div>
                <label>FirstName</label>
                <input class="form-control" type="text" value="">
            </div>
            <div>
                <label>LastName</label>
                <input class="form-control" type="text" value="">
            </div>
        </div>
        <div class="d-flex">
            <div><label for="">Email</label>
                <input type="text" value="">
            </div>
            <div></div>
        </div>
    </form>
</div>
@endsection

<h1>Edit Post</h