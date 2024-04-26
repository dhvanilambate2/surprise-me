@extends('layouts.simple.master')
@section('title', 'Blog Details')

@section('css')
<style>
   /* Custom styles for the profile details page */
</style>
@endsection

@section('style')
<style>
    .btn-showcase{
        text-align:center;
        margin-top: 10px;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Profile<span>Details</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Profile</li>
	<li class="breadcrumb-item active">Profile Details</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center mt-5">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header bg-primary text-white">
                   <h3 class="mb-0">User Details</h3>
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-md-6 border-right">
                           <div class="form-group">
                               <label for="name"><strong>Name:</strong></label>
                               <p class="form-control-static">{{ $users->name }}</p>
                           </div>
                           <div class="form-group">
                               <label for="email"><strong>Email:</strong></label>
                               <p class="form-control-static">{{ $users->email }}</p>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="phone"><strong>Phone:</strong></label>
                               <p class="form-control-static">{{ $users->phone }}</p>
                           </div>
                           <div class="form-group">
                               <label for="type"><strong>User Type:</strong></label>
                               <p class="form-control-static">{{ $users->type }}</p>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                    <div class="col-md-12">
                        <div class="btn-showcase">
                                <a href="{{ url("admin/profile/edit") }}" class="btn btn-primary btn-pill" type="submit">Edit Profile</a>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

@endsection

@section('script')
@endsection