@extends('layouts.simple.master')
@section('title', 'Role List')

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
	<h2>Role<span>List</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Role</li>
   <li class="breadcrumb-item active">Role List</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <h5>Role</h5>
               @can('roles-create')
                  
               <a href="<?= route('roles.create') ?>"><button class="btn btn-primary btn-sm ">Add Role</button></a>
               @endcan
            </div>
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-nowrap">Name</th>
                        <th scope="col" class="text-nowrap">Permissions</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($roles as  $key => $role)
                     <tr>
                        <th scope="row">{{ $role->id }}</th>
                        <td class="truncate-text">{{ $role->name }}</td>
                        <td class="truncate-text"><ul>
                            @foreach($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul></td>
                        <td class="text-nowrap">
                              <!--<a href=""><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a>-->
                              @can('roles-edit')
                              <a href="{{ route('roles.edit', $role->id) }}"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                              @endcan

                              <!-- Button trigger modal -->
                              @can('roles-delete')
                                 <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{$role->id}}"><i data-feather="trash-2"></i></button>
                              @endcan
                              <div class="modal fade" id="exampleModal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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