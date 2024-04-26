@extends('layouts.simple.master')
@section('title', 'Users Details')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Data of <span>Users</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Users Details</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Users Data</h5>
                        <a href="<?= route('users.create') ?>"><button class="btn btn-primary btn-sm ">Add User</button></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- @dump($users) --}}
                                @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->roles }}</th>
                                        <td>
                                                {{-- <a href="{{ route('users.show', $item->id) }}"><button class="btn btn-shadow-secondary btn-sm">View </button></a> --}}
                                                <a href="{{ route('users.edit', $item->id) }}"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                                <!-- Button trigger modal -->
                                                
                                                <button class="btn text-danger" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{$item->id}}"><i data-feather="trash-2" class="fs-1"></i></button>
                                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                
                                                                {{-- Form for calling the destroy method --}}
                                                                <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                            
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script')
@endsection

