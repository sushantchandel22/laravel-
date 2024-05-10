
<?php
namespace App\Models;
?>
@extends('layouts.admin')
@section('mainsection')
{{-- <x-adminbutton-component></x-adminbutton-component>s --}}
<div></div>
<div class="container">
    <form method="POST" action="{{route('add_userole')}}">
        @csrf
        <input type="hidden" name="userId" placeholder="hidden" value="{{$userId}}">
        {{-- <input type="text" placeholder="name"> --}}
        <select name="select">
            <option value="1">Select Roles</option>
            @foreach ($roles as $role )
            <option  value="{{ $role->id }}">{{$role->name}}</option>
            @endforeach
        </select>
        <button class="btn btn-success" >submit</button>
    </form>
</div>

@endsection

