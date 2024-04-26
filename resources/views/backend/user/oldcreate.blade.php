@extends('layouts.simple.master')
@section('title', 'Add User')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Add<span>User</span></h2>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">User</li>
<a href="{{ route('users.index') }}" class="breadcrumb-item">User Details</li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add User</h5>
                    </div>
                    <div class="card-body add-post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="row  themeform"  method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post') <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <input type="hidden" value="sale" name="home_for">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="emali">Email</label>
                                    <input class="form-control" id="email" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input class="form-control" id="phone" type="text" placeholder="Enter Number" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" type="password" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles:</label>
                                    <select name="role" id="role" class="form-control" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                            </div>
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">submit</button>
                                <input class="btn btn-light btn-pill" type="reset" value="Discard">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Add the following script at the end of your file -->

@endsection
