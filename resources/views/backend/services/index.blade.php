@extends('layouts.simple.master')
@section('title', 'Services')

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
    <h2>Data of <span>Services</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Services</li>
    <li class="breadcrumb-item">Services Details</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Services Details</h5>
                            @can('services-create')
                            <a href="{{ route('services.create') }}"><button class="btn btn-primary btn-sm ">Add
                                    Services</button></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body add-post">
                        <div class="table-responsive">
                            <table class="table" id="publish-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="text-nowrap">Service Name</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Change Status</th>
                                        <th scope="col">status</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $item)
                                        @php
                                            switch ($item->status) {
                                                case 'draft':
                                                    $class = 'badge-light';
                                                    $badge_name = 'Draft';
                                                    break;
                                                case 'review':
                                                    $class = 'badge-danger';
                                                    $badge_name = 'Ready For Review';
                                                    break;
                                                case 'publish':
                                                    $class = 'badge-success';
                                                    $badge_name = 'Published';
                                                    break;
                                                default:
                                                    $class = 'badge-light';
                                                    $badge_name = 'Unknown';
                                                    break;
                                            }
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->service_name }}</td>
                                            <td class="truncate-text">{{ $item->user->name }}</td>
                                            <td class="truncate-text">{{ $item->category->name }}</td>
                                            <td class="truncate-text">
                                                <!-- Add a dropdown for the 'Status' column -->
                                                <select class="form-control form-control-sm"
                                                    onchange="updateStatus(this, {{ $item->id }})">
                                                    <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                        Draft</option>
                                                    <option value="review"
                                                        {{ $item->status == 'review' ? 'selected' : '' }}>Ready For Review
                                                    </option>
                                                    @can('services-publish')
                                                        <option value="publish"
                                                        {{ $item->status == 'publish' ? 'selected' : '' }}>Publish</option>
                                                    @endcan
                                                </select>
                                            </td>

                                            <td class="truncate-text" id="status"><span
                                                    class="badge badge{{ $item->id }} badge-pill {{ $class }}">{{ $badge_name }}</span>
                                            </td>

                                            <td class="truncate-text">{{ $item->price }}</td>


                                            <td class="text-nowrap">
                            @can('services-edit')

                                                <a href="{{ route('services.edit', $item->id) }}"><button
                                                        class="btn btn-shadow-primary btn-sm">Edit </button></a>
                                            @endcan
                                                        <!-- Button trigger modal -->
                                                        @can('services-delete')

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
                                                                <form action="{{ route('services.destroy', $item->id) }}"
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

    <script>
        function updateStatus(selectElement, itemId) {
            var newStatus = selectElement.value;
            // Log the selected value to the console
            console.log("Selected Status:", newStatus);

            // Make an AJAX request to update the status in the database
            $.ajax({
                url: "{{ route('admin.services.update_status', ['id' => '__itemId__']) }}".replace(
                    '__itemId__', itemId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {

                    // Handle success (optional)

                    // Update the UI (as in your original code)
                    // Use jQuery to remove classes
                    $('.badge' + itemId).removeClass(
                        'badge-success badge-warning badge-secondary badge-light badge-danger');

                    switch (newStatus) {
                        case 'publish':
                            $('.badge' + itemId).addClass('badge-success').text('Published');
                            break;
                        case 'rented':
                            $('.badge' + itemId).addClass('badge-warning').text('Rented');
                            break;
                        case 'archive':
                            $('.badge' + itemId).addClass('badge-secondary').text('Archived');
                            break;
                        case 'review':
                            $('.badge' + itemId).addClass('badge-danger').text('Ready For Review');
                            break;
                        case 'draft':
                            $('.badge' + itemId).addClass('badge-light').text('Draft');
                            break;
                    }
                    loadData(currentTab);
                    // If the selected status is 'sold', dynamically load and display the sold data
                },
                error: function(error) {
                    console.error("Error updating status:", error);
                    alert('Failed to update status. Please try again.');
                    // Handle error (optional)
                }
            });
        }
    </script>

@endsection
