@extends('layouts.simple.master')
@section('title', 'Blog Details')

@section('css')
@endsection

@section('style')
<style>
   .truncate-text {
       max-width: 150px; /* Adjust the maximum width according to your design */
       white-space: nowrap;
       overflow: hidden;
       text-overflow: ellipsis;
   }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Blog<span>Details</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Blog</li>
   <li class="breadcrumb-item active">Blog Details</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5>Home For Rent</h5>
               <a href="<?= route('blogs.create') ?>"><button class="btn btn-primary btn-sm ">Add Blog</button></a>
            </div>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-nowrap">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="text-nowrap">Status</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($blogs as $item)
                     @php         
                        switch ($item->status) {
                              case "draft":
                                 $class = "badge-light";
                                 $badge_name = "Draft";
                                 break;
                              case "review":
                                 $class = "badge-danger";
                                 $badge_name = "Ready For Review";
                                 break;
                              case "publish":
                                 $class = "badge-success";
                                 $badge_name = "Published";
                                 break;
                        }
                     @endphp
                     <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td class="truncate-text">{{ $item->title }}</td>
                        <td class="">{{ $item->blogCategory->name}}</td>
                        <td class=""><span class="badge badge-pill {{$class}}">{{$badge_name}}</span></td>
                        <td class="text-nowrap">
                              <a href="{{ route('blog.details', ['id' => $item->id]) }}"><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a>
                              <a href="{{ route('blogs.edit', $item->id) }}"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                              <!-- Button trigger modal -->
                              
                              <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{$item->id}}"><i data-feather="trash-2"></i></button>
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
                                                <form action="{{ route('blogs.destroy', $item->id) }}" method="POST">
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