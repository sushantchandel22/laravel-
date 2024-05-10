@extends('layouts.admin')
@section('mainsection')
    <div class="container form-control mt-5 mb-5">
        @if (session('success'))
            <div class='alert alert-success'>
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex">
            <div class="col-sm-8">
                <input class="form-control " type="text" id="username-filter" placeholder="Filter by username">
            </div>
            <div class="col-sm-4">
                <select class="form-control" name="" id="activation-filter">
                    {{-- <option>select action</option> --}}
                    <option>Select Action</option>
                    <option>Activate</option>
                    <option>Deactivate</option>
                </select>
            </div>
        </div>



        <table class="table table-bordered container mt-5 mb-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    @if (auth()->user()->role->permissions()->where('name', 'username')->first()->pivot->read)
                        <th scope="col">Name</th>
                    @endif
                    @if (auth()->user()->role->permissions()->where('name', 'email')->first()->pivot->read)
                        <th scope="col">Email</th>
                    @endif
                    @if (auth()->user()->role->permissions()->where('name', 'country')->first()->pivot->read)
                        <th scope="col">country</th>
                    @endif
                    @if (auth()->user()->role->name === 'admin')
                        <th scope="col">Roles</th>
                    @endif
                    @if (auth()->user()->role->name === 'admin')
                        <th scope="col">button</th>
                    @endif
                    @if (auth()->user()->role->name === 'admin')
                        <th scope="col">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>


                        @if (auth()->user()->role->permissions()->where('name', 'username')->first()->pivot->read)
                            <td>{{ ucfirst($user->name) }}</td>
                        @endif
                        @if (auth()->user()->role->permissions()->where('name', 'email')->first()->pivot->read)
                            <td>{{ $user->email }}</td>
                        @endif
                        @if (auth()->user()->role->permissions()->where('name', 'country')->first()->pivot->read)
                            <td>{{ $user->country->country }}</td>
                        @endif
                        @if (auth()->user()->role->name === 'admin')
                            <td>{{ $user->role->name }}</td>
                        @endif
                        @if (auth()->user()->role->name === 'admin')
                            <td>
                                <img src="https://cdn-icons-png.flaticon.com/128/9790/9790368.png" style="width: 30px;">
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}"><img
                                        src="https://cdn-icons-png.flaticon.com/128/10336/10336582.png"
                                        style="width: 30px;"></a>
                                <img src="https://cdn-icons-png.flaticon.com/128/14026/14026573.png" style="width: 30px;">
                            </td>
                        @endif
                        @if (auth()->user()->role->name === 'admin')
                            <td>
                                <form action="{{ route('admin.toggle', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $user->is_active == !true ? 'btn-danger' : 'btn-success' }}">
                                        {{ $user->is_active == !true ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Roles</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('add_userole') }}">
                                        @csrf
                                        <input type="hidden" name="userId" placeholder="hidden"
                                            value="{{ $user->id }}">
                                        {{-- <input type="text" placeholder="name"> --}}
                                        <select class="form-control" name="select">
                                            <option value="1">Select Roles</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="float-end mt-3">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-success ">submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
