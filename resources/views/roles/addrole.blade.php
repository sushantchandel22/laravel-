@extends('layouts.admin')
@section('mainsection')
<x-adminbutton-component></x-adminbutton-component>
<form method="POST" action="{{ route('add_role_data') }}">
    @csrf
   
    <div class="container border mt-5 mb-5">
        <h3>Add Role</h3>
        <div class ="d-flex gap-4">
            <div><input type="text" class="form-control mb-4" name="name" value="{{ old('name') }}"></div>
           <div><button type="submit" class="btn btn-success">Submit Role</button></div>
        </div>
        
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if(session('success'))
<div class='alert alert-success container mt-5'>
   {{session('success')}}
</div>
@endif

    </div>
    
</form>
<table class="table table-bordered container mt-5 mb-5">
    <thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Name</th>
  </tr>
</thead>
<tbody>
@foreach ($roles as $role )
<input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}"/>
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{ucfirst($role->name)}}</td>
    <td>
<a href="{{url('role',$role->id)}}"><button class="btn btn-success">Edit</button></a>
<button class="btn btn-danger">Delete</button>
    </td>
</tr>
@endforeach

  </tbody>
</table>
@endsection
