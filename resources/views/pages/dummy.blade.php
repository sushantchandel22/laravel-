@extends('layouts.main')
@section('mainsection')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">Country</th>
        <th scope="col">profileimage</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{$user->name}}</th>
        <td>{{$user->email}}</td>
        <td>{{$user->gender}}</td>
        <td>{{$user->country_id}}</td>
        <td><img src="{{ asset('storage/profileimages/' . $user->profileimage) }}" alt="profileimage" style="width:50px; border-radius: 1000px"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection