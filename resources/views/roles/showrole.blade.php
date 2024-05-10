@extends('layouts.admin')
@section('mainsection')

<table class="table table-bordered container mt-5 mb-5">
    <thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Name</th>
  </tr>
</thead>
<tbody>
@foreach ($roles as $role )
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$role->name}}</td>
    <td>
        <img src="https://cdn-icons-png.flaticon.com/128/9790/9790368.png" style="width: 30px;">
        <a href="{{url('role', $role->id)}}"><img src="https://cdn-icons-png.flaticon.com/128/10336/10336582.png" style="width: 30px;"></a>

    </td>
</tr>
@endforeach

  </tbody>
</table>
@endsection