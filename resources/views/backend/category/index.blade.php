@extends('layouts.simple.master')
@section('title', 'Categories')

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
	<h2>Categories<span> Details</span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Categories</li> --}}
   <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5>Categories</h5>
               @can('categories-create')
               <a href="{{ route('categories.create') }}"><button class="btn btn-primary btn-sm ">Add Category</button></a>
               @endcan
            </div>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-nowrap">Name</th>
                        @canany(['categories-edit', 'categories-delete'])
                        <th scope="col">Action</th>
                        @endcanany
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($categories as $item)
                     <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td class="truncate-text">{{ $item->name }}</td>
                        @canany(['categories-edit', 'categories-delete'])

                        <td class="text-nowrap">
                              {{-- <a href="{{ route('blog.details', ['id' => $item->id]) }}"><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a> --}}
                        @can('categories-edit')

                              <a href="{{ route('categories.edit', $item->id) }}"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                              @endcan
                              <!-- Button trigger modal -->
                              @can('categories-delete')
                              <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{$item->id}}"><i data-feather="trash-2"></i></button>
                              @endcan
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
                                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST">
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
                        @endcanany
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