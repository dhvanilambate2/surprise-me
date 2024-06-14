@extends('layouts.simple.master')
@section('title', 'Add Vendor')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/dropzone.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Add<span>Vendor</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Vendor</li>
    <a href="{{ route('vendors.index') }}" class="breadcrumb-item">Vendor Details</a>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Vendor</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="row" method="post" action="{{ route('vendors.store') }}" enctype="multipart/form-data" id="" autocomplete="off">
                            @csrf
                            @method('post') <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <input type="hidden" value="sale" name="home_for">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
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
                                
                            </div>
                            <div class="btn-showcase">
                                <button id="submitButton" class="btn btn-primary btn-pill" type="submit">Submit</button>
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
    <script src="{{ route('/') }}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{ route('/') }}/assets/js/select2/select2-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone-script.js"></script>
    <script src="{{ route('/') }}/assets/js/chat-menu.js"></script>
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     document.getElementById('submitButton').addEventListener('click', function () {
        //         document.getElementById('create-form').submit();
        //     });
        // });
    </script>
@endsection
