@extends('layouts.simple.master')
@section('title', 'Vendors Shops')

@section('css')
    <style>
        .truncate-text {
            max-width: 150px;
            /* Adjust the maximum width according to your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-item {
            width: 20%;
            text-align: center;
        }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Data of <span>Vendor Shop</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Vendor</li>
    <li class="breadcrumb-item">Vendor Shop Details</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Vendor Shop Details</h5>
                            @can('vendors-shop-create')
                                <a href="{{ route('vendor_shop.create') }}"><button class="btn btn-primary btn-sm ">Add Vendor
                                        Shop</button></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body add-post">
                        <div class="table-responsive">
                            <table class="table" id="publish-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="text-nowrap">Shop Name</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendorShops as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->shop_name }}</td>
                                            <td class="truncate-text">{{ $item->user->name }}</td>
                                            <td class="truncate-text">{{ $item->category->name }}</td>
                                            <td class="truncate-text">{{ $item->phone }}</td>


                                            <td class="text-nowrap">
                                                @can('vendors-edit')
                                                    <a href="{{ route('vendor_shop.edit', $item->id) }}"><button
                                                            class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                                @endcan
                                                <!-- Button trigger modal -->
                                                @can('vendors-delete')
                                                    <button class="btn text-danger px-2" type="button" data-toggle="modal"
                                                        data-original-title="test"
                                                        data-target="#exampleModal{{ $item->id }}"><i
                                                            data-feather="trash-2"></i></button>
                                                @endcan
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Confirm
                                                                    Deletion</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cancel</button>

                                                                {{-- Form for calling the destroy method --}}
                                                                <form action="{{ route('vendor_shop.destroy', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
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
    </div>
@endsection

@section('script')







@endsection
